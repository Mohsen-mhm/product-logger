<?php

namespace App\pages;

require_once('../../bootstrap.php');

use DB;
use Smarty;

class login
{
    public $smarty;
    public static $username;
    public static $password;

    public function loader(): void
    {
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir('../vendor/smarty/smarty/template');
        $this->smarty->setConfigDir('../vendor/smarty/smarty/config');
        $this->smarty->setCompileDir('../vendor/smarty/smarty/compile');
        $this->smarty->setCacheDir('../vendor/smarty/smarty/cache');

        session_start();
        if (isset($_SESSION['username'])) {
            header("Location: ./../../index.php");
        }

        $this->smarty->assign('dir', '../');
        $this->smarty->assign('page_title', 'Login');
        $this->smarty->display('meta.tpl');
        $this->getData();
        $this->smarty->display('footer.tpl');
    }

    public function getData(): void
    {
        if (isset($_REQUEST['username'])) {
            self::$username = $_REQUEST["username"];
            self::$password = $_REQUEST["password"];
            self::checkUser();
        } else {
            $this->smarty->display('login.tpl');
        }
    }

    public static function checkUser(): void
    {
        $DB = new DB;
        $conn = $DB->conn();

        $stmt = $conn->prepare("SELECT * FROM `users` WHERE `username`= :username and `password`= :password");
        $stmt->execute(
            array(
                'username' =>  self::$username,
                'password' =>  self::$password
            )
        );
        $rowCount = $stmt->rowCount();
        if ($rowCount == 1) {
            $_SESSION["username"] = self::$username;
            $_SESSION['loggedin_time'] = time();
            header("Location: ./../../index.php");
        } else {
            echo "<div class='form'>
                <h3 class='mt-5 text-center'>Username/password is incorrect.</h3>
                <br/><p class='text-center'>Click here to <a href='login.php'>Login</a></p>
                </div>";
        }
    }
}
$login = new login;
$login->loader();
