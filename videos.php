<?php
header('Content-Type: application/json');
require_once 'connection.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id) && !empty($data->user_id) && !empty($data->title) && !empty($data->description) && !empty($data->url)) {
    $stmt = $con->prepare("INSERT INTO likes (id, video_id, user_id, create_at, title, description, url,  ) VALUES (:id, :video_id, :user_id, :create_at, :title, :description, :url)");
    $stmt->bindParam(':id', $data->id);
    $stmt->bindParam(':video_id', $data->video_id);
    $stmt->bindParam(':user_id', $data->user_id);
    $stmt->bindParam(':create_at', $data->create_at);
    $stmt->bindParam(':title', $data->title);
    $stmt->bindParam(':description', $data->description);
    $stmt->bindParam(':url', $data->url);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Like ajouté."]);
    } else {
        echo json_encode(["success" => false, "message" => "Erreur lors de l'ajout du like."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Données incomplètes."]);
}
?>