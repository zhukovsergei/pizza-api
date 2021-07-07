pizza-api is the REST API application for CRUD pizzas and set the prices

1. First up docker
   
   `docker-compose up -d`

2. Composer install

   `docker-compose run --rm php-cli php composer install`

3. Up the migrations

   `docker-compose run --rm php-cli php bin/console doc:mi:mi`

4. Load fixtures

   `docker-compose run --rm php-cli php bin/console doc:fixtures:load`

5. First send for obtain a token

POST http://localhost:8080/api/login_check 

`{"username":"admin@admin.admin","password":"admin"}`

You will receive something like:

`{"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2MjU2NzQ1NDcsImV4cCI6MTYyNTY3ODE0Nywicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoiYWRtaW5AYWRtaW4uYWRtaW4ifQ.iGDwZgNy5EMsou1__rQYgK0d_oDcPjoT70AXLpP3sTioyZjy9v-fBlcWzTGQBWjl8-J0-zDyo9eQPLrxfIcByvxDWZORsUvxv-QhsXJYyoRXZTbgPOwG32l5soA9HROJOAfS6lO3zOk2IwKWoRBA0iiNGnaj-E8deeEnZZw2jw56QPTsd6KLx3Ry5B-T_OwHtUT7lh7MIvA9_hjdj93mYW70cK6ANqOVi-eTunTXqtz-4zHK6WAmrOymKaWBWoMcXcjHhfMCdstVm1C74ZpyxPg4FGMEb8iD7r0TVXgaZWfBuGIbzlwA_kCM02sa3QIEDTt_RLQrO2ak3sg4_LDWIA"}`

6. Use this token as Bearer in Headers for requests

7. Api is available here `http://localhost:8080/api/doc`