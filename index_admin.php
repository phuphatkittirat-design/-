<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

require 'connect.php';

// ดึงรายการจองที่รออนุมัติ
$sql = "SELECT * FROM bookings WHERE approval_status = 'waiting'";
$result = $conn->query($sql);
$bookings = [];
if ($result) {
    $bookings = $result->fetch_all(MYSQLI_ASSOC);
}

// ดึงข้อมูลศาลาทั้งหมด
$sql2 = "SELECT * FROM salas";
$result2 = $conn->query($sql2);
$salas = [];
if ($result2) {
    $salas = $result2->fetch_all(MYSQLI_ASSOC);
}
?>
<form action="logout.php" method="post" style="display:inline;">
    <button type="submit" style="background-color: red; color: white; padding: 5px 10px; border: none; cursor: pointer;" onclick="return confirm('คุณต้องการออกจากระบบใช่หรือไม่?')">
        🚪 ออกจากระบบ
    </button>
</form>
<a href="admin_report.php">📄 รายงานการจอง</a>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แดชบอร์ดแอดมิน</title>
    <style>
        /* โค้ด CSS เดิม */
    </style>
</head>
<body>
<div class="centered-header">
    <h1>ยินดีต้อนรับแอดมิน <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    <p>นี่คือหน้าควบคุมของแอดมิน</p>
</div>

<!-- รออนุมัติ -->
<div class="section">
    <h2>🔄 รอการอนุมัติ</h2>
    <table>
        <thead>
            <tr>
                <th>รหัสจอง</th>
                <th>ชื่อผู้ใช้</th>
                <th>ชื่อศาลา</th>
                <th>วันที่จอง</th>
                <th>สถานะ</th>
                <th>สลิป</th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($bookings) === 0): ?>
                <tr><td colspan="7">ไม่มีข้อมูล</td></tr>
            <?php else: ?>
                <?php foreach ($bookings as $b): ?>
                <tr>
                    <td><?= htmlspecialchars($b['id']) ?></td>
                    <td><?= htmlspecialchars($b['username']) ?></td>
                    <td><?= htmlspecialchars($b['sala_name']) ?></td>
                    <td><?= htmlspecialchars($b['booking_date']) ?></td>
                    <td><?= htmlspecialchars($b['approval_status']) ?></td>
                    <td>
                        <?php if ($b['slip_file']): ?>
                            <a href="uploads/<?= htmlspecialchars($b['slip_file']) ?>" target="_blank">ดูสลิป</a>
                        <?php else: ?>
                            ไม่มี
                        <?php endif; ?>
                    </td>
                    <td>
                        <!-- ปุ่มอนุมัติ -->
                            <form action="admin_approve.php" method="post" style="display:inline-block;">
                                <input type="hidden" name="booking_id" value="<?= $b['id'] ?>">
                                <input type="hidden" name="action" value="approve">
                                <button type="submit" class="approve">อนุมัติ</button>
                            </form>

                            <!-- ปุ่มปฏิเสธ -->
                            <form action="admin_approve.php" method="post" style="display:inline-block; margin-left:5px;" onsubmit="return confirmReject(this);">
                                <input type="hidden" name="booking_id" value="<?= $b['id'] ?>">
                                <input type="hidden" name="action" value="reject">
                                <input type="hidden" name="rejection_reason" value="">
                                <button type="submit" class="reject">ปฏิเสธ</button>
                            </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- ข้อมูลศาลา -->
<!-- ข้อมูลศาลา -->
<div class="section">
    <h2>🛠️ ข้อมูลศาลาทั้งหมด</h2>
    <table>
        <thead>
            <tr>
                <th>รหัส</th>
                <th>ชื่อ</th>
                <th>สิ่งอำนวยความสะดวก</th>
                <th>ราคา</th>
                <th>รูปภาพ</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($salas as $s): ?>
            <tr>
                <td><?= $s['id'] ?></td>
                <td><?= htmlspecialchars($s['name']) ?></td>
                <td><?= htmlspecialchars($s['features']) ?></td>
                <td><?= $s['price'] ?></td>
                <td><img src="<?= htmlspecialchars($s['image_path']) ?>" width="80"></td>
                <td>
                    <a href="edit_sala.php?id=<?= $s['id'] ?>">✏️</a>
                    <form action="admin_manage_sala.php" method="post" style="display:inline;">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="sala_id" value="<?= $s['id'] ?>">
                        <button onclick="return confirm('ลบศาลานี้?')" style="color:red;">🗑️</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>➕ เพิ่มศาลาใหม่</h3>
    <form id="add-sala-form" action="admin_manage_sala.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="action" value="add">

    <div class="form-row">
        <label for="name">ชื่อ:</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div class="form-row">
        <label for="features">สิ่งอำนวยความสะดวก:</label>
        <textarea id="features" name="features" required></textarea>
    </div>

    <div class="form-row">
    <label for="price">ราคา:</label>
    <input type="text" id="price" name="price" placeholder="เช่น 5000 บาท/วัน" required>
    </div>

    <div class="form-row">
        <label for="image">รูปภาพ:</label>
        <input type="file" id="image" name="image" accept="image/*">
    </div>

    <button type="submit">บันทึก</button>
</form>

</div>

<script>
function confirmReject(form) {
    const reason = prompt("กรุณาระบุเหตุผลในการปฏิเสธ:");
    if (reason === null || reason.trim() === "") {
        alert("กรุณาระบุเหตุผลก่อนทำการปฏิเสธ");
        return false;
    }
    form.rejection_reason.value = reason; // ต้องตรงกับ name="rejection_reason"
    return true;
}
</script>

</body>
</html>
