<?php
header('Content-Type: application/json');
require_once 'connection.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->video_id) && !empty($data->user_id)) {
    $stmt = $con->prepare("INSERT INTO favorites (id, video_id, user_id, create_at) VALUES (:id, :video_id, :user_id, :create_at)");
    $stmt->bindParam(':id', $data->id);
    $stmt->bindParam(':video_id', $data->video_id);
    $stmt->bindParam(':user_id', $data->user_id);
    $stmt->bindParam(':create_at', $data->create_at);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Ajouté aux favoris."]);
    } else {
        echo json_encode(["success" => false, "message" => "Erreur lors de l'ajout aux favoris."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Données incomplètes."]);
}
?>
