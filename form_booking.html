<?php
session_start();

// ตรวจสอบว่าได้รับข้อมูลจากฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>สรุปการจอง</title>
    <link rel="stylesheet" href="booking_style.css">
</head>
<body>

    <div class="summary-box">
        <h1>สรุปการจอง</h1>
        <p><strong>ชื่อผู้จอง:</strong> <?php echo htmlspecialchars($_POST['username']); ?></p>
        <p><strong>ศาลาที่จอง:</strong> <?php echo htmlspecialchars($_POST['sala_name']); ?></p>
        <p><strong>วันที่จอง:</strong> <?php echo htmlspecialchars($_POST['booking_date']); ?></p>
        <p><strong>แพ็กเกจที่เลือก:</strong> <?php echo htmlspecialchars($_POST['price']); ?></p>

        <div class="qr-section">
            <h2>ชำระเงินผ่าน QR Code</h2>
            <img src="photo/jpg.jpg" alt="QR Code สำหรับชำระเงิน">

            <form action="upload_slip.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="username" value="<?php echo htmlspecialchars($_POST['username']); ?>">
                <input type="hidden" name="sala_name" value="<?php echo htmlspecialchars($_POST['sala_name']); ?>">
                <input type="hidden" name="booking_date" value="<?php echo htmlspecialchars($_POST['booking_date']); ?>">
                <input type="hidden" name="price" value="<?php echo htmlspecialchars($_POST['price']); ?>">

                <label for="slip">แนบสลิปการโอนเงิน:</label><br>
                <input type="file" name="slip" id="slip" accept="image/*" required><br>

                <!-- รูป preview -->
                <img id="slip-preview" src="#" alt="แสดงตัวอย่างสลิปที่เลือก">

                <br>
                <button type="submit">ยืนยันการชำระเงิน</button>
            </form>
        </div>

        <a href="index.php" class="back-btn">← กลับหน้าหลัก</a>
    </div>

    <!-- JavaScript สำหรับ preview รูป -->
    <script>
        document.getElementById('slip').addEventListener('change', function(event) {
            const [file] = event.target.files;
            const preview = document.getElementById('slip-preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
                preview.src = '#';
            }
        });
    </script>

</body>
</html>
