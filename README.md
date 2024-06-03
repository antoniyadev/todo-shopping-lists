<h1 align="center">Welcome to TODO Shopping Lists 👋</h1>
<p>
</p>

> This app is for creating and managing TODO shopping lists and these lists can be send to a friend on a given date.

## Install
- Clone this repository locally with ```git clone git@github.com:antoniyadev/todo-shopping-lists.git```
- Copy the .env.example file to .env
- Install the PHP dependencies with ```composer install```
- Generate a new app key with ```php artisan key:generate```
- Prepare the database by running ```php artisan migrate --seed```
- Install and compile the front-end dependencies with ```npm install && npm run dev```
- Set a valid APP_URL, DB_DATABASE, DB_USERNAME, DB_PASSWORD value in your .env file
- Serve the website locally by running ```php artisan serve```

## Send Lists via email
- run ```php artisan app:send-scheduled-lists```

## Author

👤 **Antoniya**

* Website: https://antoniyadev.github.io
* Github: [@antoniyadev](https://github.com/antoniyadev)

## Show your support

Give a ⭐️ if this project helped you!

***
_This README was generated with ❤️ by [readme-md-generator](https://github.com/kefranabg/readme-md-generator)_
