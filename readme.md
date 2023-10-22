
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
  docker exec -it php artisan migrate --seed
```


## Documentation

- [Swagger URL: http://localhost:9000/api/documentation](http://localhost:9000/api/documentation)


## Running Tests

To run tests, run the following command

```bash
  docker exec -it laravel-petshop php artisan test
```

