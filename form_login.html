<?php
session_start();

require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // ดึงข้อมูล role ด้วย
    $sql = "SELECT id, username, password, phone, role FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashed_password, $phone, $role);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['phone'] = $phone;
            $_SESSION['role'] = $role; // เก็บ role ใน session ด้วย

            // แยกหน้าแอดมินกับผู้ใช้ปกติ
            if ($role === 'admin') {
                header("Location: index_admin.php");
                exit();
            } else {
                header("Location: index.php");
                exit();
            }
        } else {
            $error = "❌ รหัสผ่านไม่ถูกต้อง";
        }
    } else {
        $error = "❌ ไม่พบอีเมลในระบบ";
    }

    $stmt->close();
    $conn->close();
}
?>
<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เข้าสู่ระบบ</title>
    <link rel="stylesheet" href="login_style.css">
</head>
<body>
  <div class="wrapper">
    <h2>เข้าสู่ระบบ</h2>

    <?php if (!empty($error)) : ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <label for="email">อีเมล</label>
        <input type="email" id="email" name="email" required>

        <label for="password">รหัสผ่าน</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="เข้าสู่ระบบ">
    </form>

    <p class="register-link">
       <a href="form_register.php">สมัครสมาชิกที่นี่</a>
    </p>
  </div>
</body>
</html>
