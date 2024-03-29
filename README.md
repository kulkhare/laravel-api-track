# API Track
  This laravel project can be used to track the API request made by consumers and show its logs to admin dashboard.
  The API users is assigned with the API token when they signup.
# Server Requirements
    PHP: 7.1.3 or greater
    PDO PHP extension
    JSON PHP extension
    OpenSSL PHP extension
    Tokenizer PHP extension
    XML PHP extension
    Mbstring PHP extension
    Ctype PHP extension
    BCMath PHP extension

# Steps to install project on local server
  1. Clone the project on server location.
  2. cd into the project directory.
  3. Run ```composer install ```
  4. Run ```composer dump-autoload``` 
  5. Add database settings in .env file based on your database config.
  6. Run ```sudo chmod -R 777 /storage```
  7. Run ```php artisan migrate:refresh --seed``` to migrate database and seed, it will create default admin and some posts for API testing.
  8. Run ```php artisan serve``` to access the project.

### Project URL:
```sh
http://localhost:8000
```
Admin username: **kul@test.com**
Admin password: **password**

To access the API please import the below collection in postman
[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/e600c094a880945486fd)

### API Login:
```sh
http://localhost:8000/api/login
Parameter: email, password
Method: POST
```
### API Signup:
```sh
http://localhost:8000/api/register
Parameter: name, email, password, c_password
Method: POST
```
#### In response to login the token will be sent, which can be used to access the posts API.

### API Posts:
```sh
http://localhost:8000/api/posts
Header: Authorization
Method: GET
```
License
----
MIT
**Free Software!**
