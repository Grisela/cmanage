## Features

1. Have admin role to create, read, update and delete post </br>
2. User role can view and make a comment in the post made by admin </br>

I will be gradually adding more features in the future.

## Install

1. run ```composer install``` </br>
2. run ```npm install``` (please do run ```npm audit fix``` after if you find any vulnerabilities issue warning)</br>
3. make a copy of env.example and rename it to .env </br>
4. set up an empty database </br>
5. set up your .env file based on your database </br>
6. run ```php artisan storage:link```
7. run ```php artisan generate:key``` </br>
8. run ```php artisan migrate``` </br>

to add admin role just register a new user and edit the role in the database from _null_ to 1
