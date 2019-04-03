OZA\Database\Compiler\ColumnCompiler
===============

Class SQLCompiler




* Class name: ColumnCompiler
* Namespace: OZA\Database\Compiler
* Parent class: [OZA\Database\Compiler\SQLCompiler](OZA-Database-Compiler-SQLCompiler.md)





Properties
----------


### $column

    private \OZA\Database\Migrations\Column $column





* Visibility: **private**


### $separator

    protected mixed $separator = ','





* Visibility: **protected**


### $dontQuotesTypes

    protected mixed $dontQuotesTypes = array('TIMESTAMP', 'DATE', 'DATETIME')





* Visibility: **protected**


### $parts

    protected mixed $parts = array()





* Visibility: **protected**


Methods
-------


### compile

    string OZA\Database\Compiler\ColumnCompiler::compile(\OZA\Database\Migrations\Column $column)

Compile Column to sql



* Visibility: **public**
* This method is **static**.


#### Arguments
* $column **[OZA\Database\Migrations\Column](OZA-Database-Migrations-Column.md)**



### compileType

    \OZA\Database\Compiler\ColumnCompiler OZA\Database\Compiler\ColumnCompiler::compileType()

Compile Type



* Visibility: **protected**




### compileName

    \OZA\Database\Compiler\ColumnCompiler OZA\Database\Compiler\ColumnCompiler::compileName()





* Visibility: **private**




### compileDefault

    \OZA\Database\Compiler\ColumnCompiler OZA\Database\Compiler\ColumnCompiler::compileDefault()





* Visibility: **private**




### compileOnUpdate

    \OZA\Database\Compiler\ColumnCompiler OZA\Database\Compiler\ColumnCompiler::compileOnUpdate()

Compile on update expression



* Visibility: **private**




### parseDefault

    string OZA\Database\Compiler\ColumnCompiler::parseDefault($default)

Parse default value



* Visibility: **protected**


#### Arguments
* $default **mixed**



### compileNullable

    \OZA\Database\Compiler\ColumnCompiler OZA\Database\Compiler\ColumnCompiler::compileNullable()





* Visibility: **private**




### compileAutoIncrement

    \OZA\Database\Compiler\ColumnCompiler OZA\Database\Compiler\ColumnCompiler::compileAutoIncrement()





* Visibility: **private**




### compileUnsigned

    \OZA\Database\Compiler\ColumnCompiler OZA\Database\Compiler\ColumnCompiler::compileUnsigned()





* Visibility: **private**




### handle

    string OZA\Database\Compiler\SQLCompiler::handle()





* Visibility: **protected**
* This method is defined by [OZA\Database\Compiler\SQLCompiler](OZA-Database-Compiler-SQLCompiler.md)




### addPart

    \OZA\Database\Compiler\SQLCompiler OZA\Database\Compiler\SQLCompiler::addPart(string $sql)





* Visibility: **protected**
* This method is defined by [OZA\Database\Compiler\SQLCompiler](OZA-Database-Compiler-SQLCompiler.md)


#### Arguments
* $sql **string**


