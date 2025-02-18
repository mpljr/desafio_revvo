<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../models/Course.php';

$database = new Database();
$db = $database->getConnection();

$course = new Course($db);

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->title) &&
    !empty($data->description) &&
    !empty($data->image_url)
){
    $course->title = $data->title;
    $course->description = $data->description;
    $course->image_url = $data->image_url;

    if($course->create()){
        http_response_code(201);
        echo json_encode(array("message" => "Course was created."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create course."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create course. Data is incomplete."));
}