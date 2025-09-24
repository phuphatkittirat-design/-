<?php
session_start();

// เชื่อมต่อฐานข้อมูล
$pdo = new PDO("mysql:host=localhost;dbname=phu;charset=utf8", "root", ""); // เปลี่ยน root กับรหัสผ่านตามเครื่องคุณ
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// ตัวแปรสำหรับแสดงข้อความ
$message = "";
$messageType = ""; // success หรือ error

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['slip'])) {
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = time() . '_' . basename($_FILES["slip"]["name"]);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["slip"]["tmp_name"], $targetFile)) {
        // บันทึกลงฐานข้อมูล
        $stmt = $pdo->prepare("INSERT INTO bookings (username, sala_name, booking_date, price, slip_file, approval_status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['username'],
            $_POST['sala_name'],
            $_POST['booking_date'],
            $_POST['price'],
            $fileName,
            'waiting'  // สถานะรออนุมัติ
        ]);
        $message = "ระบบได้รับข้อมูลแล้ว กรุณารอการยืนยันจากแอดมิน";
        $messageType = "success";
    } else {
        $message = "เกิดข้อผิดพลาดในการอัปโหลดไฟล์ กรุณาลองใหม่อีกครั้ง";
        $messageType = "error";
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <title>สถานะการอัปโหลดสลิป</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt&display=swap');

        body {
            font-family: 'Prompt', sans-serif;
            background: linear-gradient(135deg, #fffbe7, #fceabb);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #444;
        }
        .container {
            background: #fff;
            padding: 40px 50px;
            border-radius: 16px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
            text-align: center;
            max-width: 450px;
            width: 90%;
        }
        h2 {
            color: #d4af37;
            font-size: 2.2em;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.1em;
            margin-bottom: 30px;
        }
        .success {
            color: #4CAF50;
        }
        .error {
            color: #f44336;
        }
        a {
            display: inline-block;
            text-decoration: none;
            background-color: #ffc107;
            color: #222;
            font-weight: 600;
            padding: 12px 28px;
            border-radius: 8px;
            box-shadow: 0 6px 12px rgba(255,193,7,0.4);
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #d4af37;
            color: #fff;
            box-shadow: 0 8px 20px rgba(212,175,55,0.7);
        }
        @media (max-width: 480px) {
            .container {
                padding: 30px 20px;
            }
            h2 {
                font-size: 1.8em;
            }
            p {
                font-size: 1em;
            }
            a {
                padding: 10px 20px;
                font-size: 0.95em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($messageType === "success") : ?>
            <h2 class="success">สำเร็จ!</h2>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php else : ?>
            <h2 class="error">เกิดข้อผิดพลาด!</h2>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <a href="index.php">กลับหน้าการจอง</a>
    </div>
</body>
</html>
