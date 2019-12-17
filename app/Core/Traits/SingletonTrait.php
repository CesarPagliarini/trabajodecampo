<?php


namespace App\Core\Traits;


trait SingletonTrait
{
    public static $instance = null;

    /** call this method to get instance */
    public static function instance(){
        if (static::$instance === null){
            static::$instance = new static();
        }
        return static::$instance;
    }

    /** protected to prevent cloning */
    private function __clone(){
    }

    /** protected to prevent instantiation from outside of the class */
    private function __construct(){
    }

    /** protected to prevent instantiation from outside of the class */
    private function __wakeup(){
    }

    /** protected to prevent instantiation from outside of the class */
    private function __sleep(){
    }
}
