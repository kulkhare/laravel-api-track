# kulshreshth khare API Test
Hello,
     - I have completed the task in laravel.
     - If you want me to do it in core PHP please let me know.
     - I have not used any package only laravel auth is used, API auth, token and middilware is used to complete the task.

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
