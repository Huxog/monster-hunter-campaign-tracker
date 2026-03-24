# app/ — Application Code Conventions

## Layer Responsibilities

Every request flows through all layers in order. **Never skip a layer.**

| Layer | Location | Responsibility |
|---|---|---|
| Controller | `Http/Controllers/` | Call service, return Resource/Collection. Nothing else. |
| FormRequest | `Http/Requests/` | All input validation and error codes. |
| Service | `Services/` | Business logic. Depends on repository interface. |
| Repository | `Repositories/` | All Eloquent queries. Depends on model. |
| Model | `Models/` | Schema definition, relationships, casts. No logic. |

## Adding a New Entity (Checklist)

For every new entity (e.g. `Quest`), create **all** of the following — no exceptions:

```
app/Models/Quest.php
app/Interfaces/IQuestRepository.php       ← extends ICrudRepository
app/Interfaces/IQuestService.php          ← extends ICrudService
app/Repositories/QuestRepository.php     ← extends CrudRepository, implements IQuestRepository
app/Services/QuestService.php            ← extends CrudService, implements IQuestService
app/Http/Controllers/QuestController.php ← injects IQuestService
app/Http/Requests/QuestStore.php         ← uses FormatValidationFailure trait
app/Http/Requests/QuestUpdate.php        ← uses FormatValidationFailure trait
app/Http/Resources/QuestResource.php     ← extends JsonResource
app/Http/Resources/QuestCollection.php   ← extends ResourceCollection, sets $collects
```

Then register both bindings in `AppServiceProvider`:
```php
$this->app->bind(IQuestRepository::class, QuestRepository::class);
$this->app->bind(IQuestService::class, QuestService::class);
```

## Model Conventions

All models must have:
- `HasUuids` — UUID primary keys (never auto-increment)
- `HasFactory` — for seeders and tests
- `SoftDeletes` — all deletes are soft deletes
- `$table` property explicitly set
- `$primaryKey = 'id'` explicitly set
- `$fillable` array defined (never use `$guarded`)
- Relationship methods with return type hints and PHPDoc `@return`
- camelCase foreign key column names (e.g., `campaignId`, `mapId`, `helmetId`)

## Interfaces

Entity-specific interfaces extend the generic base interfaces:
```php
interface IQuestRepository extends ICrudRepository {}
interface IQuestService extends ICrudService {}
```

Add entity-specific methods to the interface (and only then to the implementation) when base CRUD is insufficient.

## Services and Repositories

- Services extend `CrudService`, repositories extend `CrudRepository`
- Override `$defaultRelations` in the service to eager load relations by default
- Only add methods that go beyond standard CRUD
- Services receive repository interfaces via constructor — never concrete classes
- Repositories receive the model via constructor — `parent::__construct($model)`
