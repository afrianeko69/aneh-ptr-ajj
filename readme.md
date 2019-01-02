# Pintaria

Pintaria adalah portal edukasi Indonesia

## Requirements

TODO: Describe the requirements setup

## Installation

1. Install the project dependencies: `composer install --prefer-dist`
1. Copy environment configuration file: `cp .env.example .env`
1. Add your database credentials
1. Update your website URL in `APP_URL` variable
1. Set your application key: `php artisan key:generate` 
1. Run all of your outstanding migrations: `php artisan migrate`
1. Dumps the autoloader: `composer dump-autoload`
1. Seed your database `php artisan db:seed --class=VoyagerDatabaseSeeder; php artisan db:seed --class=VoyagerDummyDatabaseSeeder`
1. Adding the storage symlink to your public folder: `php artisan storage:link`
1. Install JS project dependencies: `npm install` or even better `yarn`
1. Compile assets: `npm run production`
1. Make sure you have filled the GCS settings in .env file

## Usage

Start a development server: `php artisan serve`

## Contributing

1. Clone it!
2. Create your feature branch: `git flow feature start my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git flow feature publish my-new-feature`
5. Submit a pull request 🙂

## History

TODO: Write history

## Credits

TODO: Write credits

## License

TODO: Write license
