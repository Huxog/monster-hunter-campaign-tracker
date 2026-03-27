# app/Http/ — HTTP Layer Conventions

## Controllers

- Inject the **service interface** in the constructor, never the concrete service
- Methods return `Resource`, `Collection`, or `JsonResponse` — no raw arrays
- Use `FormatExceptionResponse` trait on every controller
- `store` returns a `JsonResponse` wrapping the Resource with `HTTP_CREATED` (201)
- `index` returns a Collection
- `show`, `update`, `destroy` return a Resource directly
- Use route model binding in `show`, `update`, `destroy` — accept the model, pass `$model->id` to the service
- PHPDoc every method with `@group`, `@authenticated`, and `@queryParam`/`@bodyParam` as applicable

```php
// Correct store pattern
public function store(EntityStore $request): JsonResponse
{
    $entity = $this->entityService->create($request->validated());
    return (new EntityResource($entity))->response()->setStatusCode(JsonResponse::HTTP_CREATED);
}
```

### Auth Controller Exception

`AuthController` is the **only controller exempt from the service/repository layer rule**. It directly uses `User::create()` and `Auth::user()` because auth operations (register, login, logout, me) are framework-level concerns handled by Sanctum — not business logic that belongs in a service. Do not add a `UserService` or `UserRepository` to "fix" this; it would add complexity with no benefit.

The auth flow is:
- `register` — `RegisterRequest` → `User::create()` → assign `player` role → issue Sanctum token
- `login` — `LoginRequest` → `Auth::attempt()` → `Auth::user()` → issue Sanctum token
- `logout` — delete current access token via `auth()->user()->currentAccessToken()->delete()`
- `me` — return `UserResource` for `auth()->user()`

## FormRequests

- Always use the `FormatValidationFailure` trait
- `authorize()` always returns `true` (authorization is handled by route middleware)
- Define `rules()`, `messages()`, and `codes()` — all three are required
- Define `bodyParameters()` for Scribe API documentation

### Error Code Format

```
[ENTITY]-[LEVEL][ROUTE]-[SEQUENCE]
```

| Segment | Values |
|---|---|
| ENTITY | 3-char entity prefix: `MAP`, `CAM`, `HNT`, `EQP`, `WPN`, `MAT`, `AUT`, `QST`, etc. |
| LEVEL | `01` middleware · `02` controller/request · `03` service · `04` model · `05` other |
| ROUTE | `01` index · `02` store · `03` show · `04` update · `05` delete · `06` custom |
| SEQUENCE | 4-digit sequential number per rule, starting at `0001` |

Examples:
- `MAP-0202-0001` — Map, request validation (02), store (02), first rule
- `CAM-0202-0003` — Campaign, request validation, store, third rule
- `AUT-0302-0001` — Auth, service/business logic (03), custom (02 in auth context), first rule

Every field + rule combination gets its own code. Codes must be unique within a request class.

## Resources

- `Resource` extends `JsonResource`, `Collection` extends `ResourceCollection`
- Collections must declare `public $collects = EntityResource::class`
- Collection `toArray()` always returns `['metadata' => [], 'data' => $this->collection]`
- Resource keys use **camelCase** (e.g., `createdAt`, `updatedAt`, `teamName`)
- Use `$this->whenLoaded('relation')` for optional relations — never eager load unconditionally in a resource
- Never expose `deleted_at` in resources
