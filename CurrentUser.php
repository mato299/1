<?php

class CurrentUser
{
    private static $name = "John";
    //private static $passDebug = "0000"; // len pre nas na zobrazenie
    private static $passHash;
    private static $gender = "male";

    public static function setName($newName)
    {
        CurrentUser::$name = $newName;
    }

    public static function getName()
    {
        return CurrentUser::$name;
    }

    public static function getPasswordDebug()
    {
    }

    public static function getPasswordHash()
    {
        return CurrentUser::$passHash;
    }

    public static function hashPassword($password)
    {
        CurrentUser::$passHash = hash('sha256', $password);
    }


    public static function getGender()
    {
        return CurrentUser::$gender;
    }
}

?>