**Test task of querying data from large dataset using CodeIgniter4 framework**

1) Start up
(Nginx, PHP 7.4, MySQL 5.7)

```docker-compose up -d```

2) Install dependencies

```docker-compose exec php composer install```

3) Run database migration
(app/Database/Migrations/2020-08-25-123526_Migration1.php)

```docker-compose exec php php spark migrate```

4) Fill database with data (1e6 rows. This may take a couple of minutes)
(app/Database/Seeds/FooSeeder.php)

```docker-compose exec php php spark db:seed FooSeeder```

5) Return JSON data
(app/Config/Routes.php)

```http://docker.local/dbs/foo/tables/source/json/[page]/[page_size]```

or

```http://docker.local/dbs/foo/tables/source/json?page=[page]&page_size=[page_size]```

6) Return CSV data (HTTP chunked response)

```http://docker.local/dbs/foo/tables/source/csv```

7) Run tests
(tests/unit/SourceDataTest.php)

```docker-compose exec php php ./vendor/bin/phpunit```