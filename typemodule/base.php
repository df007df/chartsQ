<?php

abstract class baseChart
{
    
    
    protected $_typeId = '';


    private static $_typeobj = array();
            
    function __construct() {
        ;
    }
    
    
    
    public static function factory($type) 
    {
        if (empty(self::$_typeobj[$type])) {
            $class = $type . 'Chart';
            self::$_typeobj[$type] = new $class();
        }
        return self::$_typeobj[$type];
    }
    
    
    
    
}




