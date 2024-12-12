<?php
require_once 'connection.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $stmt = $con->prepare("SELECT * FROM users");
        $stmt->execute();
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $con->prepare("INSERT INTO users (username, email) VALUES (:username, :email)");
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->execute();
        echo json_encode(['success' => true, 'user' => $data]);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $con->prepare("UPDATE users SET username = :username, email = :email WHERE id = :id");
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':id', $data['id']);
        $stmt->execute();
        echo json_encode(['success' => true]);
        break;

    case 'DELETE':
        parse_str(file_get_contents("php://input"), $data);
        $stmt = $con->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $data['id']);
        $stmt->execute();
        echo json_encode(['success' => true]);
        break;
}
?>
