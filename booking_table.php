<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

// เชื่อมต่อฐานข้อมูล
$mysqli = new mysqli('localhost', 'root', '', 'phu');
if ($mysqli->connect_errno) {
    die("ไม่สามารถเชื่อมต่อฐานข้อมูลได้: " . $mysqli->connect_error);
}

// ดึงข้อมูลการจองของผู้ใช้
$sql = "SELECT id, sala_name, booking_date, price, payment_status, approval_status, rejection_reason 
        FROM bookings 
        WHERE username = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <title>ตารางการจอง</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fefefe;
            margin: 0;
            padding: 30px 0;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #2c3e50;
            text-shadow: 1px 1px 1px #eee;
        }
        table {
            width: 90%;
            max-width: 900px;
            margin: 0 auto 50px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        thead {
            background: linear-gradient(90deg, #ffb347, #ffcc33);
            color: white;
            font-weight: bold;
            font-size: 1.1em;
        }
        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tbody tr:hover {
            background-color: #fff3b0;
            transition: background-color 0.3s ease;
        }
        td {
            vertical-align: middle;
        }
        .status-waiting { color: #d35400; font-weight: 600; }
        .status-approved { color: #27ae60; font-weight: 600; }
        .status-rejected { color: #c0392b; font-weight: 600; }
        .no-data {
            text-align: center;
            font-style: italic;
            color: #999;
            padding: 25px 0;
        }
    </style>
</head>
<body>

<h2>ตารางการจองของคุณ</h2>

<table>
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>ศาลาที่จอง</th>
            <th>วันที่จอง</th>
            <th>แพ็กเกจ</th>
            <th>สถานะ</th>
            <th>เหตุผลปฏิเสธ</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php $i = 1; ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= htmlspecialchars($row['sala_name']); ?></td>
                    <td>
                        <?= $row['booking_date'] 
                            ? date('d/m/Y', strtotime($row['booking_date'])) 
                            : '-'; ?>
                    </td>
                    <td><?= is_numeric($row['price']) ? number_format($row['price']) . " บาท" : htmlspecialchars($row['price']); ?></td>
                    <td class="<?php 
                        echo $row['approval_status'] === 'waiting' ? 'status-waiting' : 
                             ($row['approval_status'] === 'approved' ? 'status-approved' : 
                             ($row['approval_status'] === 'rejected' ? 'status-rejected' : ''));
                    ?>">
                        <?php
                            if ($row['approval_status'] === 'waiting') echo "รออนุมัติ";
                            else if ($row['approval_status'] === 'approved') echo "อนุมัติแล้ว";
                            else if ($row['approval_status'] === 'rejected') echo "ปฏิเสธแล้ว";
                            else echo "ไม่ทราบสถานะ";
                        ?>
                    </td>
                    <td><?= htmlspecialchars($row['rejection_reason'] ?: '-'); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6" class="no-data">ยังไม่มีการจอง</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
$stmt->close();
$mysqli->close();
?>

</body>
</html>
