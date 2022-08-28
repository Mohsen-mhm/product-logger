<?php

namespace App\pages;

require_once('../../bootstrap.php');


use DB;
use Smarty;

class editResourceInfo
{
    public $ID;
    public $smarty;
    public $DB;
    public static $resourceID;
    public static $resourceName;
    public static $version;
    public static $changeLog;
    public static $realseURL;
    public static $dbUpdate;
    public static $configUpdate;
    public static $necessaryUpdate;
    public static $serverResponse;
    public static $clientResponse;
    public static $SRT1;
    public static $SRT2;
    public static $CRT1;
    public static $CRT2;

    public function loader(): void
    {
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir('../vendor/smarty/smarty/template');
        $this->smarty->setConfigDir('../vendor/smarty/smarty/config');
        $this->smarty->setCompileDir('../vendor/smarty/smarty/compile');
        $this->smarty->setCacheDir('../vendor/smarty/smarty/cache');

        $this->smarty->assign('dir', '../');
        $this->smarty->assign('page_title', 'Create resources');

        $this->DB = new DB;
        $this->ID = $_REQUEST['id'];
        $this->selectData();

        $this->smarty->display('meta.tpl');
        $this->getData();
    }

    public function getData(): void
    {
        if (isset($_REQUEST['resourceName'])) {
            self::$resourceName = $_REQUEST["resourceName"];
            self::$version = $_REQUEST["version"];
            self::$changeLog = $_REQUEST["changeLog"];
            self::$realseURL = $_REQUEST["realseURL"];

            self::$dbUpdate = isset($_REQUEST["DBupdate"]) ? (int)$_REQUEST["DBupdate"] : 0;
            self::$configUpdate = isset($_REQUEST["configUpdate"]) ? (int)$_REQUEST["configUpdate"] : 0;
            self::$necessaryUpdate = isset($_REQUEST["necessaryUpdate"]) ? (int)$_REQUEST["necessaryUpdate"] : 0;
            self::$serverResponse = isset($_REQUEST["serverResponse"]) ? (int)$_REQUEST["serverResponse"] : 0;
            self::$clientResponse = isset($_REQUEST["clientResponse"]) ? (int)$_REQUEST["clientResponse"] : 0;

            self::$SRT1 = $_REQUEST["serverResponseTireOne"];
            self::$SRT2 = $_REQUEST["serverResponseTireTwo"];
            self::$CRT1 = $_REQUEST["clientResponseTireOne"];
            self::$CRT2 = $_REQUEST["clientResponseTireTwo"];

            $this->UpdateResourceVersionTable();
            $id = $this->ID;
            $conn = $this->DB->conn();

            $stmt = $conn->query("SELECT * FROM resource_version WHERE `id` = $id")->fetchAll();
            $resourceID = $stmt[0]['resource_id'];


            header("Location: ./resourceInfo.php?id=$resourceID");
        } else {
            $this->smarty->display('editResourceInfo.tpl');
        }
    }

    public function checkUpdatesRequire(): void
    {
        $conn = $this->DB->conn();
        $id = $this->ID;

        $stmt = $conn->query("SELECT * FROM resource_version WHERE `id` = $id")->fetchAll();
        $resourceID = $stmt[0]['resource_id'];

        $statment = $conn->query("SELECT * FROM resource_version WHERE `resource_id` = $resourceID");
        foreach ($statment as $resourceVersion) {
            if ($resourceVersion['need_db_update'] == 1) {
                $stmt = $conn->prepare("UPDATE resource_version SET `need_db_update` = 1 WHERE `resource_id` = $resourceID");
                $stmt->execute();
            }
            if ($resourceVersion['need_congif_update'] == 1) {
                $stmt = $conn->prepare("UPDATE resource_version SET `need_congif_update` = 1 WHERE `resource_id` = $resourceID");
                $stmt->execute();
            }
            if ($resourceVersion['necessary_update'] == 1) {
                $stmt = $conn->prepare("UPDATE resource_version SET `necessary_update` = 1 WHERE `resource_id` = $resourceID");
                $stmt->execute();
            }
        }
    }

    public function UpdateResourceVersionTable(): void
    {
        $conn = $this->DB->conn();
        $id = $this->ID;

        $stmt = $conn->prepare("UPDATE resource_version SET `version`= :version, `change_log`= :change_log, `need_db_update`= :need_db_update, `need_congif_update`= :need_congif_update, `necessary_update`= :necessary_update, `release_url`= :release_url, `need_server_response`= :need_server_response, `need_client_response`= :need_client_response, `server_response_tire1`= :server_response_tire1, `server_response_tire2`= :server_response_tire2, `server_client_tire1`= :server_client_tire1, `server_client_tire2`= :server_client_tire2 WHERE `id` = $id");
        $stmt->execute(
            array(
                'version' => self::$version,
                'change_log' => self::$changeLog,
                'need_db_update' => self::$dbUpdate,
                'need_congif_update' => self::$configUpdate,
                'necessary_update' => self::$necessaryUpdate,
                'release_url' => self::$realseURL,
                'need_server_response' => self::$serverResponse,
                'need_client_response' => self::$clientResponse,
                'server_response_tire1' => self::$SRT1,
                'server_response_tire2' => self::$SRT2,
                'server_client_tire1' => self::$CRT1,
                'server_client_tire2' => self::$CRT2
            )
        );
        $this->checkUpdatesRequire();
    }

    public function selectData(): void
    {
        $id = $this->ID;
        $conn = $this->DB->conn();
        $stmt = $conn->query("SELECT * FROM resource_version WHERE `id` = $id")->fetchAll();
        $resourceID = $stmt[0]['resource_id'];

        $statment = $conn->query("SELECT `resource_name` FROM resource JOIN resource_version ON resource.id = $resourceID")->fetchAll();
        $resourceName = $statment[0]['resource_name'];

        $this->smarty->assign(array(
            'resourceName' => $resourceName,
            'version' => $stmt[0]['version'],
            'change_log' => $stmt[0]['change_log'],
            'release_url' => $stmt[0]['release_url'],
            'dbChecked' => '',
            'congifChecked' => '',
            'necessaryChecked' => '',
            'serverChecked' => '',
            'clientChecked' => '',
            'server_response_tire1' => $stmt[0]['server_response_tire1'],
            'server_response_tire2' => $stmt[0]['server_response_tire2'],
            'server_client_tire1' => $stmt[0]['server_client_tire1'],
            'server_client_tire2' => $stmt[0]['server_client_tire2']
        ));
        if ($stmt[0]['need_db_update'] == 1)
            $this->smarty->assign('dbChecked', 'checked');
        if ($stmt[0]['need_congif_update'] == 1)
            $this->smarty->assign('congifChecked', 'checked');
        if ($stmt[0]['necessary_update'] == 1)
            $this->smarty->assign('necessaryChecked', 'checked');
        if ($stmt[0]['need_server_response'] == 1)
            $this->smarty->assign('serverChecked', 'checked');
        if ($stmt[0]['need_client_response'] == 1)
            $this->smarty->assign('clientChecked', 'checked');
    }
}
$editResource = new editResourceInfo;
$editResource->loader();
