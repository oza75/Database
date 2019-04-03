OZA\Database\Compiler\TableCompiler
===============

Class SQLCompiler




* Class name: TableCompiler
* Namespace: OZA\Database\Compiler
* Parent class: [OZA\Database\Compiler\SQLCompiler](OZA-Database-Compiler-SQLCompiler.md)





Properties
----------


### $separator

    protected mixed $separator = ','





* Visibility: **protected**


### $table

    protected \OZA\Database\Migrations\Table $table





* Visibility: **protected**


### $command

    protected string $command





* Visibility: **protected**


### $parts

    protected mixed $parts = array()





* Visibility: **protected**


Methods
-------


### compile

    string OZA\Database\Compiler\TableCompiler::compile(\OZA\Database\Migrations\Table $table)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $table **OZA\Database\Migrations\Table**



### compileCommand

    \OZA\Database\Compiler\TableCompiler OZA\Database\Compiler\TableCompiler::compileCommand()

Compile Command



* Visibility: **private**




### compileName

    \OZA\Database\Compiler\TableCompiler OZA\Database\Compiler\TableCompiler::compileName()

Compile Table name



* Visibility: **private**




### compileColumns

    \OZA\Database\Compiler\TableCompiler OZA\Database\Compiler\TableCompiler::compileColumns()

Compile All Column



* Visibility: **private**




### compilePrimaryKeys

    \OZA\Database\Compiler\TableCompiler OZA\Database\Compiler\TableCompiler::compilePrimaryKeys()

Compile all primary keys



* Visibility: **private**




### compileUniqueKeys

    mixed OZA\Database\Compiler\TableCompiler::compileUniqueKeys()





* Visibility: **private**




### compileConstraints

    \OZA\Database\Compiler\TableCompiler OZA\Database\Compiler\TableCompiler::compileConstraints()

Compile Contraints



* Visibility: **private**




### compileIndexes

    mixed OZA\Database\Compiler\TableCompiler::compileIndexes()





* Visibility: **private**




### compileForeignKeys

    mixed OZA\Database\Compiler\TableCompiler::compileForeignKeys()





* Visibility: **private**




### setCommand

    \OZA\Database\Compiler\TableCompiler OZA\Database\Compiler\TableCompiler::setCommand(string $command)





* Visibility: **public**


#### Arguments
* $command **string**



### quotes

    array OZA\Database\Compiler\TableCompiler::quotes(array $array)

Quotes values



* Visibility: **protected**


#### Arguments
* $array **array**



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


