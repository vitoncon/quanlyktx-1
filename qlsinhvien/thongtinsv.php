<?php
session_start();
require_once('../auth_check.php');
include('../config.php');

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "SELECT * FROM sinhvien WHERE idsinhvien = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($student = $result->fetch_assoc()) {
        echo json_encode(['success' => true, 'student' => $student]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Không tìm thấy sinh viên']);
    }
    
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Thiếu tham số ID']);
}
?>