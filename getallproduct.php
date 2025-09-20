<?php


    require_once('./db.php');

    header('Content-Type: application/json; charset=utf-8');

    try {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $object = new stdClass();

            $stmt = $db->prepare('select * from sp_product order by id desc');

            if($stmt->execute()) {
                $num = $stmt->rowCount();
                if($num > 0) {

                    $object->Result = array();
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        // array_push( $object->Result , $row );
                        $object->Result[] = $row;
                    }
                    $object->RespCode = 200;
                    $object->RespMessage = 'success';
                    http_response_code(200);
                }
                else {
                    $object->RespCode = 404;
                    $object->Log = 0;
                    $object->RespMessage = 'Not found data';
                    http_response_code(404);
                }

                echo json_encode($object);
            }
            else {
                $object->RespCode = 500;
                $object->Log = 1;
                $object->RespMessage = 'SQL execution error';
                http_response_code(500);
                echo json_encode($object);
            }
        }
        else {
            http_response_code(405);
        }
    }
    catch(PDOException $e) {
        http_response_code(500);
        echo json_encode([
            'RespCode' => 500,
            'RespMessage' => 'Internal server error'
        ]);
    }

?>