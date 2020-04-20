- Load the project to your local machine:
```
~ git clone https://github.com/alexandr-shevchenko/hc.git
```

- Create and start services by docker-compose:
```
~ docker-compose up -d
```

- Enter  docker container
```
docker-compose exec php-fpm sh
```

- Set all the dependencies for application:
```
composer install
```

- Create db and execute a migration to database:
```
bin/console d:d:create
bin/console d:m:m
```

- Upload fixtures to database:
```
bin/console hautelook:fixtures:load
```

- To add new field to table run console command:
```
bin/console app:user:update
```

- To revert changes run console command:
```
bin/console app:user:rollback
```

to connect to local db use this credentials:
host: localhost
user: developer
pass: password
port: 5432