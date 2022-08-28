<?php

require_once("bootstrap.php");
require_once('auth.php');

auth::checkUser();

class app
{
    public $smarty;
    public $DB;

    public function loader(): void
    {
        $this->DB = new DB;
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir(__DIR__ . '/App/vendor/smarty/smarty/template');
        $this->smarty->setConfigDir(__DIR__ . '/App/vendor/smarty/smarty/config');
        $this->smarty->setCompileDir(__DIR__ . '/App/vendor/smarty/smarty/compile');
        $this->smarty->setCacheDir(__DIR__ . '/App/vendor/smarty/smarty/cache');

        $this->smarty->assign('dir', 'App/');
        $this->smarty->assign('page_title', 'Resources');
        $this->smarty->display('meta.tpl');
        $this->smarty->display('index.tpl');
        $this->smarty->display('footer.tpl');
    }
}
$app = new app;
$app->loader();
