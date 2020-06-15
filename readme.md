# ![Gararat](resources/images/header_logo.png)

[![GitHub license](https://img.shields.io/github/license/gothinkster/laravel-realworld-example-app.svg)](https://raw.githubusercontent.com/gothinkster/laravel-realworld-example-app/master/LICENSE)

----------


# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.7/installation#installation)


Clone the repository

    git clone git@github.com:gararat/gararat.git

Switch to the repo folder

    cd gararat

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone git@github.com:gararat/gararat.git
    cd gararat
    composer install
    cp .env.example .env
    php artisan key:generate
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh
    
    
## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.


## Assets

Installing Node

Before triggering Mix, you must first ensure that Node.js and NPM are installed on your machine.

    node -v
    npm -v
    
If Node.js not installed you can easily install the latest version of Node and NPM using simple graphical installers from [their download page](https://nodejs.org/en/download/).

Laravel Mix

Need to install frontend dependencies from `package.json` file

    npm install
    
Running Mix for website
    
    npm run dev
    

Running Mix for admin part:
    
    npm run admin-dev
    
        
# [Adminator HTML5 Admin Template](https://github.com/puikinsh/Adminator-admin-dashboard)

<img src="https://camo.githubusercontent.com/fa67acfe96d692f2115f562ce75730f2891edbb2/68747470733a2f2f636f6c6f726c69622e636f6d2f77702f77702d636f6e74656e742f75706c6f6164732f73697465732f322f61646d696e61746f722d667265652d61646d696e2d64617368626f6172642d74656d706c6174652e6a7067" width="600">



