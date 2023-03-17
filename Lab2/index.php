<?php
require_once("config.php");
require_once("MySQLHandler.php");

$SQL = new MySQLHandler("products");
$connect = $SQL->connect();
if ($connect) {
    $URL = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $URL = explode('/', $URL);
    if ($URL[3] !== 'products') {
        http_response_code(404);
        header(" Resource dosn't exist");
        exit();
    }
    $productId = null;
    if (isset($URL[4])) {
        $productId = (int) $URL[4];
    }
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    switch ($requestMethod) {
        case 'GET':
            if ($productId) {
                $isId = $SQL->search("id", $productId);
                $SQL->connect();
                if ($isId) {
                    $res = $SQL->get_record_by_id($productId);

                    echo json_encode($res);
                } else {
                    http_response_code(404);
                }
            } else {
                $res = $SQL->get_data();
                echo json_encode($res);
            };
            break;
        case 'POST':
            $post = json_decode(file_get_contents('php://input'), true);
            $res = $SQL->save($post);
            break;
        case 'PUT':
            if ($productId) {
                $isId = $SQL->search("id", $productId);
                $SQL->connect();
                if ($isId) {
                    $update = json_decode(file_get_contents('php://input'), true);
                    $res = $SQL->update($update, $productId);
                } else {
                    http_response_code(404);
                }
            }
            break;

        case 'DELETE':
            if ($productId) {
                $isId = $SQL->search("id", $productId);
                $SQL->connect();
                if ($isId) {
                    $res =  $SQL->delete($productId);
                } else {
                    http_response_code(404);
                }
            }
            break;

        default:
            http_response_code(405);
            $res = "method not allowed!";
            break;
    }
} else {
    http_response_code(501);
}
