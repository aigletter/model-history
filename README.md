### Configuration

To save history into the database the package needs to know which database connection to use and what the name of the table is.
By default the package will use the default database connection and use a table named `history`.
If you want to change these options, you'll have to publish the `config` file.

    php artisan vendor:publish --provider="Aigletter\ModelHistory\ModelHistoryServiceProvider" --tag="config"

This will give you a `model-history.php` config file in which you can make the changes.

To make your life easy, the package also includes a ready to use `migration` which you can publish by running:

    php artisan vendor:publish --provider="Aigletter\ModelHistory\ModelHistoryServiceProvider" --tag="migrations"
    
This will place a `history` table's migration file into `database/migrations` directory. Now all you have to do is run `php artisan migrate` to migrate your database.
