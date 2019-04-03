## Table of contents

- [\OZA\Database\Config](#class-ozadatabaseconfig)
- [\OZA\Database\Db](#class-ozadatabasedb)
- [\OZA\Database\Compiler\TableCompiler](#class-ozadatabasecompilertablecompiler)
- [\OZA\Database\Compiler\ColumnCompiler](#class-ozadatabasecompilercolumncompiler)
- [\OZA\Database\Compiler\QueryCompiler](#class-ozadatabasecompilerquerycompiler)
- [\OZA\Database\Compiler\SQLCompiler](#class-ozadatabasecompilersqlcompiler)
- [\OZA\Database\Console\Cli](#class-ozadatabaseconsolecli)
- [\OZA\Database\Console\Commands\MigrationCommand](#class-ozadatabaseconsolecommandsmigrationcommand)
- [\OZA\Database\Console\Commands\BaseCommand](#class-ozadatabaseconsolecommandsbasecommand)
- [\OZA\Database\Console\Commands\MigrationRollbackCommand](#class-ozadatabaseconsolecommandsmigrationrollbackcommand)
- [\OZA\Database\Console\Commands\MigrateCommand](#class-ozadatabaseconsolecommandsmigratecommand)
- [\OZA\Database\Decorators\QueryBuilderDecorator](#class-ozadatabasedecoratorsquerybuilderdecorator)
- [\OZA\Database\Events\Emitter](#class-ozadatabaseeventsemitter)
- [\OZA\Database\Events\Event](#class-ozadatabaseeventsevent)
- [\OZA\Database\Exceptions\Column\InvalidTypeForAutoIncrement](#class-ozadatabaseexceptionscolumninvalidtypeforautoincrement)
- [\OZA\Database\Facade\BaseFacade (abstract)](#class-ozadatabasefacadebasefacade-abstract)
- [\OZA\Database\Facade\Query](#class-ozadatabasefacadequery)
- [\OZA\Database\Facade\TableNameResolver](#class-ozadatabasefacadetablenameresolver)
- [\OZA\Database\Facade\InsertQuery](#class-ozadatabasefacadeinsertquery)
- [\OZA\Database\Factory\SeederFactory](#class-ozadatabasefactoryseederfactory)
- [\OZA\Database\Helpers\ClassesFinder](#class-ozadatabasehelpersclassesfinder)
- [\OZA\Database\Helpers\Arr](#class-ozadatabasehelpersarr)
- [\OZA\Database\Helpers\Str](#class-ozadatabasehelpersstr)
- [\OZA\Database\Migrations\MigrationTable](#class-ozadatabasemigrationsmigrationtable)
- [\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)
- [\OZA\Database\Migrations\Table](#class-ozadatabasemigrationstable)
- [\OZA\Database\Migrations\MigrationTableMigration](#class-ozadatabasemigrationsmigrationtablemigration)
- [\OZA\Database\Migrations\Constraints\ForeignConstraint](#class-ozadatabasemigrationsconstraintsforeignconstraint)
- [\OZA\Database\Migrations\Interfaces\MigrationTableInterface (interface)](#interface-ozadatabasemigrationsinterfacesmigrationtableinterface)
- [\OZA\Database\Migrations\Interfaces\DatatypeInterface (interface)](#interface-ozadatabasemigrationsinterfacesdatatypeinterface)
- [\OZA\Database\Migrations\Schema\Schema](#class-ozadatabasemigrationsschemaschema)
- [\OZA\Database\Query\EntityQueryBuilder](#class-ozadatabasequeryentityquerybuilder)
- [\OZA\Database\Query\Entity](#class-ozadatabasequeryentity)
- [\OZA\Database\Query\TableNameResolver](#class-ozadatabasequerytablenameresolver)
- [\OZA\Database\Query\QueryBuilder](#class-ozadatabasequeryquerybuilder)
- [\OZA\Database\Query\InsertQuery](#class-ozadatabasequeryinsertquery)
- [\OZA\Database\Query\UpdateQuery](#class-ozadatabasequeryupdatequery)
- [\OZA\Database\Query\Relations\ManyToOne](#class-ozadatabasequeryrelationsmanytoone)

<hr /><a id="class-ozadatabaseconfig"></a>
### Class: \OZA\Database\Config

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>get(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$default=null</strong>)</strong> : <em>mixed</em> |
| public | <strong>getConfigs(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>null/array/mixed</em><br /><em>Get configuration data</em> |
| public | <strong>getFiles()</strong> : <em>array</em><br /><em>Get configurations files</em> |
| public static | <strong>instance()</strong> : <em>[\OZA\Database\Config](#class-ozadatabaseconfig)/null</em> |
| public | <strong>register(</strong><em>string/null/\string</em> <strong>$filename</strong>)</strong> : <em>void</em><br /><em>Register a config file</em> |
| protected | <strong>__construct(</strong><em>\string</em> <strong>$filename=null</strong>)</strong> : <em>void</em><br /><em>Config constructor.</em> |
| protected | <strong>load()</strong> : <em>mixed</em><br /><em>Load configurations</em> |

<hr /><a id="class-ozadatabasedb"></a>
### Class: \OZA\Database\Db

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\string</em> <strong>$driver</strong>, <em>\string</em> <strong>$host</strong>, <em>\string</em> <strong>$name</strong>, <em>\string</em> <strong>$username</strong>, <em>\string</em> <strong>$password</strong>)</strong> : <em>void</em><br /><em>Db constructor.</em> |
| public | <strong>dropAllTables()</strong> : <em>void</em><br /><em>Drop all tables in db</em> |
| public static | <strong>fromConfig()</strong> : <em>[\OZA\Database\Db](#class-ozadatabasedb)</em> |
| public | <strong>getPdo()</strong> : <em>\OZA\Database\PDO</em> |
| public | <strong>tableExists(</strong><em>\string</em> <strong>$table</strong>)</strong> : <em>bool TRUE if table exists, FALSE if no table found.</em><br /><em>Check if a table exists in the current database.</em> |
| protected | <strong>getOptions()</strong> : <em>array</em> |

<hr /><a id="class-ozadatabasecompilertablecompiler"></a>
### Class: \OZA\Database\Compiler\TableCompiler

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>compile(</strong><em>[\OZA\Database\Migrations\Table](#class-ozadatabasemigrationstable)</em> <strong>$table</strong>)</strong> : <em>string</em> |
| public | <strong>setCommand(</strong><em>\string</em> <strong>$command</strong>)</strong> : <em>[\OZA\Database\Compiler\TableCompiler](#class-ozadatabasecompilertablecompiler)</em> |
| protected | <strong>quotes(</strong><em>array</em> <strong>$array</strong>)</strong> : <em>array</em><br /><em>Quotes values</em> |

*This class extends [\OZA\Database\Compiler\SQLCompiler](#class-ozadatabasecompilersqlcompiler)*

<hr /><a id="class-ozadatabasecompilercolumncompiler"></a>
### Class: \OZA\Database\Compiler\ColumnCompiler

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>compile(</strong><em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em> <strong>$column</strong>)</strong> : <em>string</em><br /><em>Compile Column to sql</em> |
| protected | <strong>compileType()</strong> : <em>[\OZA\Database\Compiler\ColumnCompiler](#class-ozadatabasecompilercolumncompiler)</em><br /><em>Compile Type</em> |
| protected | <strong>parseDefault(</strong><em>mixed</em> <strong>$default</strong>)</strong> : <em>string</em><br /><em>Parse default value</em> |

*This class extends [\OZA\Database\Compiler\SQLCompiler](#class-ozadatabasecompilersqlcompiler)*

<hr /><a id="class-ozadatabasecompilerquerycompiler"></a>
### Class: \OZA\Database\Compiler\QueryCompiler

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>compile(</strong><em>[\OZA\Database\Query\QueryBuilder](#class-ozadatabasequeryquerybuilder)</em> <strong>$query</strong>)</strong> : <em>string</em> |

*This class extends [\OZA\Database\Compiler\SQLCompiler](#class-ozadatabasecompilersqlcompiler)*

<hr /><a id="class-ozadatabasecompilersqlcompiler"></a>
### Class: \OZA\Database\Compiler\SQLCompiler

> Class SQLCompiler

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>addPart(</strong><em>\string</em> <strong>$sql</strong>)</strong> : <em>\OZA\Database\Compiler\$this</em> |
| protected | <strong>handle()</strong> : <em>string</em> |

<hr /><a id="class-ozadatabaseconsolecli"></a>
### Class: \OZA\Database\Console\Cli

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>mixed</em> <strong>$argv</strong>, <em>mixed</em> <strong>$argc</strong>)</strong> : <em>void</em><br /><em>Cli constructor.</em> |
| public | <strong>process()</strong> : <em>void</em> |
| protected | <strong>allCommands()</strong> : <em>[\OZA\Database\Console\Cli](#class-ozadatabaseconsolecli)</em><br /><em>Get all available commands</em> |
| protected | <strong>arguments()</strong> : <em>array</em><br /><em>Get all arguments passed in command line</em> |
| protected | <strong>getAction()</strong> : <em>string/null</em><br /><em>Get $argv second argument which represent in our app the action</em> |
| protected | <strong>getCommand(</strong><em>\string</em> <strong>$string</strong>)</strong> : <em>mixed/null</em><br /><em>Get Command that has a given signature</em> |
| protected | <strong>noCommandFounded()</strong> : <em>void</em><br /><em>If no command is found</em> |
| protected | <strong>run(</strong><em>\string</em> <strong>$command</strong>, <em>\string</em> <strong>$method=`'handle'`</strong>)</strong> : <em>void</em><br /><em>Run command</em> |

<hr /><a id="class-ozadatabaseconsolecommandsmigrationcommand"></a>
### Class: \OZA\Database\Console\Commands\MigrationCommand

| Visibility | Function |
|:-----------|:---------|
| public | <strong>handle()</strong> : <em>void</em> |
| protected | <strong>create()</strong> : <em>mixed</em> |
| protected | <strong>createFile(</strong><em>\string</em> <strong>$filename</strong>, <em>mixed</em> <strong>$data</strong>)</strong> : <em>bool/int</em><br /><em>Create file</em> |
| protected | <strong>getFilename()</strong> : <em>array/string/string[]/null</em><br /><em>Generate a Migration filename</em> |
| protected | <strong>getStub(</strong><em>\string</em> <strong>$type=`'create'`</strong>)</strong> : <em>false/string</em><br /><em>Get stub content</em> |
| protected | <strong>getTableName()</strong> : <em>string/string[]/null</em><br /><em>Get table name</em> |
| protected | <strong>replaceVariables(</strong><em>mixed</em> <strong>$stub</strong>, <em>array</em> <strong>$variables</strong>)</strong> : <em>mixed</em><br /><em>Replace all variables inside stub</em> |

*This class extends [\OZA\Database\Console\Commands\BaseCommand](#class-ozadatabaseconsolecommandsbasecommand)*

<hr /><a id="class-ozadatabaseconsolecommandsbasecommand"></a>
### Class: \OZA\Database\Console\Commands\BaseCommand

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em> |
| public | <strong>firstSegment()</strong> : <em>array</em> |
| public | <strong>handle()</strong> : <em>void</em><br /><em>handle a command Put your main code in this method</em> |
| public | <strong>option(</strong><em>\string</em> <strong>$name=null</strong>, <em>null</em> <strong>$default=null</strong>)</strong> : <em>array/string/null</em><br /><em>Get option with a given name</em> |
| public | <strong>signatureArguments()</strong> : <em>array</em><br /><em>Get only signature arguments</em> |
| public | <strong>signatureOptions()</strong> : <em>array</em><br /><em>Get  options array</em> |
| public | <strong>signatureSegments(</strong><em>\int</em> <strong>$segment=null</strong>)</strong> : <em>array</em><br /><em>Get signatures segments</em> |
| public | <strong>signatureSegmentsWithoutHooks()</strong> : <em>array</em><br /><em>Get signature segments without hooks ({|})</em> |
| protected | <strong>argument(</strong><em>\string</em> <strong>$name=null</strong>, <em>null</em> <strong>$default=null</strong>)</strong> : <em>string/array/null</em><br /><em>Get argument</em> |
| protected | <strong>arguments()</strong> : <em>array</em><br /><em>Get all arguments</em> |
| protected | <strong>fillWithDefaultOptions()</strong> : <em>array</em><br /><em>Fill options array with default values</em> |
| protected | <strong>filterBooleans(</strong><em>mixed</em> <strong>$mapped</strong>)</strong> : <em>array</em><br /><em>Convert string boolean to real boolean ( 'true' => true && 'false' => false)</em> |
| protected | <strong>getArgv()</strong> : <em>array</em><br /><em>Get argv global values</em> |
| protected | <strong>inputs()</strong> : <em>array</em><br /><em>Get all arguments passed in command line</em> |
| protected | <strong>options()</strong> : <em>void</em><br /><em>Get all options</em> |
| protected | <strong>optionsInput()</strong> : <em>array</em><br /><em>Get options input ( all input that start with - );</em> |

<hr /><a id="class-ozadatabaseconsolecommandsmigrationrollbackcommand"></a>
### Class: \OZA\Database\Console\Commands\MigrationRollbackCommand

| Visibility | Function |
|:-----------|:---------|
| public | <strong>handle()</strong> : <em>void</em> |
| protected | <strong>addMigration(</strong><em>mixed</em> <strong>$file</strong>, <em>\int</em> <strong>$belongs</strong>)</strong> : <em>void</em> |
| protected | <strong>createMigrationsTableIfNotExists()</strong> : <em>mixed</em><br /><em>Create migrations table if the table not exists in database</em> |
| protected | <strong>getDatabaseMigrations()</strong> : <em>mixed</em><br /><em>Get all migrations in database</em> |
| protected | <strong>removeMigration(</strong><em>mixed</em> <strong>$filename</strong>)</strong> : <em>void</em><br /><em>Remove Migration</em> |

*This class extends [\OZA\Database\Console\Commands\BaseCommand](#class-ozadatabaseconsolecommandsbasecommand)*

<hr /><a id="class-ozadatabaseconsolecommandsmigratecommand"></a>
### Class: \OZA\Database\Console\Commands\MigrateCommand

| Visibility | Function |
|:-----------|:---------|
| public | <strong>handle()</strong> : <em>void</em> |
| protected | <strong>addMigration(</strong><em>mixed</em> <strong>$file</strong>, <em>\int</em> <strong>$belongs</strong>)</strong> : <em>void</em> |
| protected | <strong>createMigrationsTableIfNotExists()</strong> : <em>mixed</em><br /><em>Create migrations table if the table not exists in database</em> |
| protected | <strong>getDatabaseMigrations()</strong> : <em>mixed</em><br /><em>Get all migrations in database</em> |
| protected | <strong>removeMigration(</strong><em>mixed</em> <strong>$filename</strong>)</strong> : <em>void</em><br /><em>Remove Migration</em> |

*This class extends [\OZA\Database\Console\Commands\BaseCommand](#class-ozadatabaseconsolecommandsbasecommand)*

<hr /><a id="class-ozadatabasedecoratorsquerybuilderdecorator"></a>
### Class: \OZA\Database\Decorators\QueryBuilderDecorator

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>[\OZA\Database\Query\QueryBuilder](#class-ozadatabasequeryquerybuilder)</em> <strong>$builder</strong>)</strong> : <em>void</em><br /><em>QueryBuilderDecorator constructor.</em> |

*This class extends [\OZA\Database\Query\QueryBuilder](#class-ozadatabasequeryquerybuilder)*

<hr /><a id="class-ozadatabaseeventsemitter"></a>
### Class: \OZA\Database\Events\Emitter

| Visibility | Function |
|:-----------|:---------|
| public | <strong>emit(</strong><em>\string</em> <strong>$event</strong>, <em>array</em> <strong>$args</strong>)</strong> : <em>void</em> |
| public static | <strong>instance()</strong> : <em>[\OZA\Database\Events\Emitter](#class-ozadatabaseeventsemitter)</em><br /><em>Get Emitter instance</em> |
| public | <strong>on(</strong><em>\string</em> <strong>$event</strong>, <em>\callable</em> <strong>$listener</strong>)</strong> : <em>void</em><br /><em>Register an event</em> |

<hr /><a id="class-ozadatabaseeventsevent"></a>
### Class: \OZA\Database\Events\Event

| Visibility | Function |
|:-----------|:---------|

<hr /><a id="class-ozadatabaseexceptionscolumninvalidtypeforautoincrement"></a>
### Class: \OZA\Database\Exceptions\Column\InvalidTypeForAutoIncrement

| Visibility | Function |
|:-----------|:---------|

*This class extends \Exception*

*This class implements \Throwable*

<hr /><a id="class-ozadatabasefacadebasefacade-abstract"></a>
### Class: \OZA\Database\Facade\BaseFacade (abstract)

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>__callStatic(</strong><em>mixed</em> <strong>$name</strong>, <em>mixed</em> <strong>$arguments</strong>)</strong> : <em>mixed</em> |
| protected | <strong>abstract resolve()</strong> : <em>mixed</em><br /><em>Return the name of builder Class</em> |

<hr /><a id="class-ozadatabasefacadequery"></a>
### Class: \OZA\Database\Facade\Query

> Class Query

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>resolve()</strong> : <em>mixed/string</em> |

*This class extends [\OZA\Database\Facade\BaseFacade](#class-ozadatabasefacadebasefacade-abstract)*

<hr /><a id="class-ozadatabasefacadetablenameresolver"></a>
### Class: \OZA\Database\Facade\TableNameResolver

> Class TableNameResolver

| Visibility | Function |
|:-----------|:---------|
| protected | <strong>resolve()</strong> : <em>mixed</em><br /><em>Return the name of builder Class</em> |

*This class extends [\OZA\Database\Facade\BaseFacade](#class-ozadatabasefacadebasefacade-abstract)*

<hr /><a id="class-ozadatabasefacadeinsertquery"></a>
### Class: \OZA\Database\Facade\InsertQuery

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>make(</strong><em>array</em> <strong>$attributes</strong>)</strong> : <em>void</em> |

<hr /><a id="class-ozadatabasefactoryseederfactory"></a>
### Class: \OZA\Database\Factory\SeederFactory

| Visibility | Function |
|:-----------|:---------|

<hr /><a id="class-ozadatabasehelpersclassesfinder"></a>
### Class: \OZA\Database\Helpers\ClassesFinder

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>extends(</strong><em>\string</em> <strong>$class</strong>, <em>\string</em> <strong>$parent</strong>)</strong> : <em>bool</em><br /><em>Check if a given command is a subclass of a given class</em> |
| public static | <strong>find(</strong><em>\string</em> <strong>$directory</strong>, <em>\string</em> <strong>$parent=null</strong>, <em>\bool</em> <strong>$all=true</strong>)</strong> : <em>array</em><br /><em>Find all classes in a given directory</em> |
| public static | <strong>findClassInFiles(</strong><em>array</em> <strong>$files</strong>)</strong> : <em>array</em><br /><em>Find classes in files Do not work if the class constructor take arguments</em> |

<hr /><a id="class-ozadatabasehelpersarr"></a>
### Class: \OZA\Database\Helpers\Arr

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>except(</strong><em>array</em> <strong>$files</strong>, <em>array</em> <strong>$excepts=array()</strong>)</strong> : <em>array</em><br /><em>Excepts</em> |
| public static | <strong>get(</strong><em>[\OZA\Database\Helpers\Arr](#class-ozadatabasehelpersarr)ayAccess/array</em> <strong>$data</strong>, <em>\string</em> <strong>$key</strong>, <em>null</em> <strong>$default=null</strong>)</strong> : <em>[\OZA\Database\Helpers\Arr](#class-ozadatabasehelpersarr)ayAccess/mixed/null</em><br /><em>Get Array value with dot notation</em> |
| public static | <strong>pluck(</strong><em>array</em> <strong>$data</strong>, <em>\string</em> <strong>$key</strong>)</strong> : <em>array</em><br /><em>Pluck key</em> |
###### Examples of Arr::get()
```
$a = ['database' => ['name' => 'root', 'password' => '']]
      Arr::get($a, 'database.name') will return 'root'
```

<hr /><a id="class-ozadatabasehelpersstr"></a>
### Class: \OZA\Database\Helpers\Str

| Visibility | Function |
|:-----------|:---------|
| public static | <strong>endsWith(</strong><em>\string</em> <strong>$haystack</strong>, <em>\string</em> <strong>$needle</strong>)</strong> : <em>bool</em><br /><em>Check if string ends with a given value</em> |
| public static | <strong>plural(</strong><em>\string</em> <strong>$string</strong>)</strong> : <em>string</em><br /><em>Get Plural</em> |
| public static | <strong>sanitize(</strong><em>\string</em> <strong>$string</strong>)</strong> : <em>string/string[]/null</em><br /><em>Sanitize string and return only alpha numeric characters</em> |
| public static | <strong>snake(</strong><em>\string</em> <strong>$string</strong>)</strong> : <em>string</em><br /><em>Get Snake case string</em> |
| public static | <strong>studly(</strong><em>\string</em> <strong>$string</strong>)</strong> : <em>string</em><br /><em>Studly Case</em> |
| public static | <strong>withoutPart(</strong><em>\string</em> <strong>$string</strong>, <em>\string</em> <strong>$part</strong>)</strong> : <em>mixed</em><br /><em>Get string without a part</em> |

<hr /><a id="class-ozadatabasemigrationsmigrationtable"></a>
### Class: \OZA\Database\Migrations\MigrationTable

| Visibility | Function |
|:-----------|:---------|
| public | <strong>migrate()</strong> : <em>void</em> |

<hr /><a id="class-ozadatabasemigrationscolumn"></a>
### Class: \OZA\Database\Migrations\Column

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\string</em> <strong>$name</strong>, <em>[\OZA\Database\Migrations\Table](#class-ozadatabasemigrationstable)</em> <strong>$table</strong>)</strong> : <em>void</em><br /><em>Column constructor.</em> |
| public | <strong>__toString()</strong> : <em>string</em> |
| public | <strong>autoIncrement()</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em> |
| public | <strong>default(</strong><em>mixed</em> <strong>$default</strong>)</strong> : <em>\OZA\Database\Migrations\$this</em><br /><em>Set default value for a column</em> |
| public | <strong>getDefault()</strong> : <em>null/string</em> |
| public | <strong>getName()</strong> : <em>string</em> |
| public | <strong>getOnUpdate()</strong> : <em>string</em> |
| public | <strong>getTable()</strong> : <em>[\OZA\Database\Migrations\Table](#class-ozadatabasemigrationstable)</em> |
| public | <strong>getType()</strong> : <em>array</em> |
| public | <strong>index(</strong><em>\string</em> <strong>$name=null</strong>)</strong> : <em>\OZA\Database\Migrations\$this</em><br /><em>Index column</em> |
| public | <strong>isAutoIncrement()</strong> : <em>bool</em> |
| public | <strong>isNullable()</strong> : <em>null/bool</em> |
| public | <strong>isUnsigned()</strong> : <em>bool</em> |
| public | <strong>nullable()</strong> : <em>\OZA\Database\Migrations\$this</em><br /><em>Set nullable value</em> |
| public | <strong>onUpdate(</strong><em>\string</em> <strong>$expression</strong>)</strong> : <em>\OZA\Database\Migrations\$this</em><br /><em>Add onUpdate expression</em> |
| public | <strong>primary()</strong> : <em>\OZA\Database\Migrations\$this</em><br /><em>Add primary key</em> |
| public | <strong>toSql()</strong> : <em>string</em> |
| public | <strong>type(</strong><em>\string</em> <strong>$type</strong>, <em>null</em> <strong>$length=null</strong>)</strong> : <em>\OZA\Database\Migrations\$this</em> |
| public | <strong>unique()</strong> : <em>\OZA\Database\Migrations\$this</em><br /><em>Add unique constraint</em> |
| public | <strong>unsigned()</strong> : <em>\OZA\Database\Migrations\$this</em><br /><em>Make int types unsigned</em> |

<hr /><a id="class-ozadatabasemigrationstable"></a>
### Class: \OZA\Database\Migrations\Table

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\string</em> <strong>$name=null</strong>)</strong> : <em>void</em><br /><em>Table constructor.</em> |
| public | <strong>addIndex(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>\OZA\Database\Migrations\$this</em><br /><em>Add index</em> |
| public | <strong>addPrimaryKey(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>\OZA\Database\Migrations\$this</em><br /><em>Add a primary key</em> |
| public | <strong>addUniqueKey(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>\OZA\Database\Migrations\$this</em><br /><em>Add unique key to table</em> |
| public | <strong>bigInteger(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Big Integer Column</em> |
| public | <strong>blob(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Create blob column</em> |
| public | <strong>date(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Create date column</em> |
| public | <strong>datetime(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Create datetime column</em> |
| public | <strong>decimal(</strong><em>\string</em> <strong>$name</strong>, <em>\int</em> <strong>$max=38</strong>, <em>\int</em> <strong>$scale=2</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Create decimal column</em> |
| public | <strong>double(</strong><em>\string</em> <strong>$name</strong>, <em>\int</em> <strong>$max=20</strong>, <em>\int</em> <strong>$scale=2</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Create double column</em> |
| public static | <strong>dropIfExists(</strong><em>\string</em> <strong>$table</strong>)</strong> : <em>void</em><br /><em>Drop table if exists</em> |
| public | <strong>enum(</strong><em>\string</em> <strong>$name</strong>, <em>array</em> <strong>$possibilities</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Create enum column</em> |
| public | <strong>exec()</strong> : <em>bool</em> |
| public | <strong>float(</strong><em>\string</em> <strong>$name</strong>, <em>\int</em> <strong>$max=20</strong>, <em>\int</em> <strong>$scale=2</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em> |
| public | <strong>foreign(</strong><em>\string</em> <strong>$column</strong>, <em>\string</em> <strong>$name=null</strong>)</strong> : <em>[\OZA\Database\Migrations\Constraints\ForeignConstraint](#class-ozadatabasemigrationsconstraintsforeignconstraint)</em><br /><em>Set foreign column</em> |
| public | <strong>getColumns()</strong> : <em>array</em><br /><em>Get tables columns</em> |
| public | <strong>getCommand()</strong> : <em>string</em> |
| public | <strong>getForeignKeys()</strong> : <em>array</em> |
| public | <strong>getIndexes()</strong> : <em>array</em> |
| public | <strong>getName()</strong> : <em>string</em><br /><em>Get table name</em> |
| public | <strong>getPrimaryKeys()</strong> : <em>array</em><br /><em>Get all primary keys</em> |
| public | <strong>getUniqueKeys()</strong> : <em>array</em><br /><em>Get all uniques keys</em> |
| public | <strong>integer(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Integer column</em> |
| public | <strong>longText(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Create long text column</em> |
| public | <strong>mediumText(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Create Medium Text column</em> |
| public | <strong>migrate()</strong> : <em>false/\OZA\Database\Migrations\PDOStatement</em> |
| public | <strong>setCommand(</strong><em>\string</em> <strong>$command</strong>)</strong> : <em>[\OZA\Database\Migrations\Table](#class-ozadatabasemigrationstable)</em> |
| public | <strong>setName(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Table](#class-ozadatabasemigrationstable)</em> |
| public | <strong>string(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Varchar Column</em> |
| public | <strong>text(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Create text column</em> |
| public | <strong>time(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Create time column</em> |
| public | <strong>timestamp(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Create timestamp column</em> |
| public | <strong>timestamps()</strong> : <em>void</em><br /><em>create created_at and updated_at column</em> |
| public | <strong>tinyInteger(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Tiny Integer Column</em> |
| public | <strong>tinyText(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Create tiny text column</em> |
| public | <strong>toSql()</strong> : <em>string</em> |
| public | <strong>year(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Create year column</em> |
| protected | <strong>addColumn(</strong><em>\string</em> <strong>$name</strong>, <em>\string</em> <strong>$type</strong>, <em>int/null</em> <strong>$length=null</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Add column to table</em> |

*This class implements [\OZA\Database\Migrations\Interfaces\DatatypeInterface](#interface-ozadatabasemigrationsinterfacesdatatypeinterface)*

<hr /><a id="class-ozadatabasemigrationsmigrationtablemigration"></a>
### Class: \OZA\Database\Migrations\MigrationTableMigration

| Visibility | Function |
|:-----------|:---------|
| public | <strong>up(</strong><em>[\OZA\Database\Migrations\Table](#class-ozadatabasemigrationstable)</em> <strong>$table</strong>)</strong> : <em>void</em> |

<hr /><a id="class-ozadatabasemigrationsconstraintsforeignconstraint"></a>
### Class: \OZA\Database\Migrations\Constraints\ForeignConstraint

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>[\OZA\Database\Migrations\Table](#class-ozadatabasemigrationstable)</em> <strong>$table</strong>, <em>\string</em> <strong>$column</strong>, <em>\string</em> <strong>$name=null</strong>)</strong> : <em>void</em><br /><em>ForeignConstraint constructor.</em> |
| public | <strong>on(</strong><em>\string</em> <strong>$table</strong>)</strong> : <em>\OZA\Database\Migrations\Constraints\$this</em><br /><em>Set reference table</em> |
| public | <strong>onDelete(</strong><em>\string</em> <strong>$type</strong>)</strong> : <em>\OZA\Database\Migrations\Constraints\$this</em><br /><em>Set onDelete mode</em> |
| public | <strong>onUpdate(</strong><em>\string</em> <strong>$type</strong>)</strong> : <em>[\OZA\Database\Migrations\Constraints\ForeignConstraint](#class-ozadatabasemigrationsconstraintsforeignconstraint)</em><br /><em>Set onUpdate mode</em> |
| public | <strong>references(</strong><em>\string</em> <strong>$column</strong>)</strong> : <em>\OZA\Database\Migrations\Constraints\$this</em><br /><em>Set reference column</em> |
| public | <strong>toSql()</strong> : <em>string</em><br /><em>Get sql</em> |
| protected | <strong>compile()</strong> : <em>string</em><br /><em>Compile Constraint to sql</em> |

<hr /><a id="interface-ozadatabasemigrationsinterfacesmigrationtableinterface"></a>
### Interface: \OZA\Database\Migrations\Interfaces\MigrationTableInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>down(</strong><em>[\OZA\Database\Migrations\Schema\Schema](#class-ozadatabasemigrationsschemaschema)</em> <strong>$schema</strong>)</strong> : <em>mixed</em><br /><em>Called when rollback</em> |
| public | <strong>up(</strong><em>[\OZA\Database\Migrations\Schema\Schema](#class-ozadatabasemigrationsschemaschema)</em> <strong>$schema</strong>)</strong> : <em>mixed</em><br /><em>Create table</em> |

<hr /><a id="interface-ozadatabasemigrationsinterfacesdatatypeinterface"></a>
### Interface: \OZA\Database\Migrations\Interfaces\DatatypeInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>bigInteger(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Big Integer Column</em> |
| public | <strong>blob(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Create blob column</em> |
| public | <strong>double(</strong><em>\string</em> <strong>$name</strong>, <em>\int</em> <strong>$max=20</strong>, <em>\int</em> <strong>$scale=2</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Create double column</em> |
| public | <strong>enum(</strong><em>\string</em> <strong>$name</strong>, <em>array</em> <strong>$possibilities</strong>)</strong> : <em>void</em><br /><em>Create enum column</em> |
| public | <strong>float(</strong><em>\string</em> <strong>$name</strong>, <em>\int</em> <strong>$max=20</strong>, <em>\int</em> <strong>$scale=2</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em> |
| public | <strong>integer(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Integer column</em> |
| public | <strong>longText(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Create long text column</em> |
| public | <strong>mediumText(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Create Medium Text column</em> |
| public | <strong>string(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Varchar Column</em> |
| public | <strong>text(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Create text column</em> |
| public | <strong>tinyInteger(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Tiny Integer Column</em> |
| public | <strong>tinyText(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\OZA\Database\Migrations\Column](#class-ozadatabasemigrationscolumn)</em><br /><em>Create tiny text column</em> |

<hr /><a id="class-ozadatabasemigrationsschemaschema"></a>
### Class: \OZA\Database\Migrations\Schema\Schema

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em><br /><em>Schema constructor.</em> |
| public | <strong>alter(</strong><em>\string</em> <strong>$name</strong>, <em>\callable</em> <strong>$callback</strong>)</strong> : <em>void</em><br /><em>Alter Table</em> |
| public | <strong>create(</strong><em>\string</em> <strong>$name</strong>, <em>\callable</em> <strong>$callback</strong>)</strong> : <em>mixed</em><br /><em>Create table</em> |
| public | <strong>drop(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>void</em> |
| public | <strong>prepare(</strong><em>\string</em> <strong>$name</strong>, <em>\string</em> <strong>$command</strong>, <em>\callable</em> <strong>$callback=null</strong>)</strong> : <em>void</em><br /><em>Prepare schema</em> |
| protected | <strong>execute(</strong><em>[\OZA\Database\Migrations\Table](#class-ozadatabasemigrationstable)</em> <strong>$table</strong>)</strong> : <em>bool</em> |
| protected | <strong>setCommand(</strong><em>\string</em> <strong>$command</strong>)</strong> : <em>void</em><br /><em>Set schema command</em> |

<hr /><a id="class-ozadatabasequeryentityquerybuilder"></a>
### Class: \OZA\Database\Query\EntityQueryBuilder

> Class EntityQueryBuilder

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__call(</strong><em>mixed</em> <strong>$name</strong>, <em>mixed</em> <strong>$arguments</strong>)</strong> : <em>mixed</em><br /><em>Forwards not defined method call to QueryBuilder</em> |
| public | <strong>__construct(</strong><em>[\OZA\Database\Query\Entity](#class-ozadatabasequeryentity)</em> <strong>$entity</strong>)</strong> : <em>void</em><br /><em>EntityQueryBuilder constructor.</em> |
| public | <strong>count()</strong> : <em>int</em><br /><em>Count Number of rows</em> |
| public | <strong>create(</strong><em>array</em> <strong>$attributes=array()</strong>)</strong> : <em>bool/[\OZA\Database\Query\Entity](#class-ozadatabasequeryentity)</em><br /><em>Create and return values</em> |
| public | <strong>find(</strong><em>mixed</em> <strong>$id</strong>, <em>\string</em> <strong>$column=null</strong>)</strong> : <em>[\OZA\Database\Query\Entity](#class-ozadatabasequeryentity)/mixed</em><br /><em>Find by id</em> |
| public | <strong>get()</strong> : <em>array</em><br /><em>Get all</em> |
| public | <strong>getParams()</strong> : <em>array</em><br /><em>Get Query Parameters</em> |
| public | <strong>getQuery()</strong> : <em>[\OZA\Database\Query\QueryBuilder](#class-ozadatabasequeryquerybuilder)</em><br /><em>Get Query Builder</em> |
| public | <strong>newQuery()</strong> : <em>[\OZA\Database\Query\QueryBuilder](#class-ozadatabasequeryquerybuilder)</em><br /><em>Set new Query</em> |
| public | <strong>save()</strong> : <em>bool/[\OZA\Database\Query\Entity](#class-ozadatabasequeryentity)</em><br /><em>Save entity</em> |
| public | <strong>setQuery()</strong> : <em>void</em><br /><em>Set QueryBuilder</em> |
| public | <strong>toSql()</strong> : <em>string</em> |

<hr /><a id="class-ozadatabasequeryentity"></a>
### Class: \OZA\Database\Query\Entity

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$attributes=array()</strong>)</strong> : <em>void</em> |
| public | <strong>__get(</strong><em>mixed</em> <strong>$name</strong>)</strong> : <em>mixed</em> |
| public | <strong>__set(</strong><em>mixed</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>mixed</em><br /><em>Set Attribute</em> |
| public static | <strong>all()</strong> : <em>array</em> |
| public | <strong>boot()</strong> : <em>void</em><br /><em>Boot Entity</em> |
| public | <strong>changedAttributes()</strong> : <em>array</em><br /><em>Get changed attributes</em> |
| public | <strong>clone()</strong> : <em>[\OZA\Database\Query\Entity](#class-ozadatabasequeryentity)</em><br /><em>Clone Entity</em> |
| public | <strong>count()</strong> : <em>int</em><br /><em>Count rows of a query</em> |
| public | <strong>create(</strong><em>array/array/null/array</em> <strong>$attributes=array()</strong>)</strong> : <em>bool/[\OZA\Database\Query\Entity](#class-ozadatabasequeryentity)</em><br /><em>Insert attributes to database</em> |
| public | <strong>fillAttributes(</strong><em>array</em> <strong>$attributes=array()</strong>)</strong> : <em>\OZA\Database\Query\$this</em><br /><em>Fill attributes</em> |
| public | <strong>getAttribute(</strong><em>mixed</em> <strong>$name</strong>)</strong> : <em>mixed</em><br /><em>Get Attribute</em> |
| public | <strong>getAttributes()</strong> : <em>array</em> |
| public | <strong>getEntity()</strong> : <em>mixed</em> |
| public | <strong>getOriginals()</strong> : <em>array</em> |
| public | <strong>getPrimaryKey()</strong> : <em>string</em><br /><em>Get Entity primary column</em> |
| public | <strong>getQuery()</strong> : <em>mixed</em><br /><em>Get Query Builder</em> |
| public | <strong>getTable()</strong> : <em>string</em> |
| public | <strong>isNewEntity()</strong> : <em>bool</em> |
| public static | <strong>make(</strong><em>array</em> <strong>$attributes=array()</strong>)</strong> : <em>void</em> |
| public | <strong>manyToOne(</strong><em>\string</em> <strong>$related</strong>, <em>string/null/\string</em> <strong>$foreignKey</strong>, <em>\string</em> <strong>$localKey=null</strong>)</strong> : <em>\OZA\Database\Query\ManyToOne</em> |
| public static | <strong>query()</strong> : <em>[\OZA\Database\Query\EntityQueryBuilder](#class-ozadatabasequeryentityquerybuilder)</em> |
| public | <strong>save()</strong> : <em>bool/[\OZA\Database\Query\Entity](#class-ozadatabasequeryentity)</em><br /><em>Save attributes</em> |
| public | <strong>setAttribute(</strong><em>mixed</em> <strong>$name</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>mixed</em><br /><em>Set Attribute</em> |
| public | <strong>setIdAttribute(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>int</em><br /><em>Cast id to int type</em> |
| public | <strong>syncOriginal()</strong> : <em>[\OZA\Database\Query\Entity](#class-ozadatabasequeryentity)</em> |

<hr /><a id="class-ozadatabasequerytablenameresolver"></a>
### Class: \OZA\Database\Query\TableNameResolver

| Visibility | Function |
|:-----------|:---------|
| public | <strong>get(</strong><em>[\OZA\Database\Query\Entity](#class-ozadatabasequeryentity)</em> <strong>$entity</strong>)</strong> : <em>mixed</em> |
| protected | <strong>name(</strong><em>\string</em> <strong>$classname</strong>)</strong> : <em>mixed</em> |
| protected | <strong>sanitize(</strong><em>mixed</em> <strong>$name</strong>)</strong> : <em>mixed</em> |

<hr /><a id="class-ozadatabasequeryquerybuilder"></a>
### Class: \OZA\Database\Query\QueryBuilder

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct()</strong> : <em>void</em> |
| public | <strong>count()</strong> : <em>integer</em><br /><em>Count rows</em> |
| public | <strong>distinct(</strong><em>\string</em> <strong>$column=`'id'`</strong>)</strong> : <em>\OZA\Database\Query\$this</em><br /><em>Select distinct according to a given column</em> |
| public | <strong>find(</strong><em>mixed</em> <strong>$id</strong>, <em>\string</em> <strong>$column=`'id'`</strong>)</strong> : <em>mixed</em><br /><em>Find item by id</em> |
| public | <strong>first()</strong> : <em>mixed</em><br /><em>Get one row</em> |
| public | <strong>get()</strong> : <em>mixed</em><br /><em>Get Query result</em> |
| public | <strong>getCommand()</strong> : <em>string/null</em> |
| public | <strong>getDistinct()</strong> : <em>string/null</em><br /><em>Get distinct column</em> |
| public | <strong>getEntity()</strong> : <em>mixed</em> |
| public | <strong>getFetchMode()</strong> : <em>int</em> |
| public | <strong>getLimit()</strong> : <em>int</em> |
| public | <strong>getParams()</strong> : <em>array</em> |
| public | <strong>getSelectRaw()</strong> : <em>null</em> |
| public | <strong>getSelects()</strong> : <em>array</em><br /><em>Get all selected columns</em> |
| public | <strong>getTable()</strong> : <em>string/null</em><br /><em>Get table</em> |
| public | <strong>getUpdateSql()</strong> : <em>string</em> |
| public | <strong>getWheres()</strong> : <em>array</em> |
| public | <strong>insert(</strong><em>array</em> <strong>$attributes</strong>)</strong> : <em>bool</em> |
| public | <strong>insertAndGetId(</strong><em>array</em> <strong>$attributes</strong>)</strong> : <em>string</em> |
| public | <strong>isSubQuery()</strong> : <em>bool</em> |
| public | <strong>limit(</strong><em>\int</em> <strong>$limit</strong>)</strong> : <em>\OZA\Database\Query\$this</em> |
| public | <strong>mergeParams(</strong><em>array</em> <strong>$params</strong>)</strong> : <em>void</em> |
| public | <strong>orWhere(</strong><em>string/callable</em> <strong>$column</strong>, <em>string/null</em> <strong>$operator=null</strong>, <em>string/null</em> <strong>$condition=null</strong>)</strong> : <em>[\OZA\Database\Query\QueryBuilder](#class-ozadatabasequeryquerybuilder)</em><br /><em>Add orWhere clause</em> |
| public | <strong>orWhereIn(</strong><em>\string</em> <strong>$column</strong>, <em>array</em> <strong>$data</strong>)</strong> : <em>[\OZA\Database\Query\QueryBuilder](#class-ozadatabasequeryquerybuilder)/\OZA\Database\Query\Clauses</em><br /><em>Add where in clause</em> |
| public | <strong>performInsert(</strong><em>array</em> <strong>$attributes</strong>)</strong> : <em>bool/\OZA\Database\Query\PDOStatement</em> |
| public | <strong>select(</strong><em>array</em> <strong>$columns=array()</strong>)</strong> : <em>\OZA\Database\Query\$this</em><br /><em>Select columns in table</em> |
| public | <strong>selectRaw(</strong><em>\string</em> <strong>$string</strong>)</strong> : <em>\OZA\Database\Query\$this</em><br /><em>Select Raw</em> |
| public | <strong>setCommand(</strong><em>\string</em> <strong>$command=null</strong>)</strong> : <em>[\OZA\Database\Query\QueryBuilder](#class-ozadatabasequeryquerybuilder)</em> |
| public | <strong>setEntity(</strong><em>mixed</em> <strong>$entity</strong>)</strong> : <em>[\OZA\Database\Query\QueryBuilder](#class-ozadatabasequeryquerybuilder)</em> |
| public | <strong>setFetchMode(</strong><em>\int</em> <strong>$fetchMode</strong>)</strong> : <em>[\OZA\Database\Query\QueryBuilder](#class-ozadatabasequeryquerybuilder)</em> |
| public | <strong>setSubQuery(</strong><em>\bool</em> <strong>$subQuery</strong>)</strong> : <em>[\OZA\Database\Query\QueryBuilder](#class-ozadatabasequeryquerybuilder)</em> |
| public | <strong>table(</strong><em>\string</em> <strong>$table</strong>)</strong> : <em>[\OZA\Database\Query\QueryBuilder](#class-ozadatabasequeryquerybuilder)</em><br /><em>Set current table</em> |
| public | <strong>toSql()</strong> : <em>string</em><br /><em>Compile query to sql</em> |
| public | <strong>update(</strong><em>array</em> <strong>$attributes</strong>)</strong> : <em>bool/\OZA\Database\Query\PDOStatement</em><br /><em>Update rows</em> |
| public | <strong>where(</strong><em>string/callable</em> <strong>$column</strong>, <em>mixed/null</em> <strong>$operator=null</strong>, <em>mixed/null</em> <strong>$condition=null</strong>)</strong> : <em>\OZA\Database\Query\$this</em><br /><em>Add where clause</em> |
| public | <strong>whereIn(</strong><em>\string</em> <strong>$column</strong>, <em>array</em> <strong>$data</strong>)</strong> : <em>[\OZA\Database\Query\QueryBuilder](#class-ozadatabasequeryquerybuilder)/\OZA\Database\Query\Clauses</em><br /><em>Add whereIn clause</em> |
| protected | <strong>addWhereClause(</strong><em>string/callable</em> <strong>$column</strong>, <em>\string</em> <strong>$operator</strong>, <em>mixed</em> <strong>$condition</strong>, <em>\string</em> <strong>$logic</strong>)</strong> : <em>[\OZA\Database\Query\QueryBuilder](#class-ozadatabasequeryquerybuilder)/\OZA\Database\Query\Clauses</em><br /><em>Add a where Clause</em> |
| protected | <strong>execute(</strong><em>null</em> <strong>$sql=null</strong>)</strong> : <em>bool/\OZA\Database\Query\PDOStatement</em><br /><em>Get pdo statement</em> |
| protected | <strong>getWhereClauseStringParams(</strong><em>mixed</em> <strong>$condition</strong>)</strong> : <em>array/callable/string</em> |
| protected | <strong>pdo()</strong> : <em>\OZA\Database\Query\PDO</em><br /><em>Get Pdo instance</em> |
| protected | <strong>processSync(</strong><em>[\OZA\Database\Query\Entity](#class-ozadatabasequeryentity)[]/[\OZA\Database\Query\Entity](#class-ozadatabasequeryentity)</em> <strong>$result</strong>)</strong> : <em>mixed</em> |

<hr /><a id="class-ozadatabasequeryinsertquery"></a>
### Class: \OZA\Database\Query\InsertQuery

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$attributes</strong>)</strong> : <em>void</em><br /><em>InsertQuery constructor.</em> |
| public | <strong>getParams()</strong> : <em>array</em><br /><em>Get Builder Params</em> |
| public | <strong>toSql()</strong> : <em>string</em><br /><em>Sql</em> |

<hr /><a id="class-ozadatabasequeryupdatequery"></a>
### Class: \OZA\Database\Query\UpdateQuery

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>array</em> <strong>$attributes</strong>)</strong> : <em>void</em><br /><em>UpdateQuery constructor.</em> |
| public | <strong>__toString()</strong> : <em>string</em> |
| public | <strong>getParams()</strong> : <em>mixed</em> |
| public | <strong>toSql()</strong> : <em>string</em> |
| protected | <strong>compile()</strong> : <em>string</em> |

<hr /><a id="class-ozadatabasequeryrelationsmanytoone"></a>
### Class: \OZA\Database\Query\Relations\ManyToOne

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__call(</strong><em>mixed</em> <strong>$name</strong>, <em>mixed</em> <strong>$arguments</strong>)</strong> : <em>mixed</em><br /><em>Call entity methods</em> |
| public | <strong>__construct(</strong><em>\string</em> <strong>$related</strong>, <em>\string</em> <strong>$column</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>void</em><br /><em>ManyToOne constructor.</em> |
| public | <strong>create(</strong><em>array</em> <strong>$attributes</strong>)</strong> : <em>bool/\OZA\Database\Query\Relations\Entity</em><br /><em>Create related data</em> |
| public | <strong>find(</strong><em>int</em> <strong>$id</strong>)</strong> : <em>mixed</em><br /><em>Get a specific row with its id</em> |
| public | <strong>first()</strong> : <em>mixed</em><br /><em>Get First row</em> |
| public | <strong>get()</strong> : <em>mixed</em><br /><em>Get Results</em> |
| public | <strong>getQuery()</strong> : <em>[\OZA\Database\Query\EntityQueryBuilder](#class-ozadatabasequeryentityquerybuilder)</em><br /><em>Get Entity Query</em> |
| public | <strong>limit(</strong><em>\int</em> <strong>$limit</strong>)</strong> : <em>\OZA\Database\Query\Relations\$this</em><br /><em>Limit query</em> |
| public | <strong>orWhere(</strong><em>mixed</em> <strong>$column</strong>, <em>mixed</em> <strong>$operator</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>[\OZA\Database\Query\Relations\ManyToOne](#class-ozadatabasequeryrelationsmanytoone)</em><br /><em>Add or where clause to query</em> |
| public | <strong>orWhereIn(</strong><em>\string</em> <strong>$column</strong>, <em>array</em> <strong>$data</strong>)</strong> : <em>[\OZA\Database\Query\Relations\ManyToOne](#class-ozadatabasequeryrelationsmanytoone)</em><br /><em>Add or WhereIn clause</em> |
| public | <strong>toSql()</strong> : <em>string</em><br /><em>Get Query Sql</em> |
| public | <strong>where(</strong><em>mixed</em> <strong>$column</strong>, <em>mixed</em> <strong>$operator</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>[\OZA\Database\Query\Relations\ManyToOne](#class-ozadatabasequeryrelationsmanytoone)</em><br /><em>Add where clause to query</em> |
| public | <strong>whereIn(</strong><em>\string</em> <strong>$column</strong>, <em>array</em> <strong>$data</strong>)</strong> : <em>\OZA\Database\Query\Relations\$this</em><br /><em>Add WhereIn Clause</em> |
| protected | <strong>addFetchingWhereClause()</strong> : <em>[\OZA\Database\Query\QueryBuilder](#class-ozadatabasequeryquerybuilder)</em><br /><em>Add Where clause when we want to fetch results</em> |
| protected | <strong>entity()</strong> : <em>[\OZA\Database\Query\Entity](#class-ozadatabasequeryentity)</em><br /><em>Resolve related entity</em> |

