<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require   './../../init_boot.php';

//$serverName = "WIN-JN8ICE3H8UA\\OPTIMA"; //serverName\instanceName
$serverName = "10.3.0.202\\OPTIMA"; //serverName\instanceName
$connectionInfo = array( "Database"=>"sql_express_CDN_KLEMENT", "UID"=>"Cstore", "PWD"=>"zxcvasdfGV");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
    echo "Connection established.<br />";

    $q = '
        SELECT
          *
        FROM
          ' . OptimaRepository::DATABASE_PREFIX . '.INFORMATION_SCHEMA.TABLES;
    ';

    $stmt = sqlsrv_query($conn, $q, []);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $arr = [];

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $arr[] = $row;
    }

    echo '<pre>';
    echo var_dump($arr);
    echo '</pre>';
    
}else{
    echo "Connection could not be established.<br />";
    echo '<pre>';
    echo var_dump(sqlsrv_errors());
    echo '</pre>';
    die();
}
