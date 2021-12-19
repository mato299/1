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
    public static function getPasswordHash()
    {
        return CurrentUser::$passHash;
    }

    // uklada
    public static function setPassword($newPassword) // 0000
    {
        // heslo najprv musime zasifrovat
        CurrentUser::hashPassword($password);

        // az teraz sifru mozeme ulozit
        CurrentUser::$password = $newPassword;
    }

    // sifruje
    public static function hashPassword($password)
    {
        return hash('sha256', $password);
    }
   
 public static function hashPassword($password)
    {
        return hash('sha256', $password);
    }

    public static function getGender()
    {
        return CurrentUser::$gender;
    }
    
    public static function setGender($newGender)
    {
        CurrentUser::$gender = $newGender;
    }
    public static function setPassword($newPassword)
    {
        CurrentUser::$password = $newPassword;
    }
}


?>