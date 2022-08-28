<?php

namespace App\pages;

require_once('../../bootstrap.php');

use DB;
use Smarty;

class createResource
{
    public $smarty;
    public $DB;
    public static $resourceName;
    public static $version;
    public static $resourceID;

    public function loader(): void
    {
        $this->DB = new DB;
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir('../vendor/smarty/smarty/template');
        $this->smarty->setConfigDir('../vendor/smarty/smarty/config');
        $this->smarty->setCompileDir('../vendor/smarty/smarty/compile');
        $this->smarty->setCacheDir('../vendor/smarty/smarty/cache');

        $this->smarty->assign('dir', '../');
        $this->smarty->assign('page_title', 'Create resources');

        $this->smarty->display('meta.tpl');

        $this->getData();

        $this->smarty->display('footer.tpl');
    }

    public function getData(): void
    {
        if (isset($_REQUEST['resourceName'])) {
            self::$resourceName = $_REQUEST["resourceName"];
            self::$version = $_REQUEST["version"];

            $this->insertDataToResource();

            header("Location: ./../../index.php");
        } else {
            $this->smarty->display('createResource.tpl');
        }
    }

    public function insertDataToResource(): void
    {
        $conn = $this->DB->conn();
        $statement = $conn->prepare("INSERT INTO `resource` (`resource_name`,`last_version`) VALUES (:resource_name, :version)");

        $statement->execute(
            array(
                'resource_name' => self::$resourceName,
                'version' => self::$version
            )
        );

        $last_id = $conn->lastInsertId();
        $stmt = $conn->prepare("INSERT INTO `resource_version` (`resource_id`, `version`) VALUES ($last_id, :version)");
        $stmt->execute(array('version' => self::$version));
    }
}

$createResource = new createResource;
$createResource->loader();
