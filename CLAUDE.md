# MHCampaignApi — Claude Context

## Project Purpose

This is a **portfolio REST API** built as a companion app for a **Monster Hunter tabletop game**. It manages campaigns, hunters, equipment, weapons, materials, and eventually crafting, loot, quests, and real-time combat data. The API is designed to be consumed by multiple clients — starting with a web app but not limited to it.

---

## Development Environment

- **Runtime**: Docker Compose (mirrors the deployed environment). Config at `docker/docker-compose.yml`.
- **Platform**: WSL (Windows Subsystem for Linux)
- **Cloud Provider**: AWS (notifications, hosting, computing — no other cloud provider should be assumed)
- **No Laravel Sail** — use the Makefile targets to interact with the container

### Common Commands (via Makefile)

| Command | What it does |
|---|---|
| `make up` | Start containers |
| `make down` | Stop and remove containers |
| `make build` | Build containers from scratch |
| `make rebuild` | Bring down and restart containers |
| `make test` | Run the full test suite inside the container |
| `make migrate` | Run pending migrations |
| `make fresh` | Drop all tables, re-migrate, and seed |
| `make seed` | Run seeders only |
| `make install` | Run `composer install` inside the container |
| `make require <package>` | Add a Composer dependency |
| `make lint` | Apply Pint lint rules |
| `make lint-test` | List unmet lint rules without applying |
| `make logs` | Tail the app container logs |
| `make chown` | Fix storage permission issues |

> All artisan commands must be run inside the container via `docker exec mh-app-service php artisan ...` or through the Makefile.

---

## Architecture

Every request must follow this strict flow — **never skip a layer**:

```
Route → Controller → FormRequest (validation) → Service (via Interface) → Repository (via Interface) → Model
```

### Layers

- **Controllers** — Thin. Only call the service and return a Resource or Collection response.
- **FormRequests** — All validation lives here. Use the `FormatValidationFailure` trait for consistent error codes.
- **Service Interfaces + Services** — Business logic. Controllers depend on the interface, never the concrete class.
- **Repository Interfaces + Repositories** — All Eloquent queries. Services depend on the interface.
- **Models** — Eloquent models only. No business logic here.
- **Resources / Collections** — All response transformation goes through these, never raw model data.

### Bindings

All interface-to-implementation bindings are registered in `AppServiceProvider`. Every new entity must be registered there.

### Conventions

- **UUID primary keys** on all models (`HasUuids`)
- **Soft deletes** on all models
- **camelCase column names** in the database (e.g., `playerName`, `campaignId`)
- **No hardcoded values** — use enums, config, or environment variables
- **Error codes** follow the pattern `[DOMAIN]-[CATEGORY]-[SPECIFIC]` (e.g., `AUT-0302-0001`)
- New entities should mirror the existing structure (see `Map`, `Campaign`, or `Weapon` as reference implementations)

---

## Authorization

- **Laravel Sanctum** for token-based API authentication
- **Spatie Laravel Permission** for role-based access control
- Two roles: `admin` (full CRUD) and `player` (read-only)
- All write routes are protected with `middleware('role:admin')`
- New routes must follow the same read/write permission split

---

## Testing

**Tests are the source of truth.** All work should be centered around making tests pass. Never write a patch that bypasses or silences a test failure — fix the root cause.

- Run tests with `make test`
- Use `RefreshDatabase` on all feature tests
- Use `asAdmin()` and `asPlayer()` helpers from `TestCase` for role-based scenarios
- Every new entity needs: index, show, store, update, destroy tests — covering both admin and player roles
- Tests use an in-memory SQLite database (configured in `phpunit.xml`)
- No mocking the database — tests hit the real (in-memory) DB

---

## Domain Model

```
Map (1) ──── (many) Campaign
                       │
                    (many) Hunter
                              │
                          ├── Equipment (helmet)
                          ├── Equipment (vest)
                          ├── Equipment (trousers)
                          └── Weapon
```

### Enums

- `WeaponClass` — 14 MH weapon types (Bow, GreatSword, DualBlades, etc.)
- `ElementalType` — Fire, Water, Thunder, Ice, Dragon, None
- `EquipmentType` — helmet, vest, trouser
- `DamageCard` — weapon damage tracking (in progress)

---

## Planned Feature Roadmap

In rough priority order:

1. **Material entity** — crafting materials (partially scaffolded, needs completion)
2. **Quest entity** — campaign history, hunt records
3. **Loot** — relation between Hunters and Materials (items gathered/looted from monsters)
4. **Inventory** — weapons and equipment associated with hunters
5. **Crafting** — inventory management (crafting armor/weapons from materials)
6. **Monster entity** — full monster catalog with properties relevant to gameplay
7. **Damage decks** — each weapon class has a specific damage deck mechanic

---

## Priorities

1. **Tests passing** — this is the primary success criteria for any change
2. **Best practices and SOLID principles** — always apply them, never cut corners
3. **Scalability** — design for multiple clients (web, mobile, etc.) from the start
4. **Security** — follow security best practices; no hardcoded secrets, no temporal patches
5. **Clarity** — keep the codebase easy to pick up after a break; prefer explicitness over cleverness
