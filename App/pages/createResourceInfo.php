<?php

namespace App\pages;

require_once('../../bootstrap.php');


use DB;
use Smarty;

class createResourceInfo
{
    public $ID;
    public $smarty;
    public $DB;
    public static $resourceID;
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
        $this->DB = new DB;
        $this->ID = $_REQUEST['id'];

        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir('../vendor/smarty/smarty/template');
        $this->smarty->setConfigDir('../vendor/smarty/smarty/config');
        $this->smarty->setCompileDir('../vendor/smarty/smarty/compile');
        $this->smarty->setCacheDir('../vendor/smarty/smarty/cache');

        $this->smarty->assign('dir', '../');
        $this->smarty->assign('page_title', 'Create resources');
        $conn = $this->DB->conn();
        $id = $this->ID;


        $this->getData();

        $this->smarty->display('meta.tpl');
    }

    public function getData(): void
    {
        if (isset($_REQUEST['version'])) {
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

            $this->insertData();
            $this->checkUpdatesRequire();

            header("Location: ./resourceInfo.php?id=$this->ID");
        } else {
            $this->smarty->display('createResourceInfo.tpl');
        }
    }

    public function insertData(): void
    {
        $conn = $this->DB->conn();
        $id = $this->ID;

        $stmt = $conn->prepare("INSERT INTO resource_version(`resource_id`,`version`,`change_log`,`need_db_update`,`need_congif_update`,`necessary_update`,`release_url`,`need_server_response`,`need_client_response`,`server_response_tire1`,`server_response_tire2`,`server_client_tire1`,`server_client_tire2`) VALUES ($id, :version, :change_log, :need_db_update, :need_congif_update, :necessary_update, :release_url, :need_server_response, :need_client_response, :server_response_tire1, :server_response_tire2, :server_client_tire1, :server_client_tire2)");
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
        $stmt = $conn->prepare("UPDATE `resource` SET `last_version` = :version WHERE id = $id");
        $stmt->execute(array("version" => self::$version));
    }

    public function checkUpdatesRequire(): void
    {
        $conn = $this->DB->conn();
        $id = $this->ID;

        $statment = $conn->query("SELECT * FROM resource_version WHERE `resource_id` = $id");
        foreach ($statment as $resourceVersion) {
            if ($resourceVersion['need_db_update'] == 1) {
                $stmt = $conn->prepare("UPDATE resource_version SET `need_db_update` = 1 WHERE `resource_id` = $id");
                $stmt->execute();
            }
            if ($resourceVersion['need_congif_update'] == 1) {
                $stmt = $conn->prepare("UPDATE resource_version SET `need_congif_update` = 1 WHERE `resource_id` = $id");
                $stmt->execute();
            }
            if ($resourceVersion['necessary_update'] == 1) {
                $stmt = $conn->prepare("UPDATE resource_version SET `necessary_update` = 1 WHERE `resource_id` = $id");
                $stmt->execute();
            }
        }
    }
}

$createResourceInfo = new createResourceInfo;
$createResourceInfo->loader();
