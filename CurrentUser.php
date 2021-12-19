<?php

class CurrentUser
{
    private static $name = "John";
    private static $pass = "0000";
    private static $gender = "male";

    public static function setName($newName)
    {
        CurrentUser::$name = $newName;
    }

    public static function getName()
    {
        return CurrentUser::$name;
    }

    public static function getPassword()
    {
        return CurrentUser::$pass;
    }

    private static function getPasswordHash()
    {
        
    }

    public static function getGender()
    {
        return CurrentUser::$gender;
    }
}

?>