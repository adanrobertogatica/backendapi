### Requirements
- PHP = 8.1
- Laravel >= 9.14
- MySQL database
- 
### Installation
Create .env file in project directory.
Copy the content of .env.example to the new file.

Configure the following settings:

    DB_HOST= ip or domain of your MySQL database
    DB_PORT= port of your MySQL
    DB_DATABASE= name of your Database
    DB_USERNAME= MySQL user
    DB_PASSWORD= MySQL password (if not you have to leave blank)
    
    IMPORTANT!!!!!!!!
    L5_SWAGGER_CONST_HOST= domain and port of your environment where your API will run locally (example http://adanexample.test:80)

Enter the project directory through the console and execute:
    composer install

    php artisan migrate

API documentation: apidomain:port/api/documentation (L5_SWAGGER_CONST_HOST/api/documentation)
In any case, if you enter the system you will see a link to the Swagger API documentation on the home page.

If you want to load random data run
    php artisan db:seed
    
### Test
Remember that for unit tests it is necessary to edit the phpunit.xml file
    <server name="DB_CONNECTION" value="mysql"/>
    <server name="DB_DATABASE" value="yourdatabasename"/>
    
    php artisan test
