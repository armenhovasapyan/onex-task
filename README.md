## Project Requirements
- Web server (e.g., Apache, Nginx)
- PHP 8.2 or higher
- Composer
- MySQL or any other database supported by Laravel
- Postman (optional, for API testing)

### Migrations and Seeding

Run following command to run the database migrations and seed the database with test data:

```bash
  php artisan migrate --seed
```

### Running project

By opening home page (/) system will redirect to (docs/api) api based documentation page. You can use this documentation to test the API endpoints and see the expected request and response formats.

### Postman as API testing tool

Postman JSON collection is included in the project. You can import it to your Postman application
