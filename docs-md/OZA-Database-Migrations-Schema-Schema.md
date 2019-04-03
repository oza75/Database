OZA\Database\Migrations\Schema\Schema
===============






* Class name: Schema
* Namespace: OZA\Database\Migrations\Schema





Properties
----------


### $db

    protected \OZA\Database\Db $db





* Visibility: **protected**


### $command

    protected string $command





* Visibility: **protected**


### $availableCommands

    protected array $availableCommands = array('create', 'alter', 'drop')

List of available commands



* Visibility: **protected**


Methods
-------


### __construct

    mixed OZA\Database\Migrations\Schema\Schema::__construct()

Schema constructor.



* Visibility: **public**




### setCommand

    mixed OZA\Database\Migrations\Schema\Schema::setCommand(string $command)

Set schema command



* Visibility: **protected**


#### Arguments
* $command **string**



### execute

    boolean OZA\Database\Migrations\Schema\Schema::execute(\OZA\Database\Migrations\Table $table)





* Visibility: **protected**


#### Arguments
* $table **OZA\Database\Migrations\Table**


