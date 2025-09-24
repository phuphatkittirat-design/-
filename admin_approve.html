<?php
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=phu;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookingId = $_POST['booking_id'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        $status = 'approved';
        $rejectionReason = null; // เคลียร์เหตุผลถ้าอนุมัติ
    } elseif ($action === 'reject') {
        $status = 'rejected';
        // รับเหตุผลปฏิเสธจากฟอร์ม
        $rejectionReason = isset($_POST['rejection_reason']) ? trim($_POST['rejection_reason']) : null;
    } else {
        header("Location: index_admin.php");
        exit;
    }

    // อัพเดตสถานะและเหตุผลปฏิเสธ (ถ้ามี)
    $stmt = $pdo->prepare("UPDATE bookings SET approval_status = ?, rejection_reason = ? WHERE id = ?");
    $stmt->execute([$status, $rejectionReason, $bookingId]);

    header("Location: index_admin.php");
    exit;
}
?>
