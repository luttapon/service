<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

require_once '../connectDB.php';
require_once '../models/T_011.php';

$connDB = new ConnectDB();
$T_011 = new T_011($connDB->getConnection());

$result = $T_011->getAllTasks();

if($result->rowCount() > 0) {

}else{
    $dataInfo = array();
    $dataArray = array(
        "msgresult" => "0"
    );
    array_push($dataInfo, $dataArray);
    echo json_encode($dataInfo);
}
