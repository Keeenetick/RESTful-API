<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
// $settings =  [
//     'settings' => [
//         'displayErrorDetails' => true,
//     ],
// ];
$app = new \Slim\App();
//Get all  students
$app->get('/students', function (Request $request, Response $response) {
 	$sql = "SELECT * FROM students";
 	try {
 		$db = new Database();
 		$db = $db->connect();
 		$stmt = $db->query($sql);
 		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
 		$db = null;
 		echo json_encode($result);
 	}catch(PDOException $e){
        echo '{"error":{"text": '.$e->getMessage().'}';
    }
 
    
});
//Get single student
$app->get('/student/{id}', function (Request $request, Response $response) {
	$id = $request->getAttribute('id');
 	$sql = "SELECT * FROM students WHERE id = $id";
 	try {
 		$db = new Database();
 		$db = $db->connect();
 		$stmt = $db->query($sql);
 		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
 		$db = null;
 		echo json_encode($result);
 	}catch(PDOException $e){
        echo '{"error":{"text": '.$e->getMessage().'}';
    }
 
    
});
// Add student
$app->post('/student/add', function (Request $request, Response $response) {
 	$name = $request->getParam('name');
 	$surname = $request->getParam('surname');
 	$phone = $request->getParam('phone');
 	$sql = "INSERT INTO students (name,surname,phone)VALUES(:name,:surname,:phone)";
 	try {
 		$db = new Database();
 		$db = $db->connect();
 		$stmt = $db->prepare($sql);
 		$stmt->bindParam(':name',$name);
 		$stmt->bindParam(':surname',$surname);
 		$stmt->bindParam(':phone',$phone);
		$stmt->execute(); 		
 		echo '{"message:"{"text": "Student Added"}';
 	}catch(PDOException $e){
        echo '{"error":{"text": '.$e->getMessage().'}';
    }
 
    
});
//Update Student
$app->put('/student/update/{id}', function (Request $request, Response $response) {
	$id = $request->getAttribute('id');
 	$name = $request->getParam('name');
 	$surname = $request->getParam('surname');
 	$phone = $request->getParam('phone');
 	$sql = "UPDATE students SET name = :name,surname = :surname,phone = :phone WHERE id = $id";
 	try {
 		$db = new Database();
 		$db = $db->connect();
 		$stmt = $db->prepare($sql);
 		$stmt->bindParam(':name',$name);
 		$stmt->bindParam(':surname',$surname);
 		$stmt->bindParam(':phone',$phone);
		$stmt->execute(); 		
 		echo '{"message:"{"text": "Student Updated"}';
 	}catch(PDOException $e){
        echo '{"error":{"text": '.$e->getMessage().'}';
    }
});
//Delete student
$app->delete('/student/delete/{id}', function (Request $request, Response $response) {
	$id = $request->getAttribute('id');
 	$sql = "DELETE FROM students WHERE id = $id";
 	try {
 		$db = new Database();
 		$db = $db->connect();
 		$stmt = $db->prepare($sql);
		$stmt->execute(); 		
 		echo '{"message:"{"text": "Student Deleted"}';
 	}catch(PDOException $e){
        echo '{"error":{"text": '.$e->getMessage().'}';
    }
});


