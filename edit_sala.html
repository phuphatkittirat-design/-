<?php 
require 'connect.php';

$id = $_GET['id'] ?? 0; 
$id = intval($id);

// ดึงข้อมูลศาลา
$stmt = $conn->prepare("SELECT * FROM salas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$sala = $result->fetch_assoc();

if (!$sala) {
    echo "ไม่พบข้อมูลศาลานี้";
    exit();
}

// ดึงรูปภาพเพิ่มเติม
$stmtImgs = $conn->prepare("SELECT * FROM sala_images WHERE sala_id = ?");
$stmtImgs->bind_param("i", $id);
$stmtImgs->execute();
$resultImgs = $stmtImgs->get_result();
$images = $resultImgs->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $features = $_POST['features'] ?? '';
    $price = $_POST['price'] ?? ''; // ตอนนี้เป็น text สามารถมีข้อความต่อท้ายได้

    // อัปเดตรูปภาพหลักถ้ามีการอัปโหลดใหม่
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        $tmpName = $_FILES['image']['tmp_name'];
        $filename = basename($_FILES['image']['name']);
        $targetFile = $uploadDir . time() . '_' . $filename;

        if (move_uploaded_file($tmpName, $targetFile)) {
            if (file_exists($sala['image_path']) && $sala['image_path'] != $targetFile) {
                unlink($sala['image_path']);
            }
            $imagePath = $targetFile;
        } else {
            echo "เกิดข้อผิดพลาดในการอัปโหลดรูปภาพหลัก";
            exit();
        }
    } else {
        $imagePath = $sala['image_path'];
    }

    // อัปเดตข้อมูลศาลา (ไม่มี capacity แล้ว)
    $stmtUpdate = $conn->prepare("UPDATE salas SET name = ?, features = ?, price = ?, image_path = ? WHERE id = ?");
    $stmtUpdate->bind_param("ssssi", $name, $features, $price, $imagePath, $id);

    if (!$stmtUpdate->execute()) {
        echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $conn->error;
        exit();
    }

    // ลบรูปภาพเพิ่มเติมที่เลือก
    if (!empty($_POST['delete_images'])) {
        $deleteIds = $_POST['delete_images'];
        foreach ($deleteIds as $imgId) {
            $stmtGetImg = $conn->prepare("SELECT image_path FROM sala_images WHERE id = ? AND sala_id = ?");
            $stmtGetImg->bind_param("ii", $imgId, $id);
            $stmtGetImg->execute();
            $resImg = $stmtGetImg->get_result()->fetch_assoc();
            if ($resImg) {
                if (file_exists($resImg['image_path'])) {
                    unlink($resImg['image_path']);
                }
                $stmtDel = $conn->prepare("DELETE FROM sala_images WHERE id = ? AND sala_id = ?");
                $stmtDel->bind_param("ii", $imgId, $id);
                $stmtDel->execute();
                $stmtDel->close();
            }
            $stmtGetImg->close();
        }
    }

    // อัปโหลดรูปภาพเพิ่มเติมใหม่ถ้ามี
    if (!empty($_FILES['images']['name'][0])) {
        $uploadDir = 'photo/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                $fileName = time() . '_' . basename($_FILES['images']['name'][$key]);
                $targetPath = $uploadDir . $fileName;

                if (move_uploaded_file($tmp_name, $targetPath)) {
                    $stmt_img = $conn->prepare("INSERT INTO sala_images (sala_id, image_path) VALUES (?, ?)");
                    $stmt_img->bind_param("is", $id, $targetPath);
                    $stmt_img->execute();
                    $stmt_img->close();
                } else {
                    echo "ไม่สามารถอัปโหลดไฟล์ " . htmlspecialchars($_FILES['images']['name'][$key]) . "<br>";
                }
            }
        }
    }

    header("Location: index_admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>แก้ไขศาลา</title>
    <link rel="stylesheet" href="edit_sala_style.css">
</head>
<body>
<h2>📝 แก้ไขศาลา</h2>
<form method="post" enctype="multipart/form-data">
    ชื่อ: <input type="text" name="name" value="<?= htmlspecialchars($sala['name']) ?>" required><br>
    สิ่งอำนวยความสะดวก:<br>
    <textarea name="features" required><?= htmlspecialchars($sala['features']) ?></textarea><br>
    ราคา: <input type="text" name="price" value="<?= htmlspecialchars($sala['price']) ?>" placeholder="เช่น 5000 บาท/วัน" required><br>

    <p>รูปเดิม:</p>
    <img src="<?= htmlspecialchars($sala['image_path']) ?>" width="100"><br>
    เปลี่ยนรูปหลัก: <input type="file" name="image" accept="image/*"><br><br>

    <p>รูปเพิ่มเติม:</p>
    <?php if (!empty($images)): ?>
        <?php foreach ($images as $img): ?>
            <div style="display:inline-block; margin: 5px; text-align:center;">
                <img src="<?= htmlspecialchars($img['image_path']) ?>" width="100"><br>
                <label>
                    <input type="checkbox" name="delete_images[]" value="<?= $img['id'] ?>">
                    ลบรูปนี้
                </label>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>ไม่มีรูปเพิ่มเติม</p>
    <?php endif; ?>

    <br><br>
    <label>เพิ่มรูปภาพเพิ่มเติม (เลือกได้หลายรูป):</label><br>
    <input type="file" name="images[]" multiple accept="image/*"><br><br>

    <button type="submit">บันทึก</button>
    <a href="index_admin.php">ยกเลิก</a>
</form>
</body>
</html>
