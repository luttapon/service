<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");


require_once '../connectDB.php';
require_once '../models/T_011.php';
$connDB = new ConnectDB();
$T_011 = new T_011($connDB->getConnection());
$data = json_decode(file_get_contents("php://input"));
$result = $T_011->deleteTaskbyId($data->id);
if($result == true){
    $dataInfo = array();
        $dataArray = array(
            "msgresult" => "1"
        );

        array_push($dataInfo, $dataArray);
        echo json_encode($dataInfo);
}else{
    $dataInfo = array();
        $dataArray = array(
            "msgresult" => "0"
        );

        array_push($dataInfo, $dataArray);
        echo json_encode($dataInfo);
}
