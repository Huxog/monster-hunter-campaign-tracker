# database/ — Database Conventions

## Migration Rules

Every new table migration must follow this exact structure:

```php
Schema::create('table_name', function (Blueprint $table) {
    $table->uuid('id')->primary();      // Always UUID, never auto-increment
    // ... columns ...
    $table->timestamps();               // Always present
    $table->softDeletes();              // Always present — no hard deletes
});
```

- **UUID primary keys** — use `$table->uuid('id')->primary()` on every table
- **Soft deletes** — use `$table->softDeletes()` on every table, never omit it
- **Foreign keys** — use `$table->foreignUuid('columnName')` with camelCase column names
- **camelCase column names** throughout (e.g., `mapId`, `teamName`, `playerName`, `helmetId`)
- JSON columns for complex value objects (e.g., `damage`, `elementalResistances`)
- Enum columns use Laravel enum casting, defined as `$table->string('columnName')` in migrations

## Naming

- Table names: `snake_case`, plural (e.g., `maps`, `campaigns`, `hunters`)
- Column names: `camelCase` (e.g., `mapId`, `teamName`) — this is intentional and project-wide
- Foreign key columns: named after the relation + `Id` (e.g., `campaignId`, `mapId`, `helmetId`)
- Migration filenames: `YYYY_MM_DD_HHMMSS_description.php`

## Seeders

- `DatabaseSeeder` calls all seeders in dependency order (roles first, then independent entities, then dependent ones)
- Every new entity needs a seeder registered in `DatabaseSeeder::run()`
- Seeders use factories: `Model::factory()->count(n)->create()`
- The seeder order must respect foreign key dependencies

Current seeder order for reference:
```
RolePermissionSeeder → AdminUserSeeder → MapSeeder → WeaponSeeder
→ EquipmentSeeder → CampaignSeeder → HunterSeeder → MaterialSeeder
```

## Factories

- Every model needs a factory
- Extend `Factory` and implement `definition()` returning an array of all `$fillable` fields
- Use `$this->faker` for realistic data generation
- For UUID foreign keys, use the related model's factory inline:
  ```php
  'campaignId' => Campaign::factory(),
  ```

## Adding Columns to Existing Tables

- Always create a **new migration** — never modify an existing one
- Name it descriptively: `add_X_column_to_Y_table` or `add_X_columns_to_Y_table`
- Use `Schema::table()` not `Schema::create()`
- Always implement the `down()` method to reverse the change
