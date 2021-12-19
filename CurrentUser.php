<?php

class CurrentUser
{
    public static $name = "John";
    public static $pass = "0000";
    public static $gender = "male";


    public static function getName()
    {
        return CurrentUser::$name;
    }

    public static function getPassword()
    {
        return CurrentUser::$pass;
    }

    public static function getGender()
    {
        return CurrentUser::$gender;
    }
}

?>