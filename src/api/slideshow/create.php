<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../models/Slideshow.php';

$database = new Database();
$db = $database->getConnection();

$slideshow = new Slideshow($db);

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->title) &&
    !empty($data->description) &&
    !empty($data->image_url) &&
    !empty($data->button_text) &&
    !empty($data->button_link) &&
    isset($data->order_position)
){
    $slideshow->title = $data->title;
    $slideshow->description = $data->description;
    $slideshow->image_url = $data->image_url;
    $slideshow->button_text = $data->button_text;
    $slideshow->button_link = $data->button_link;
    $slideshow->order_position = $data->order_position;

    if($slideshow->create()){
        http_response_code(201);
        echo json_encode(array("message" => "Slide was created."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create slide."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create slide. Data is incomplete."));
}