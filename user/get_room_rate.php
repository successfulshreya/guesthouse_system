<?php
// get_room_rate.php

if (!isset($_GET['room_id'])) {
    http_response_code(400);
    echo "Missing room_id";
    exit;
}

include '../db_connect.php';

$room_id = intval($_GET['room_id']);
$stmt = $conn->prepare("SELECT rate_per_day FROM rooms WHERE id = ?");
$stmt->bind_param("i", $room_id);
$stmt->execute();
$result = $stmt->get_result();

if ($room = $result->fetch_assoc()) {
    echo $room['rate_per_day'];
} else {
    http_response_code(404);
    echo "Rate not found";
}
$stmt->close();
?>
