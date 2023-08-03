# Football Player Statistics
Built with the following technologies
- [Laravel 10](https://laravel.com/)
- [Bootstrap v5.3](https://getbootstrap.com/)
- [jQuery](https://jquery.com/)
- [MySQL 8](https://www.mysql.com/)
- [Docker](https://www.docker.com/)

*Postman Documentation included*

## Prerequisite
- Make File
- Docker Service
- Docker Compose

This project utilizes a Makefile to automate builds and tasks.

If you dont have make in your machine you can copy paste the commands in Makefile

You may run `make help` to list available commands. 

## Setup
1. Clone this repo
2. Generate .env file via `make env-dev`, configure as needed.
3. Build and start docker images by running the following commands in order:
```bash
make start
make composer-install
make npm-install
make npm-build

# Optional for Vite HMR
make npm-run-dev
```

5. Setup DB Migration and seed.
```bash
make migrate
make db-dump
```

6. Generate key for the application
```bash
make key-gen
```

7. App is accessible thru [http://localhost](http://localhost)

## Starting/Stopping the environment
```bash
make start
make stop
```
## Checking code standards (PHPStan & PHPInsights)

```bash
make phpstan
make phpinsights
```

## Implemented Feature
- Database Schema Migrations
- Data migration
  - Data with missing FKs are skipped
  - Match with missing name are also skipped
- Request validation
- Frontend SPA Implementation.
    - Datatables
    - Pagination
    - Filter
        - Year
        - Statistics Type

## Improvements
> The following was not implemented due to lack of time considering the time expectations to finish the app
 - Cross-checking primary IDs if migrated into an existing database with full of data,
 - Currently, Match data are delete restricted, depending on requirements can be changed to cascade.
 - param_id and param_name can have separate table for better normalization.
 - Provide instructions how to use import scripts instead of providing the SQL dump.
 - Frontend features such as:
   - Multiple fields search
   - Sortable columns


## License
[The MIT License (MIT)](LICENSE)
