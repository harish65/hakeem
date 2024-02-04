Additional Notes:
guzzle must be installed
composer required guzzlehttp/guzzle

add the property below in composer.json autoload->psr-4 on the laravel project
"MSMS\\": "packages/msms/src"

BroadcastTestController.php and the contents in routes.php files are just for testing the package via POSTMAN.
Modify route.php to use SMSBroadcastServiceProvider directly