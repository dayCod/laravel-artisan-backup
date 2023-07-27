# Laravel Artisan Backup
Laravel Artisan Backup is Package for Backup and Restore The Database, Artisan Backup made fast and easy

## Installation Guide
```bash
composer require daycode/artisan-backup
```

Go to config/app.php, then put these code on service providers
```php
'providers' => [
    /*
    * Package Service Providers...
    */
    \DayCod\ArtisanBackup\ArtisanBackupServiceProvider::class,
],
```

Last, for make sure this package installed correctly.
```bash
composer dump-autoload && php artisan optimize:clear
```

## Default Artisan Backup Directory Structure
```php
├── ...
├── database                    
|    ├── ...          
|    ├── backup          
|    |   ├── mysql       
|    |   ├── ...          
|    └── ...                
└── ...
```

## Usage Guide

### MySQL Backup
```bash
php artisan backup:db -t mysql 
```
Or
```bash
php artisan backup:db --type=mysql
```

## Contributors
- [Wirandra Alaya](https://github.com/dayCod)
- [See All Contributors](https://github.com/dayCod/laravel-artisan-backup/contributors)

## License
This project is released under the [MIT](http://opensource.org/licenses/MIT) license.

