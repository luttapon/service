    <?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: application/json; charset=UTF-8");

    require_once './../connectDB.php';
    require_once './../models/T_011.php';

    $connDB = new ConnectDB();
    $T_011 = new T_011($connDB->getConnection());

    $data = json_decode(file_get_contents("php://input"));

    $result = $T_011->gettaskByName($data->taskName);

    if ($result->rowCount() > 0) {
        $dataInfo = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        
            $dataArray = array(
                "id" => $row['id'],         
                "taskName" => $row['taskName'],
                "taskDetail" => $row['taskDetail'],
                "taskStatus" => $row['taskStatus']
            );
            array_push($dataInfo, $dataArray);
        }
        echo json_encode($dataInfo);
    } else {
        $dataInfo = array();
        $dataArray = array(
            "msgresult" => "0"
        );

        array_push($dataInfo, $dataArray);
        echo json_encode($dataInfo);
    }
