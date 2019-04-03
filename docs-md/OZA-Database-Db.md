OZA\Database\Db
===============






* Class name: Db
* Namespace: OZA\Database





Properties
----------


### $driver

    private string $driver





* Visibility: **private**


### $host

    private string $host





* Visibility: **private**


### $username

    private string $username





* Visibility: **private**


### $password

    private string $password





* Visibility: **private**


### $pdo

    protected \PDO $pdo





* Visibility: **protected**


### $name

    private string $name





* Visibility: **private**


Methods
-------


### __construct

    mixed OZA\Database\Db::__construct(string $driver, string $host, string $name, string $username, string $password)

Db constructor.



* Visibility: **public**


#### Arguments
* $driver **string**
* $host **string**
* $name **string**
* $username **string**
* $password **string**



### fromConfig

    \OZA\Database\Db OZA\Database\Db::fromConfig()





* Visibility: **public**
* This method is **static**.




### initPdo

    mixed OZA\Database\Db::initPdo()





* Visibility: **private**




### getOptions

    array OZA\Database\Db::getOptions()





* Visibility: **protected**




### getPdo

    \PDO OZA\Database\Db::getPdo()





* Visibility: **public**




### dropAllTables

    mixed OZA\Database\Db::dropAllTables()

Drop all tables in db



* Visibility: **public**




### tableExists

    boolean OZA\Database\Db::tableExists(string $table)

Check if a table exists in the current database.



* Visibility: **public**


#### Arguments
* $table **string** - &lt;p&gt;Table to search for.&lt;/p&gt;


