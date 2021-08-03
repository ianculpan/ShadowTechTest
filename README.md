
# Shadow API Test Submission - Ian Culpan

Implemented 2 artisan commands to import books.csv and book-meta.csv

Please place these files in Laravel storage/app directory

### Example commands to import the data

php artisan import:book-data -f books.csv

php artisan import:book-metadata -f book-meta.csv

The prompts are self-explanatory.

## Tests

Currently, the tests are taken from an example on Laracasts and are functional tests.
They do not mock the database so running the tests will reset any data loaded.
