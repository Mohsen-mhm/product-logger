<?php

namespace App;

require_once('../bootstrap.php');
require_once('./ssp.php');

use SSP;
use DB;


/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'resource_version';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array('db' => 'id', 'dt' => 0),
    array('db' => 'resource_id',  'dt' => 1),
    array('db' => 'version',   'dt' => 2),
    array('db' => 'change_log',     'dt' => 3),
    array('db' => 'need_db_update',     'dt' => 4),
    array('db' => 'need_congif_update',     'dt' => 5),
    array('db' => 'necessary_update',     'dt' => 6),
    array('db' => 'release_url',     'dt' => 7),
    array('db' => 'need_server_response',     'dt' => 8),
    array('db' => 'need_client_response',     'dt' => 9)
);

// // SQL server connection information
// $sql_details = array(
//     'user' => 'root',
//     'pass' => '',
//     'db'   => 'product_logger',
//     'host' => 'localhost'
// );

$DB = new DB;
$conn = $DB->conn();


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

$data = SSP::simple($_GET, $conn, $table, $primaryKey, $columns);

if (is_array($data['data'])) {
    foreach ($data['data'] as $i => $value) {
        $data['data'][$i][1] = $value[2];
        $data['data'][$i][2] = $value[4];
        $data['data'][$i][3] = $value[5];
        $data['data'][$i][4] = $value[6];
        $data['data'][$i][5] = $value[7];
        $data['data'][$i][6] = $value[8];
        $data['data'][$i][7] = $value[9];
        $data['data'][$i][8] = "<a href='./editResourceInfo.php?id=" . $value[0] . "' class='btn btn-info'>Edit</a>";
    }
}

echo json_encode($data);
