# tests/ — Testing Conventions

## Core Rules

- **Tests are the source of truth.** Never patch around a failure — fix the root cause.
- Every feature test uses `RefreshDatabase` — no exceptions.
- Never mock the database. Tests run against an in-memory SQLite database.
- Run tests with `make test` (runs inside the Docker container).

## Test Structure

Feature tests are organized by entity, one file per route operation:

```
tests/Feature/
└── EntityName/
    ├── EntityNameIndexTest.php
    ├── EntityNameShowTest.php
    ├── EntityNameStoreTest.php
    ├── EntityNameUpdateTest.php
    └── EntityNameDestroyTest.php
```

Every new entity needs all five test files.

## Auth Helpers

Use the `TestCase` helpers — never call `actingAs()` directly in test methods:

```php
$this->asAdmin();   // Creates user with 'admin' role, authenticates them
$this->asPlayer();  // Creates user with 'player' role, authenticates them
```

## What Each Test File Must Cover

### Index (`GET /api/entity`)
- Returns all records for an authenticated player
- Returns empty array when no records exist
- Does **not** return soft-deleted records

### Show (`GET /api/entity/{id}`)
- Returns correct record for a player
- Returns 404 for non-existent ID

### Store (`POST /api/entity`)
- Admin creates record with valid data → 201 + assertDatabaseHas
- Player cannot create → 403
- Validation: one test per required field / rule, asserting the specific error code

### Update (`PUT /api/entity/{id}`)
- Admin updates with valid data → 200 + assertDatabaseHas
- Player cannot update → 403
- Returns 404 for non-existent ID
- Validation: same pattern as store, with update-specific codes (x04x)

### Destroy (`DELETE /api/entity/{id}`)
- Admin deletes → 200, record is soft-deleted (still in DB with deleted_at set)
- Player cannot delete → 403
- Returns 404 for non-existent ID

## Assertions

- Assert HTTP status code on every response
- Assert JSON structure or specific paths with `assertJsonPath()`
- For validation errors: assert status `406` and the specific error `code` at `assertJsonPath('0.code', 'ENT-0202-000x')`
- For successful creates: always follow up with `assertDatabaseHas()`
- For soft deletes: use `assertSoftDeleted()` instead of `assertDatabaseMissing()`

## Factories

Every model needs a factory in `database/factories/`. Factories must produce realistic Monster Hunter domain data where applicable (use `$this->faker->word()` or hardcoded MH names — not generic lorem ipsum for game entities).
