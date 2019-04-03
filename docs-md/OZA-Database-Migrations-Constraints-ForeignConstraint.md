OZA\Database\Migrations\Constraints\ForeignConstraint
===============






* Class name: ForeignConstraint
* Namespace: OZA\Database\Migrations\Constraints





Properties
----------


### $reference

    protected string $reference

The reference column



* Visibility: **protected**


### $table

    protected string $table

The reference table



* Visibility: **protected**


### $firstTable

    protected \OZA\Database\Migrations\Table $firstTable





* Visibility: **protected**


### $onDelete

    protected string $onDelete





* Visibility: **protected**


### $onUpdate

    protected string $onUpdate





* Visibility: **protected**


### $column

    private string $column

Concerned Column



* Visibility: **private**


### $name

    private string $name

The name of the key



* Visibility: **private**


Methods
-------


### __construct

    mixed OZA\Database\Migrations\Constraints\ForeignConstraint::__construct(\OZA\Database\Migrations\Table $table, string $column, string|null $name)

ForeignConstraint constructor.



* Visibility: **public**


#### Arguments
* $table **OZA\Database\Migrations\Table**
* $column **string**
* $name **string|null**



### references

    \OZA\Database\Migrations\Constraints\ForeignConstraint OZA\Database\Migrations\Constraints\ForeignConstraint::references(string $column)

Set reference column



* Visibility: **public**


#### Arguments
* $column **string**



### on

    \OZA\Database\Migrations\Constraints\ForeignConstraint OZA\Database\Migrations\Constraints\ForeignConstraint::on(string $table)

Set reference table



* Visibility: **public**


#### Arguments
* $table **string**



### toSql

    string OZA\Database\Migrations\Constraints\ForeignConstraint::toSql()

Get sql



* Visibility: **public**




### compile

    string OZA\Database\Migrations\Constraints\ForeignConstraint::compile()

Compile Constraint to sql



* Visibility: **protected**




### onDelete

    \OZA\Database\Migrations\Constraints\ForeignConstraint OZA\Database\Migrations\Constraints\ForeignConstraint::onDelete(string $type)

Set onDelete mode



* Visibility: **public**


#### Arguments
* $type **string**



### onUpdate

    \OZA\Database\Migrations\Constraints\ForeignConstraint OZA\Database\Migrations\Constraints\ForeignConstraint::onUpdate(string $type)

Set onUpdate mode



* Visibility: **public**


#### Arguments
* $type **string**


