pizza-api is the REST API application for CRUD pizzas and set the prices

0. Clone this repo.
   
1. Composer install

   `docker-compose run --rm php-cli composer install`

2. Up the migrations

   `docker-compose run --rm php-cli php bin/console doc:mi:mi`

3. Load fixtures [optional]

   `docker-compose run --rm php-cli php bin/console doc:fixtures:load`

4. Generate SSL keys

   `docker-compose run --rm php-cli php bin/console lexik:jwt:generate-keypair`

5. First up docker

   `docker-compose up -d`
   
6. First send for obtain a token

POST http://localhost:8080/api/login_check 

`{"username":"admin@admin.admin","password":"admin"}`

You will receive something like:

![img_4.png](img_4.png)

7. Use this token as Bearer in Headers for requests

![img_1.png](img_1.png)

8. Api documents is available here `http://localhost:8080/api/doc`

![img_3.png](img_3.png)

9. Unit tests `docker-compose run --rm php-cli php bin/phpunit`

![img_2.png](img_2.png)