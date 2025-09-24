<?php
session_start();
require 'connect.php'; // ใช้เชื่อมต่อฐานข้อมูล
header('Content-Type: application/json');

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือยัง
if (!isset($_SESSION['username'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'คุณยังไม่ได้เข้าสู่ระบบ']);
    exit;
}

// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจากฟอร์ม
    $oldUsername = $_SESSION['username'];
    $newUsername = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    // ตรวจสอบว่ากรอกครบหรือไม่
    if ($newUsername === '' || $email === '' || $phone === '') {
        echo json_encode(['status' => 'error', 'message' => 'กรุณากรอกข้อมูลให้ครบ']);
        exit;
    }

    // Escape ข้อมูล
    $newUsername = $conn->real_escape_string($newUsername);
    $email = $conn->real_escape_string($email);
    $phone = $conn->real_escape_string($phone);

    // ถ้าเปลี่ยนชื่อ ต้องตรวจสอบว่าชื่อใหม่ซ้ำหรือไม่
    if ($newUsername !== $oldUsername) {
        $checkStmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
        $checkStmt->bind_param("s", $newUsername);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            echo json_encode(['status' => 'error', 'message' => 'ชื่อผู้ใช้นี้ถูกใช้แล้ว']);
            $checkStmt->close();
            exit;
        }

        $checkStmt->close();
    }

    // อัปเดตข้อมูล
    $updateStmt = $conn->prepare("UPDATE users SET username = ?, email = ?, phone = ? WHERE username = ?");
    $updateStmt->bind_param("ssss", $newUsername, $email, $phone, $oldUsername);

    if ($updateStmt->execute()) {
        // อัปเดต SESSION
        $_SESSION['username'] = $newUsername;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;

        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ไม่สามารถอัปเดตข้อมูลได้']);
    }

    $updateStmt->close();
    $conn->close();
}
?>
