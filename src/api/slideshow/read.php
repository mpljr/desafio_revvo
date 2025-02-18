<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../models/Slideshow.php';

$database = new Database();
$db = $database->getConnection();

$slideshow = new Slideshow($db);
$stmt = $slideshow->read();
$num = $stmt->rowCount();

if($num > 0) {
    $slides_arr = array();
    $slides_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $slide_item = array(
            "id" => $id,
            "title" => $title,
            "description" => $description,
            "image_url" => $image_url,
            "button_text" => $button_text,
            "button_link" => $button_link,
            "order_position" => $order_position,
            "created_at" => $created_at
        );

        array_push($slides_arr["records"], $slide_item);
    }

    http_response_code(200);
    echo json_encode($slides_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "No slides found."));
}