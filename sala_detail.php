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

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT * FROM salas WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "ไม่พบข้อมูลศาลา";
    exit();
}

$row = $result->fetch_assoc();
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($row['name']); ?></title>
</head>
<body>

<header>
    <h1>จองศาลา</h1>
    <nav>
        <ul>
            <li><a href="index.php">หน้าหลัก</a></li>
            <li><a href="sala_list.php">จองศาลา</a></li>
            <li><a href="booking_table.php">ตารางการจอง</a></li>
            <li><a href="logout.php">ออกจากระบบ</a></li>
        </ul>
    </nav>
</header>

<div class="box-image">
    <h1><?php echo htmlspecialchars($row['name']); ?></h1>
    <div class="pavilion-image-container">
        <?php
        // แสดงรูปหลัก (รูปในตาราง salas)
        if (!empty($row['image_path'])) {
            echo '<div class="gallery-item"><img src="' . htmlspecialchars($row['image_path']) . '" alt="รูปศาลา"></div>';
        }

        // ดึงรูปจากตาราง sala_images
        $sql_images = "SELECT image_path FROM sala_images WHERE sala_id = $id";
        $result_images = $conn->query($sql_images);

        if ($result_images && $result_images->num_rows > 0) {
            while ($img = $result_images->fetch_assoc()) {
                echo '<div class="gallery-item"><img src="' . htmlspecialchars($img['image_path']) . '" alt="รูปศาลาเพิ่มเติม"></div>';
            }
        }
        ?>
    </div>
</div>

<div class="text">
    <div class="my-box">
        <h2>รายละเอียดศาลา</h2> 
        <?php
        $details = explode("\n", $row['features']);
        foreach ($details as $d) {
            echo "<p>" . htmlspecialchars($d) . "</p>";
        }
        ?>
    </div>

    <div class="my-box2">
        <h2>ราคาศาลา</h2>

        <form action="form_booking.php" method="post">
            <?php
            $prices = explode(",", $row['price']);
            foreach ($prices as $price) {
                $price = trim($price);
                echo "<label><input type='radio' name='price' value='" . htmlspecialchars($price) . "' required> $price</label><br>";
            }
            ?>

            <br>
            <label for="booking_date">เลือกวันที่จอง:</label><br>
            <input type="date" name="booking_date" required><br><br>

            <input type="hidden" name="sala_name" value="<?php echo htmlspecialchars($row['name']); ?>">
            <input type="hidden" name="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>">

            <button type="submit" class="confirm-button">ยืนยันการจอง</button>
        </form>
    </div>
</div>

</body>
</html>
