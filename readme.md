
# PetShop

## Installation

- Clone project
- Go inside the project
- Run Docker compose
```bash
  docker compose up -d
``` 
- Go to laravel-petshop foler
```bash
  cd larave-petshop
``` 
- Copy .env file
```bash
  cp .env.example .env
``` 
- Run composer install
```bash
  composer install
```
- Run migration and seeder
```bash
  docker exec -it laravel-petshop php artisan migrate --seed
```


## Documentation

- [Swagger URL: http://localhost:9000/api/documentation](http://localhost:9000/api/documentation)

## Demo
- admin account
```bash
  email: admin@buckhill.co.uk
  password: admin
```
- php myadmin
```bash
  url: http://localhost:9001/
  server: mysql_db
  username: root
  password: root
```
## Running Tests

To run tests, run the following command

```bash
  docker exec -it laravel-petshop php artisan test
```

