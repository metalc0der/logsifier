## Synopsis

Package to manage application logs.

## Code Example

Just use the Facade Logsifier to call any method.

Logsifier::store('192.168.1.1','users','1','New user created','Users module')

Don't forget this line at the begining of your file:

use Metalcoder/Logsifier/Logsifier;

## Motivation

I've been involved in several projects where is required to have some sort of log manipulation. I decided to create my own package first of all to introduce myself in package development and also to use it on my future projects.

## Installation

Install via composer:
1. Add the line "metalcoder/logsifier": "master-dev" to your app main composer in the require section.
2. Make composer update
3. Make php artisan migrate --path=vendor/metalcoder/logsifier/src/migrations to run the package migration in charge of the creation of log table.
4. Go to config/app.php in your app and add Metalcoder\Logsifier\MetalcoderLogsifierServiceProvider::class, to the providers section.
5. In config/app.php add 'Logsifier' => Metalcoder\Logsifier\Logsifier::class, to the aliases section.
6. In config/app.php add Maatwebsite\Excel\ExcelServiceProvider::class, to the providers section.
7. In config/app.php add 'Excel' => Maatwebsite\Excel\Facades\Excel::class, to the aliases section.
8. Make php artisan vendor:publish
9. Now you are ready to go.

## API Reference

The package exposes 4 methods (at the time) to help with the log of relevant events in any laravel application.

/* Method to store a log entry in the database
* Parameters: $ip : IP of the request
*			        $object : Name of the database table the event is using
*             $object_id : id of the element the event is using
*		          $description : Short descripcion of the event.
*             $source : Name of the application module that triggered the event
*             $urgent : If entry is marked as urgent an email will be sent to the recipients listed in config/logsifier.php
*/
Logsifier::store($ip,$object,$object_id,$description,$source,$urgent)

/* Method to show all the log entries
* 
*/
Logsifier::index()

/* Method to export to a CSV file all the log entries
* 
*/
Logsifier::exportCSV()

/* Method to export all entries to a CSV file and empty the log table.
*
*/
Logsifier::rotate()

## License

GNU GENERAL PUBLIC LICENSE

