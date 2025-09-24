<?php
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm-password"];

    if ($password !== $confirm_password) {
        $error = "❌ รหัสผ่านไม่ตรงกัน";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, phone, password, role) VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("❌ Prepare statement ล้มเหลว: " . $conn->error);
        }

        $default_role = "user";
        $stmt->bind_param("sssss", $username, $email, $phone, $hashed_password, $default_role);

        if ($stmt->execute()) {
            header("Location: form_login.php?success=1");
            exit();
        } else {
            $error = "❌ เกิดข้อผิดพลาด: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<?php include 'header.php'; ?>

<div class="page-wrapper">
  <header>
    <h2>สมัครสมาชิก</h2>
  </header>

  <main class="form-wrapper">
    <?php if (!empty($error)): ?>
      <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
      <label for="username">ชื่อ-นามสกุล:</label>
      <input type="text" id="username" name="username" required>

      <label for="email">อีเมล:</label>
      <input type="email" id="email" name="email" required>

      <label for="phone">เบอร์โทร:</label>
      <input type="tel" id="phone" name="phone" required>

      <label for="password">รหัสผ่าน:</label>
      <input type="password" id="password" name="password" required>

      <label for="confirm-password">ยืนยันรหัสผ่าน:</label>
      <input type="password" id="confirm-password" name="confirm-password" required>

      <input type="submit" value="สมัครสมาชิก">
    </form>
  </main>

  <footer>
    <p>มีบัญชีอยู่แล้ว? <a href="form_login.php">เข้าสู่ระบบ</a></p>
  </footer>
</div>

</body>
</html>
