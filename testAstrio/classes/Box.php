<?php

class Box
{

    //----------------------Паттерн Singleton-----------------------------------
    private static $instances = [];

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a FileBox.");
    }

    public static function getInstance(): Box
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static;
        }

        return self::$instances[$cls];
    }

    //--------------------------------------------------------------------------

    public function setData(interfaceModifyData $obj, $enteredKey, $enteredValue)
    {
        $obj->setData($enteredKey, $enteredValue);
    }

    public function getData(interfaceModifyData $obj)
    {
        echo $obj->getData();
    }

    public function save(interfaceModifyData $obj)
    {
        $obj->save();
    }

    public function load(interfaceModifyData $obj)
    {
        $obj->load();
    }

}