OZA\Database\Compiler\QueryCompiler
===============

Class SQLCompiler




* Class name: QueryCompiler
* Namespace: OZA\Database\Compiler
* Parent class: [OZA\Database\Compiler\SQLCompiler](OZA-Database-Compiler-SQLCompiler.md)





Properties
----------


### $separator

    protected mixed $separator = ','





* Visibility: **protected**


### $query

    protected \OZA\Database\Query\QueryBuilder $query





* Visibility: **protected**


### $parts

    protected mixed $parts = array()





* Visibility: **protected**


Methods
-------


### compile

    string OZA\Database\Compiler\QueryCompiler::compile(\OZA\Database\Query\QueryBuilder $query)





* Visibility: **public**
* This method is **static**.


#### Arguments
* $query **OZA\Database\Query\QueryBuilder**



### compileCommand

    mixed OZA\Database\Compiler\QueryCompiler::compileCommand()





* Visibility: **private**




### compileTableName

    mixed OZA\Database\Compiler\QueryCompiler::compileTableName()





* Visibility: **private**




### compileWhereClauses

    mixed OZA\Database\Compiler\QueryCompiler::compileWhereClauses()





* Visibility: **private**




### compileWhereClauseSubQuery

    mixed OZA\Database\Compiler\QueryCompiler::compileWhereClauseSubQuery(array $clause)





* Visibility: **private**


#### Arguments
* $clause **array**



### compileSelect

    \OZA\Database\Compiler\QueryCompiler|\OZA\Database\Compiler\SQLCompiler OZA\Database\Compiler\QueryCompiler::compileSelect()

Compile select



* Visibility: **private**




### compileInsert

    mixed OZA\Database\Compiler\QueryCompiler::compileInsert()





* Visibility: **private**




### compileUpdate

    mixed OZA\Database\Compiler\QueryCompiler::compileUpdate()





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


