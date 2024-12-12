<?php
header('Content-Type: application/json');
require_once 'connection.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->video_id) && !empty($data->user_id) && !empty($data->content)) {
    $stmt = $con->prepare("INSERT INTO comments (id, video_id, user_id, content, create_at) VALUES (:id, :video_id, :user_id, :content, :create_at)");
    $stmt->bindParam(':id', $data->id);
    $stmt->bindParam(':video_id', $data->video_id);
    $stmt->bindParam(':user_id', $data->user_id);
    $stmt->bindParam(':content', $data->content);
    $stmt->bindParam(':create_at', $data->create_at);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Commentaire ajouté."]);
    } else {
        echo json_encode(["success" => false, "message" => "Erreur lors de l'ajout du commentaire."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Données incomplètes."]);
}
?>
