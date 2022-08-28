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
$table = 'resource';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array('db' => 'id', 'dt' => 0),
    array('db' => 'resource_name',  'dt' => 1),
    array('db' => 'last_version',   'dt' => 2),
    array('db' => 'install',     'dt' => 3),
    array('db' => 'active_install',     'dt' => 4)
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
if (is_array($data['data']))
    foreach ($data['data'] as $i => $value)
        $data['data'][$i][5] = "<a href='./app/pages/resourceInfo.php?id=" . $value[0] . "' class='btn btn-info'>More Info</a>";
echo json_encode($data);
