<?php
/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/6/15
 * Time: 3:24 PM
 */
require '../service/StudentService.php';


$post = file_get_contents("php://input");
$student = json_decode($post);

$response = array();

// the student name is obligatory
if(empty($student->name)) {
    $response['success'] = false;
    $response['message'] = 'Sorry, your name is empty';
    echo json_encode($response);
    die();
}

// the student skype ID is obligatory
if(empty($student->skype)) {
    $response['success'] = false;
    $response['message'] = 'Sorry, you have to get a Skype ID';
    echo json_encode($response);
    die();
}

// the student wechat ID is obligatory
if(empty($student->wechat)) {
    $response['success'] = false;
    $response['message'] = 'Sorry, your wechat ID is empty';
    echo json_encode($response);
    die();
}

// the student have give at least 2 contact ID
$contactNumber = 0;

if(!empty($student->wechat)) {
    $contactNumber = $contactNumber + 1;
}
if(!empty($student->qq)) {
    $contactNumber = $contactNumber + 1;
}
if(!empty($student->skype)) {
    $contactNumber = $contactNumber + 1;
}
if(!empty($student->mobile)) {
    $contactNumber = $contactNumber + 1;
}

if($contactNumber < 2) {
    $response['success'] = false;
    $response['message'] = 'Sorry, you have to give us 2 contact ID at least';
    echo json_encode($response);
    die();
}

// the student have to choose at least 2 days to have class
$classDay = 0;

if((!empty($student->monday->time)) && ($student->monday->length > 0)) {
    $classDay = $classDay + 1;
}
if((!empty($student->tuesday->time)) && ($student->tuesday->length > 0)) {
    $classDay = $classDay + 1;
}
if((!empty($student->wednesday->time)) && ($student->wednesday->length > 0)) {
    $classDay = $classDay + 1;
}
if((!empty($student->thursday->time)) && ($student->thursday->length > 0)) {
    $classDay = $classDay + 1;
}
if((!empty($student->friday->time)) && ($student->friday->length > 0)) {
    $classDay = $classDay + 1;
}
if((!empty($student->saturday->time)) && ($student->saturday->length > 0)) {
    $classDay = $classDay + 1;
}
if((!empty($student->sunday->time)) && ($student->sunday->length > 0)) {
    $classDay = $classDay + 1;
}

if($classDay < 1) {
    $response['success'] = false;
    $response['message'] = 'Sorry, you schedule is empty';
    echo json_encode($response);
    die();
}

// insert into database
$service = new StudentService();
if($service->create($student)){
    $response['success'] = true;
    $response['message'] = $student->name;
}else {
    $response['success'] = false;
    $response['message'] = 'Sorry, there are something wrong with database';
}

echo json_encode($response);


//if(empty($student->monday->time)){
//    $response['message'] = $student->monday->length;
//}else {
//    $response['message'] = $student->monday->time;
//}
//error_log(count((array)$student->monday));
//$response['message'] = $student->monday->time;

//$message = $name;
//if($student->monday.length == 0) {
//    $response['message'] = "no schedule";
//}else {
//    $response['message'] = $student->monday->time . ':' . $student->monday->length;
//}

//$errors = array();
//$errors[] = "No.1 error";
//$errors[] = "No.2 error";

//$response['errors'] = $errors;

//
//error_log(json_encode($response));
