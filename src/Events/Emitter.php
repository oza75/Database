<?php


namespace OZA\Database\Events;


class Emitter
{
    /**
     * The Emitter instance (singleton)
     *
     * @var Emitter
     */
    protected static $_instance;
    /**
     * List of all listeners
     *
     * @var array
     */
    protected $listeners = [];

    /**
     * Get Emitter instance
     *
     * @return Emitter
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new static();
        }

        return self::$_instance;
    }

    /**
     * Register an event
     *
     * @param string $event
     * @param callable $listener
     */
    public function on(string $event, callable $listener)
    {
        $this->listeners[$event][] = $listener;
    }

    /**
     * @param string $event
     * @param array $args
     */
    public function emit(string $event, ...$args)
    {
        $listeners = $this->listeners[$event];

        foreach ($listeners as $listener) {
            $listener(...$args);
        }
    }
}