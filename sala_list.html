<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: form_login.php");
    exit();
}

// เชื่อมต่อฐานข้อมูล
$conn = new mysqli("localhost", "root", "", "phu");
if ($conn->connect_error) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

$sql = "SELECT * FROM salas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายการศาลา</title>
    <link rel="stylesheet" href="sala_list_style.css">
</head>
<body>
    <header>
        <h1>เลือกศาลา</h1>
        <nav>
            <ul>
                <li><a href="index.php">หน้าหลัก</a></li>
                <li><a href="booking_table.php">ตารางการจอง</a></li>
                <li><a href="logout.php">ออกจากระบบ</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>รายการศาลาที่ให้บริการ</h2>
        <div class="image-gallery">
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="gallery-item">
                    <a href="sala_detail.php?id=<?php echo $row['id']; ?>">
                        <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="รูปศาลา" class="gallery-img" />
                    </a>
                    <p><?php echo htmlspecialchars($row['name']); ?></p>
                    <p class="detail-text">รายละเอียดเพิ่มเติม</p>
                </div>
            <?php endwhile; ?>
        </div>
    </main>
</body>
</html>
