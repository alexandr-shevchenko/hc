- Load the project to your local machine:
```
~ git clone git@github.com:alexandr-shevchenko/hc.git
```

- Create and start services by docker-compose:
```
~ docker-compose up -d
```

- Set all the dependencies for application:
```
~ docker exec helpcrunch_app.php-fpm composer install
```

- Create db and execute a migration to database:
```
~ docker exec helpcrunch_app.php-fpm php bin/console d:d:create
~ docker exec helpcrunch_app.php-fpm php bin/console d:m:m
```

- Upload fixtures to database:
```
~ docker exec helpcrunch_app.php-fpm php bin/console hautelook:fixtures:load
```

- To add new field to table run console command:
```
~ docker exec helpcrunch_app.php-fpm php bin/console app:user:update
```

- To revert changes run console command:
```
~ docker exec helpcrunch_app.php-fpm php bin/console app:user:rollback
```
