<?php
session_start();
require 'connect.php';

// ตรวจสอบสิทธิ์แอดมิน
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: form_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $features = $_POST['features'];
    $price = $_POST['price']; // ตอนนี้เป็น text สามารถมีข้อความต่อท้ายได้
    $imagePath = '';

    // อัปโหลดรูปภาพหลัก
    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $filename = uniqid() . '_' . basename($_FILES['image']['name']);
            $targetDir = 'photo/';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $targetPath = $targetDir . $filename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                $imagePath = $targetPath;
            } else {
                echo "ไม่สามารถอัปโหลดรูปภาพหลักได้<br>";
            }
        } else {
            echo "เกิดข้อผิดพลาดในการอัปโหลดรูปภาพหลัก: " . $_FILES['image']['error'] . "<br>";
        }
    }

    // เพิ่มศาลาเข้า table salas (เอา capacity ออก)
    $stmt = $conn->prepare("INSERT INTO salas (name, features, price, image_path) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $features, $price, $imagePath);

    if ($stmt->execute()) {
        $sala_id = $stmt->insert_id; // ดึง id ล่าสุด
        $stmt->close();

        // อัปโหลดรูปเพิ่มเติม
        if (!empty($_FILES['images']['name'][0])) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                    $fileName = time() . '_' . basename($_FILES['images']['name'][$key]);
                    $targetPath = $uploadDir . $fileName;

                    if (move_uploaded_file($tmp_name, $targetPath)) {
                        $stmt_img = $conn->prepare("INSERT INTO sala_images (sala_id, image_path) VALUES (?, ?)");
                        $stmt_img->bind_param("is", $sala_id, $targetPath);
                        $stmt_img->execute();
                        $stmt_img->close();
                    } else {
                        echo "ไม่สามารถอัปโหลดไฟล์ " . htmlspecialchars($_FILES['images']['name'][$key]) . "<br>";
                    }
                } else {
                    echo "เกิดข้อผิดพลาดในการอัปโหลดไฟล์ " . htmlspecialchars($_FILES['images']['name'][$key]) . ": " . $_FILES['images']['error'][$key] . "<br>";
                }
            }
        }

        // กลับไปหน้า admin
        header("Location: index_admin.php");
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เพิ่มศาลา</title>
</head>
<body>

<h2>➕ เพิ่มศาลาใหม่</h2>

<form action="insert_salas.php" method="post" enctype="multipart/form-data">
    <label>ชื่อศาลา:</label><br>
    <input type="text" name="name" required><br><br>

    <label>สิ่งอำนวยความสะดวก:</label><br>
    <textarea name="features" rows="4" cols="50" required></textarea><br><br>

    <label>ราคา:</label><br>
    <input type="text" name="price" placeholder="เช่น 5000 บาท/วัน" required><br><br>

    <label>รูปภาพหลัก:</label><br>
    <input type="file" name="image" accept="image/*"><br><br>

    <label>อัปโหลดรูปภาพเพิ่มเติม (เลือกได้หลายรูป):</label><br>
    <input type="file" name="images[]" multiple accept="image/*"><br><br>

    <button type="submit">💾 บันทึก</button>
</form>

<p><a href="index_admin.php">⬅️ กลับหน้าแดชบอร์ด</a></p>

</body>
</html>
