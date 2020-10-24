<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('../class/Student.php');
$student = new Student();
switch($requestMethod) {
	case 'POST':
	    $data = json_decode(file_get_contents('php://input'), true);
		$first_name = $data['first_name'];
		$last_name = $data['last_name'];
		$roll_no = $data['roll_no'];
		$class = $data['class'];
		$age = $data['age'];
		$address = $data['address'];
		//$status = $data['status'];
 
	    $student->setFirstName($first_name);
	    $student->setLastName($last_name);
	    $student->setRollNo($roll_no);
	    $student->setClassName($class);
	    $student->setAge($age);
	    $student->setAddress($address);
		$studentInfo = $student->createStudent();
 
		if(!empty($studentInfo)) {
	      $js_encode = json_encode(array('status'=>TRUE, 'message'=>'Student created Successfully'), true);
        } else {
            $js_encode = json_encode(array('status'=>FALSE, 'message'=>'Student creation failed.'), true);
        }
		header('Content-Type: application/json');
		echo $js_encode;	
		break;
	default:
	header("HTTP/1.0 405 Method Not Allowed");
	break;
}
?>	