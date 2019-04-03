OZA\Database\Events\Emitter
===============






* Class name: Emitter
* Namespace: OZA\Database\Events





Properties
----------


### $_instance

    protected \OZA\Database\Events\Emitter $_instance

The Emitter instance (singleton)



* Visibility: **protected**
* This property is **static**.


### $listeners

    protected array $listeners = array()

List of all listeners



* Visibility: **protected**


Methods
-------


### instance

    \OZA\Database\Events\Emitter OZA\Database\Events\Emitter::instance()

Get Emitter instance



* Visibility: **public**
* This method is **static**.




### on

    mixed OZA\Database\Events\Emitter::on(string $event, callable $listener)

Register an event



* Visibility: **public**


#### Arguments
* $event **string**
* $listener **callable**



### emit

    mixed OZA\Database\Events\Emitter::emit(string $event, array $args)





* Visibility: **public**


#### Arguments
* $event **string**
* $args **array**


