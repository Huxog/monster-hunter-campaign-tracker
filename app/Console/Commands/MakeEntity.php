<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeEntity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:entity {name : The name of the entity}
                            {--a|all : Create all files (migration, factory, seeder, requests, resources, repository, service, interfaces)}
                            {--m|migration : Create a migration file}
                            {--f|factory : Create a factory file}
                            {--s|seeder : Create a seeder file}
                            {--r|requests : Create Store and Update request files}
                            {--R|resources : Create Resource and Collection files}
                            {--repo|repository : Create repository interface and implementation}
                            {--S|service : Create service interface and implementation}
                            {--i|interfaces : Create all interfaces (same as --repository --service)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create all relevant files for a new entity following SOLID architecture';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $name = Str::studly($this->argument('name'));
        $all = $this->option('all');

        $this->info("Creating entity: {$name}");

        // Always create Model and Controller
        $this->createModel($name, $all);
        $this->createController($name);

        // Optional files based on flags
        if ($all || $this->option('requests')) {
            $this->createRequests($name);
        }

        if ($all || $this->option('resources')) {
            $this->createResources($name);
        }

        if ($all || $this->option('repository') || $this->option('interfaces')) {
            $this->createRepositoryInterface($name);
            $this->createRepository($name);
        }

        if ($all || $this->option('service') || $this->option('interfaces')) {
            $this->createServiceInterface($name);
            $this->createService($name);
        }

        // Register bindings reminder
        if ($all || $this->option('repository') || $this->option('service') || $this->option('interfaces')) {
            $this->newLine();
            $this->warn('Remember to register bindings in AppServiceProvider:');
            $this->line("  \$this->app->bind(I{$name}Repository::class, {$name}Repository::class);");
            $this->line("  \$this->app->bind(I{$name}Service::class, {$name}Service::class);");
        }

        // Route reminder
        $this->newLine();
        $this->warn('Remember to add the route in routes/api.php:');
        $routeName = Str::snake(Str::plural($name));
        $this->line("  Route::apiResource('{$routeName}', {$name}Controller::class);");

        $this->newLine();
        $this->info("Entity {$name} created successfully!");

        return Command::SUCCESS;
    }

    /**
     * Create the model with optional migration, factory, and seeder.
     */
    protected function createModel(string $name, bool $all): void
    {
        $options = ['name' => $name];

        if ($all || $this->option('migration')) {
            $options['--migration'] = true;
        }

        if ($all || $this->option('factory')) {
            $options['--factory'] = true;
        }

        if ($all || $this->option('seeder')) {
            $options['--seed'] = true;
        }

        $this->call('make:model', $options);
    }

    /**
     * Create the API resource controller with service injection.
     */
    protected function createController(string $name): void
    {
        $lowerName = Str::camel($name);
        $pluralName = Str::plural($name);
        $lowerPluralName = Str::camel($pluralName);

        $stub = <<<PHP
<?php

namespace App\Http\Controllers;

use App\Http\Requests\\{$name}Store;
use App\Http\Requests\\{$name}Update;
use App\Http\Resources\\{$name}Collection;
use App\Http\Resources\\{$name}Resource;
use App\Interfaces\I{$name}Service;
use App\Models\\{$name};
use Illuminate\Http\JsonResponse;


/**
 * @group {$pluralName}
 *
 * Endpoints for managing {$lowerPluralName}
 */
class {$name}Controller extends Controller
{
    public function __construct(
        private I{$name}Service \${$lowerName}Service
    ) {}

    /**
     * Display a listing of {$lowerPluralName}.
     *
     * @authenticated
     */
    public function index(): {$name}Collection
    {
        return new {$name}Collection(\$this->{$lowerName}Service->getAll());
    }

    /**
     * Store a newly created {$lowerName} in storage.
     *
     * @authenticated
     */
    public function store({$name}Store \$request): JsonResponse
    {
        \${$lowerName} = \$this->{$lowerName}Service->create(\$request->validated());

        return (new {$name}Resource(\${$lowerName}))
            ->response()
            ->setStatusCode(JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified {$lowerName}.
     *
     * @authenticated
     */
    public function show({$name} \${$lowerName}): {$name}Resource
    {
        return new {$name}Resource(\$this->{$lowerName}Service->getById(\${$lowerName}->id));
    }

    /**
     * Update the specified {$lowerName} in storage.
     *
     * @authenticated
     */
    public function update({$name}Update \$request, {$name} \${$lowerName}): {$name}Resource
    {
        return new {$name}Resource(\$this->{$lowerName}Service->update(\$request->validated(), \${$lowerName}->id));
    }

    /**
     * Remove the specified {$lowerName} from storage.
     *
     * @authenticated
     */
    public function destroy({$name} \${$lowerName}): {$name}Resource
    {
        return new {$name}Resource(\$this->{$lowerName}Service->delete(\${$lowerName}->id));
    }
}
PHP;

        $this->ensureDirectoryExists(app_path('Http/Controllers'));
        $path = app_path("Http/Controllers/{$name}Controller.php");
        $this->writeFile($path, $stub, "{$name}Controller");
    }

    /**
     * Create Store and Update form requests.
     */
    protected function createRequests(string $name): void
    {
        $this->call('make:request', ['name' => "{$name}Store"]);
        $this->call('make:request', ['name' => "{$name}Update"]);
    }

    /**
     * Create API Resource and Collection.
     */
    protected function createResources(string $name): void
    {
        $this->createResourceFile($name);
        $this->createCollectionFile($name);
    }

    /**
     * Create the API Resource file.
     */
    protected function createResourceFile(string $name): void
    {
        $stub = <<<PHP
<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class {$name}Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request \$request): array
    {
        return [
            'id' => \$this->id,
            // Add your fields here
            'createdAt' => \$this->created_at,
            'updatedAt' => \$this->updated_at,
        ];
    }

}
PHP;

        $this->ensureDirectoryExists(app_path('Http/Resources'));
        $path = app_path("Http/Resources/{$name}Resource.php");
        $this->writeFile($path, $stub, "{$name}Resource");
    }

    /**
     * Create the API Collection file.
     */
    protected function createCollectionFile(string $name): void
    {
        $stub = <<<PHP
<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class {$name}Collection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public \$collects = {$name}Resource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request \$request): array
    {
        return [
            'metadata' => [],
            'data' => \$this->collection,
        ];
    }
}
PHP;

        $this->ensureDirectoryExists(app_path('Http/Resources'));
        $path = app_path("Http/Resources/{$name}Collection.php");
        $this->writeFile($path, $stub, "{$name}Collection");
    }

    /**
     * Create the repository interface.
     */
    protected function createRepositoryInterface(string $name): void
    {
        $stub = <<<PHP
<?php

namespace App\Interfaces;

use App\Models\\{$name};

/**
 * {$name}-specific repository interface.
 *
 * Extends generic CRUD operations and can define {$name}-specific methods.
 *
 * @extends ICrudRepository<{$name}>
 */
interface I{$name}Repository extends ICrudRepository
{
    // Add {$name}-specific repository methods here if needed
}
PHP;

        $this->ensureDirectoryExists(app_path('Interfaces'));
        $path = app_path("Interfaces/I{$name}Repository.php");
        $this->writeFile($path, $stub, "I{$name}Repository");
    }

    /**
     * Create the Eloquent repository implementation.
     */
    protected function createRepository(string $name): void
    {
        $stub = <<<PHP
<?php

namespace App\Repositories;

use App\Interfaces\I{$name}Repository;
use App\Models\\{$name};

/**
 * Eloquent implementation of I{$name}Repository.
 *
 * Inherits CRUD operations from base class.
 * Add {$name}-specific methods here if needed.
 */
class {$name}Repository extends CrudRepository implements I{$name}Repository
{
    public function __construct({$name} \$model)
    {
        parent::__construct(\$model);
    }

    // Add {$name}-specific repository methods here if needed
}
PHP;

        $this->ensureDirectoryExists(app_path('Repositories'));
        $path = app_path("Repositories/{$name}Repository.php");
        $this->writeFile($path, $stub, "{$name}Repository");
    }

    /**
     * Create the service interface.
     */
    protected function createServiceInterface(string $name): void
    {
        $stub = <<<PHP
<?php

namespace App\Interfaces;

use App\Models\\{$name};

/**
 * {$name}-specific service interface.
 *
 * Extends generic CRUD operations and can define {$name}-specific methods.
 *
 * @extends ICrudService<{$name}>
 */
interface I{$name}Service extends ICrudService
{
    // Add {$name}-specific service methods here if needed
}
PHP;

        $this->ensureDirectoryExists(app_path('Interfaces'));
        $path = app_path("Interfaces/I{$name}Service.php");
        $this->writeFile($path, $stub, "I{$name}Service");
    }

    /**
     * Create the service implementation.
     */
    protected function createService(string $name): void
    {
        $stub = <<<PHP
<?php

namespace App\Services;

use App\Interfaces\I{$name}Service;
use App\Interfaces\I{$name}Repository;

/**
 * {$name} service implementation.
 *
 * Inherits CRUD operations from base class.
 * Add {$name}-specific business logic here if needed.
 */
class {$name}Service extends CrudService implements I{$name}Service
{
    // Define default relations to eager load (optional)
    // protected array \$defaultRelations = [];

    public function __construct(I{$name}Repository \$repository)
    {
        parent::__construct(\$repository);
    }

    // Add {$name}-specific business logic here if needed
}
PHP;

        $this->ensureDirectoryExists(app_path('Services'));
        $path = app_path("Services/{$name}Service.php");
        $this->writeFile($path, $stub, "{$name}Service");
    }

    /**
     * Ensure a directory exists.
     */
    protected function ensureDirectoryExists(string $path): void
    {
        if (! File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true);
        }
    }

    /**
     * Write content to a file if it doesn't exist.
     */
    protected function writeFile(string $path, string $content, string $name): void
    {
        if (File::exists($path)) {
            $this->warn("  {$name} already exists, skipping.");

            return;
        }

        File::put($path, $content);
        $this->info("  Created: {$name}");
    }
}
