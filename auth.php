<?php

class auth
{
    public static function checkUser()
    {
        session_start();
        if (!isset($_SESSION["username"])) {
            header("Location: ./App/pages/login.php");
            exit();
        }
    }
}
