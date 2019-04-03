OZA\Database\Query\Relations\ManyToOne
===============






* Class name: ManyToOne
* Namespace: OZA\Database\Query\Relations





Properties
----------


### $entity

    protected \OZA\Database\Query\Entity $entity

The related entity



* Visibility: **protected**


### $column

    private string $column





* Visibility: **private**


### $related

    private string $related





* Visibility: **private**


### $value

    private mixed $value





* Visibility: **private**


Methods
-------


### __construct

    mixed OZA\Database\Query\Relations\ManyToOne::__construct(string $related, string $column, $value)

ManyToOne constructor.



* Visibility: **public**


#### Arguments
* $related **string**
* $column **string**
* $value **mixed**



### entity

    \OZA\Database\Query\Entity OZA\Database\Query\Relations\ManyToOne::entity()

Resolve related entity



* Visibility: **protected**




### addFetchingWhereClause

    \OZA\Database\Query\QueryBuilder OZA\Database\Query\Relations\ManyToOne::addFetchingWhereClause()

Add Where clause when we want to fetch results



* Visibility: **protected**




### getQuery

    \OZA\Database\Query\EntityQueryBuilder OZA\Database\Query\Relations\ManyToOne::getQuery()

Get Entity Query



* Visibility: **public**




### toSql

    string OZA\Database\Query\Relations\ManyToOne::toSql()

Get Query Sql



* Visibility: **public**




### get

    mixed OZA\Database\Query\Relations\ManyToOne::get()

Get Results



* Visibility: **public**




### find

    mixed OZA\Database\Query\Relations\ManyToOne::find(integer $id)

Get a specific row with its id



* Visibility: **public**


#### Arguments
* $id **integer**



### where

    \OZA\Database\Query\Relations\ManyToOne OZA\Database\Query\Relations\ManyToOne::where($column, $operator, $value)

Add where clause to query



* Visibility: **public**


#### Arguments
* $column **mixed**
* $operator **mixed**
* $value **mixed**



### orWhere

    \OZA\Database\Query\Relations\ManyToOne OZA\Database\Query\Relations\ManyToOne::orWhere($column, $operator, $value)

Add or where clause to query



* Visibility: **public**


#### Arguments
* $column **mixed**
* $operator **mixed**
* $value **mixed**



### first

    mixed OZA\Database\Query\Relations\ManyToOne::first()

Get First row



* Visibility: **public**




### limit

    \OZA\Database\Query\Relations\ManyToOne OZA\Database\Query\Relations\ManyToOne::limit(integer $limit)

Limit query



* Visibility: **public**


#### Arguments
* $limit **integer**



### create

    boolean|\OZA\Database\Query\Entity OZA\Database\Query\Relations\ManyToOne::create(array $attributes)

Create related data



* Visibility: **public**


#### Arguments
* $attributes **array**



### whereIn

    \OZA\Database\Query\Relations\ManyToOne OZA\Database\Query\Relations\ManyToOne::whereIn(string $column, array $data)

Add WhereIn Clause



* Visibility: **public**


#### Arguments
* $column **string**
* $data **array**



### orWhereIn

    \OZA\Database\Query\Relations\ManyToOne OZA\Database\Query\Relations\ManyToOne::orWhereIn(string $column, array $data)

Add or WhereIn clause



* Visibility: **public**


#### Arguments
* $column **string**
* $data **array**



### __call

    mixed OZA\Database\Query\Relations\ManyToOne::__call($name, $arguments)

Call entity methods



* Visibility: **public**


#### Arguments
* $name **mixed**
* $arguments **mixed**


