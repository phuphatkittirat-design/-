<?php
session_start();

include('connect.php'); // เชื่อมต่อฐานข้อมูล

// ตรวจสอบสิทธิ์แอดมิน
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: form_login.php");
    exit();
}

// รับค่า booking_id จาก URL
$booking_id = $_GET['id'] ?? '';

if (!$booking_id) {
    echo "ไม่มีเลขที่การจอง";
    exit();
}

// เตรียม statement ปลอดภัยจาก SQL injection
$query = "SELECT * FROM bookings WHERE id = ?";
$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();

$data = $result->fetch_assoc();

if (!$data) {
    echo "ไม่พบข้อมูลการจอง";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>ใบเสร็จ</title>
    <style>
        body { font-family: sans-serif; padding: 40px; }
        .invoice-box {
            border: 1px solid #ccc;
            padding: 20px;
            width: 600px;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="invoice-box">
        <h2>ใบเสร็จรับเงิน</h2>
        <p><strong>รหัสการจอง:</strong> <?= htmlspecialchars($data['id']) ?></p>
        <p><strong>ชื่อผู้จอง:</strong> <?= htmlspecialchars($data['username']) ?></p>
        <p><strong>วันที่จอง:</strong> <?= htmlspecialchars($data['booking_date']) ?></p>
        <p><strong>รายการ:</strong> <?= htmlspecialchars($data['sala_name']) ?></p>
        <p><strong>จำนวนเงิน:</strong> <?= number_format((float)$data['price'], 2) ?> บาท</p>
        <hr>
        <p>ขอบคุณที่ใช้บริการ</p>
    </div>
</body>
</html>
