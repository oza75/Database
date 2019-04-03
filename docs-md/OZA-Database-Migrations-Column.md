OZA\Database\Migrations\Column
===============






* Class name: Column
* Namespace: OZA\Database\Migrations





Properties
----------


### $name

    private string $name





* Visibility: **private**


### $type

    protected mixed $type = array('type' => null)





* Visibility: **protected**


### $table

    protected \OZA\Database\Migrations\Table $table





* Visibility: **protected**


Methods
-------


### __construct

    mixed OZA\Database\Migrations\Column::__construct(string $name, \OZA\Database\Migrations\Table $table)

Column constructor.



* Visibility: **public**


#### Arguments
* $name **string**
* $table **OZA\Database\Migrations\Table**



### __toString

    string OZA\Database\Migrations\Column::__toString()





* Visibility: **public**




### toSql

    string OZA\Database\Migrations\Column::toSql()





* Visibility: **public**




### type

    \OZA\Database\Migrations\Column OZA\Database\Migrations\Column::type(string $type, null $length)





* Visibility: **public**


#### Arguments
* $type **string**
* $length **null**



### getType

    array OZA\Database\Migrations\Column::getType()





* Visibility: **public**




### getName

    string OZA\Database\Migrations\Column::getName()





* Visibility: **public**




### getTable

    \OZA\Database\Migrations\Table OZA\Database\Migrations\Column::getTable()





* Visibility: **public**



