<?php
include('connect.php');
session_start();

// ตรวจสอบสิทธิ์แอดมิน
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: form_login.php");
    exit();
}

// กรองข้อมูลรายงานตามวันที่ที่เลือก
$filter = $_GET['filter'] ?? 'daily';

if ($filter == 'monthly') {
    $query = "SELECT * FROM bookings WHERE DATE_FORMAT(booking_date, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')";
} elseif ($filter == 'yearly') {
    $query = "SELECT * FROM bookings WHERE YEAR(booking_date) = YEAR(CURDATE())";
} else {
    // รายวัน (default)
    $query = "SELECT * FROM bookings WHERE booking_date = CURDATE()";
}

$result = mysqli_query($conn, $query);
if (!$result) {
    die("เกิดข้อผิดพลาดในการดึงข้อมูล: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <title>รายงานการจอง</title>
    <link rel="stylesheet" href="report_style.css" />
</head>
<body>

    <!-- 🔗 ลิงก์กลับหน้าหลัก -->
    <div class="top-nav">
        <a href="index_admin.php" class="home-link">← หน้าหลัก</a>
    </div>

    <h1>รายงานการจอง</h1>

    <form method="get">
        <label><input type="radio" name="filter" value="daily" <?= ($filter == 'daily') ? 'checked' : '' ?>> รายวัน</label>
        <label><input type="radio" name="filter" value="monthly" <?= ($filter == 'monthly') ? 'checked' : '' ?>> รายเดือน</label>
        <label><input type="radio" name="filter" value="yearly" <?= ($filter == 'yearly') ? 'checked' : '' ?>> รายปี</label>
        <button type="submit">แสดงผล</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>รหัส</th>
                <th>ชื่อผู้จอง</th>
                <th>วันที่จอง</th>
                <th>รายการ</th>
                <th>จำนวนเงิน</th>
                <th>พิมพ์ใบเสร็จ</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) == 0): ?>
                <tr><td colspan="6" style="text-align:center; padding: 20px;">ไม่มีข้อมูลการจอง</td></tr>
            <?php else: ?>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td data-label="รหัส"><?= htmlspecialchars($row['id']) ?></td>
                    <td data-label="ชื่อผู้จอง"><?= htmlspecialchars($row['username']) ?></td>
                    <td data-label="วันที่จอง"><?= htmlspecialchars($row['booking_date']) ?></td>
                    <td data-label="รายการ"><?= htmlspecialchars($row['sala_name']) ?></td>
                    <td data-label="จำนวนเงิน">
                        <?php
                            $price = $row['price'];
                            echo is_numeric($price) ? number_format((float)$price, 2) : "0.00";
                        ?>
                    </td>
                    <td data-label="พิมพ์ใบเสร็จ"><a href="generate_invoice.php?id=<?= urlencode($row['id']) ?>" target="_blank" rel="noopener noreferrer">พิมพ์ใบเสร็จ</a></td>
                </tr>
                <?php } ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
