<?php
require_once("bootstrap.php");

class checkVersion
{
    public $version;
    public $lastVersion;
    public $ResourceName;
    public $resourceID;
    public $AdditionalInfo;
    public $ip;
    public $country;
    public $smarty;
    public $DB;

    public function loader(): void
    {
        $this->DB = new DB;

        $this->version = $_SERVER['HTTP_VERSION'];
        $this->ResourceName = $_SERVER['HTTP_RESOUCE_NAME'];
        $this->AdditionalInfo = serialize($_SERVER['HTTP_ADDITIONAL_INFO']);
        $this->resourceID = $this->findResourceId($this->ResourceName);

        $this->ip = "191.101.31.36";  //$this->getIPAddress()

        $this->country = $this->ip_info($this->ip, 'country');
        $conn = $this->DB->conn();
        $resourceID = $this->resourceID;

        $getLastVersion = $conn->query("SELECT last_version FROM `resource` WHERE `id` = $resourceID")->fetchAll();
        $this->lastVersion = $getLastVersion[0]['last_version'];

        $this->insertIntoUseLog();

        $this->UpdateResource();
    }

    public function UpdateResource(): void
    {
        $conn = $this->DB->conn();
        $resourceID = $this->resourceID;

        $selectInstalles = $conn->query("SELECT COUNT(*) AS installed FROM `use_log_complate` AS ULC JOIN `use_log` AS UL ON ULC.use_log_id = UL.id WHERE UL.resource_id = $resourceID")->fetchAll();
        $installedCount = $selectInstalles[0]['installed'];
        $updateInstalles = $conn->prepare("UPDATE `resource` SET `install` = $installedCount WHERE id = $resourceID");
        $updateInstalles->execute();

        $selectActive = $conn->query("SELECT COUNT(*) AS activeInstall FROM `use_log` WHERE resource_id = $resourceID")->fetchAll();
        $activeInstallCount = $selectActive[0]['activeInstall'];
        $updateActive = $conn->prepare("UPDATE `resource` SET `active_install` = $activeInstallCount WHERE id = $resourceID");
        $updateActive->execute();
    }

    public function findResourceId(string $resourceName): int
    {
        $conn = $this->DB->conn();
        $stmt = $conn->query("SELECT `id` FROM `resource` WHERE `resource_name` = '$resourceName'")->fetchAll();
        if ($stmt != null) {
            return $stmt[0]['id'];
        } else {
            echo 'This resource not found';
            die;
        }
    }

    public function checkIpAndResourceExist(): bool
    {
        $conn = $this->DB->conn();
        $ip = $this->ip;
        $resourceID = $this->resourceID;

        $stmt = $conn->query("SELECT * FROM `use_log` WHERE `ip` = '$ip' and `resource_id` = '$resourceID'")->fetchAll();
        if ($stmt != null) {
            return true;
        } else {
            return false;
        }
    }

    public function insertIntoUseLog(): void
    {
        $conn = $this->DB->conn();
        $ip = $this->ip;
        $resourceID = $this->resourceID;

        $AdditionalInfo = $this->AdditionalInfo;

        if ($this->checkIpAndResourceExist()) {

            $stmt = $conn->query("SELECT * FROM `use_log` WHERE `ip` = '$ip'")->fetchAll();
            foreach ($stmt as $statment) {
                if ($resourceID == $statment['resource_id']) {

                    $lastVersion = $this->version;
                    $newRunsNumber = $statment['runs_number'] + 1;
                    $this->insertIntoComplate($statment['id']);

                    $updateData = $conn->prepare("UPDATE `use_log` SET `last_run_date_time`= now(), `last_run_version` = '$lastVersion', `runs_number` = $newRunsNumber, `additional_info` = '$AdditionalInfo' WHERE `ip` = '$ip' and `resource_id` = '$resourceID'");
                    $updateData->execute();
                }
            }
            echo $this->outputResponse();
        } else {

            $insertData = $conn->prepare("INSERT INTO use_log(`ip`, `resource_id`, `location`, `install_version`, `last_run_version`, `runs_number`, `additional_info`) VALUES (:ip, :resource_id, :location, :install_version, :last_run_version, :runs_number, :additional_info)");
            $insertData->execute(
                array(
                    "ip" => $this->ip,
                    "resource_id" => $this->resourceID,
                    "location" => $this->country,
                    "install_version" => $this->version,
                    "last_run_version" => $this->version,
                    "runs_number" => 1,
                    "additional_info" => $AdditionalInfo
                )
            );
            $last_id = $conn->lastInsertId();
            $this->insertIntoComplate($last_id);

            echo $this->outputResponse();
        }
    }

    public function outputResponse(): string
    {
        $conn = $this->DB->conn();
        $version = $this->version;
        $resourceID = $this->resourceID;

        $checkVersionInfo = $conn->query("SELECT * FROM `resource_version` WHERE `resource_id` = $resourceID and `version` = '$version'")->fetchAll();

        $getChangeLogs = $conn->query("SELECT * FROM `resource_version` WHERE `resource_id` = $resourceID")->fetchAll();

        $dbU = $checkVersionInfo[0]['need_db_update'];
        $configU = $checkVersionInfo[0]['need_congif_update'];
        $necessaryU = $checkVersionInfo[0]['necessary_update'];
        $releaseURL = $checkVersionInfo[0]['release_url'];
        $serverResponse = $checkVersionInfo[0]['need_server_response'];
        $clientResponse = $checkVersionInfo[0]['need_client_response'];
        
        $changeLog = array();

        foreach ($getChangeLogs as $log) {
            $changeLog[ $log['version'] ] = $log['change_log'];
        }

        $responseJson = json_encode(array(
            "resource-name" => $this->ResourceName,
            "current-version" => $version,
            "last-version" => $this->lastVersion,
            "release-URL" => $releaseURL,
            "DB-update" => $dbU,
            "Config-update" => $configU,
            "Necessary-update" => $necessaryU,
            "server-response" => $serverResponse,
            "client-response" => $clientResponse,
            "change-logs" => $changeLog
        ));
        return $responseJson;
    }

    public function insertIntoComplate($last_id): void
    {
        $conn = $this->DB->conn();
        $insertData = $conn->prepare("INSERT INTO `use_log_complate`(`use_log_id`, `version`, `additional_info`) VALUES (:use_log_id, :version, :additional_info)");
        $insertData->execute(
            array(
                "use_log_id" => $last_id,
                "version" => $this->version,
                "additional_info" => $this->AdditionalInfo
            )
        );
    }


    public function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
    {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }


    public function getIPAddress(): string
    {
        //whether ip is from the share internet  
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        //whether ip is from the remote address  
        else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}

$checkVersion = new checkVersion;
$checkVersion->loader();
