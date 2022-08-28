<?php

namespace App\pages;

require_once('../../bootstrap.php');

use DB;
use Smarty;

class resourceInfo
{
    public $smarty;
    public $DB;
    public $ID;

    public function loader(): void
    {
        $this->ID = $_REQUEST['id'];
        $this->DB = new DB;

        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir('../vendor/smarty/smarty/template');
        $this->smarty->setConfigDir('../vendor/smarty/smarty/config');
        $this->smarty->setCompileDir('../vendor/smarty/smarty/compile');
        $this->smarty->setCacheDir('../vendor/smarty/smarty/cache');

        $this->smarty->assign('dir', '../');
        $this->smarty->assign('page_title', 'Resource Info');
        
        $this->smarty->assign('id', $this->ID);
        $this->smarty->display('meta.tpl');
        $this->showData();
        $this->smarty->display('resourceInfo.tpl');
        $this->smarty->display('footer.tpl');
    }

    public function showData(): void
    {
        $id = $this->ID;
        $conn = $this->DB->conn();
        $stmt = $conn->query("SELECT * FROM resource_version WHERE `resource_id` = $id")->fetchAll();

        $statment = $conn->query("SELECT * FROM resource WHERE id = $id")->fetchAll();
        $resourceName = $statment[0]['resource_name'];

        $this->smarty->assign('resource_name', $resourceName);
    }
}

$resourceInfo = new resourceInfo;
$resourceInfo->loader();
