# survey-app
Kindly follow the below given instructions in order to setup this code. Moreover the requirements 
are also mentioned below together with ERD


## System Requirements

- PHP version 5.6.4 or higher
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- MySQL
- Apache or Nginx Server
 
## Configuration

Open a file named .env and update the configuration following conguration 

```
APP_ENV=local
APP_DEBUG=true
APP_KEY=base64:hfxDQbDC0JEIKdBRzou+DEQanbAck7GJG+jo3qhg/jc=
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<DATABASE NAME>
DB_USERNAME=<DATABASE USERNAME>
DB_PASSWORD=<DATABASE PASSWORD>

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

MAIL_DRIVER=smtp
MAIL_HOST=<HOST NAME>
MAIL_PORT=587
MAIL_FROM=<EMAIL ADDRESS>
MAIL_FROM_NAME=<NAME>
MAIL_USERNAME=<USER NAME>
MAIL_PASSWORD=<PASSWORD>
MAIL_ENCRYPTION=tls


REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

```

## Installation

Open terminal or command prompt and execute the following command by changing your path to directory of this api

```
php composer.phar install
```
Create a database with same name as the one mentioned in .env file DB_DATABASE=<DATABASE NAME> and execute following command
in terminal/command prompt

```
php artisan migrate
```
It will show the migrations that have executed successfully

## Seeding Data

Use the following command for seeding data survey data
```
php artisan db:seed
```

## Depoying Application

In order to deploy the application use the following command
```
php artisan serve
```
By default the above command will use localhost host and 8000 port but one can override it as following 

```
php artisan serve --host=127.0.0.1 --port=8001
```


## Entity Relationship Diagram

![ERD](https://raw.githubusercontent.com/RazaChohan/survey-app/development/ERD.jpg)










