
# Shadow API Test Submission - Ian Culpan

Implemented 2 artisan commands to import books.csv and book-meta.csv

Please place these files in Laravel storage/app directory

## Installation

Assuming that you have checked out the repo from github

Configure a database schema and update the .env file with credentials.

composer install
npm install
npm run dev

The csv import files should be loaded into the laravel ./storage/app/ folder.

## Example commands to import the data

php artisan import:book-data -f books.csv

php artisan import:book-metadata -f book-meta.csv

The prompts are self-explanatory.

## Tests

Currently, the tests are taken from an example on Laracasts and are functional tests.
They do not mock the database so running the tests will reset any data loaded.

## Front end

The data can be queried by using the simple vue pages.
They are a basic and simple way of viewing the loaded data.

