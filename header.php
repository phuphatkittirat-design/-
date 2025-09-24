<?php
$page = basename($_SERVER['PHP_SELF'], '.php');

$cssMap = [
  'form_register' => 'register_style.css',
  'form_login'    => 'login_style.css',
  'index'         => 'index_style.css',
  'sala_detail'   => 'sala_style.css',
  'booking'       => 'booking_style.css',
  'index_admin'   => 'index_admin_style.css',
    // เพิ่มแมปอื่น ๆ ถ้าต้องการ
];

// ถ้ามีแมป ใช้ไฟล์ CSS ที่แมปไว้ ถ้าไม่มี ใช้ชื่อไฟล์ PHP ตามปกติ
$cssFile = isset($cssMap[$page]) ? $cssMap[$page] : $page . '.css';

// **ลบ 'css/' ออก** เพราะไฟล์ CSS อยู่ในโฟลเดอร์เดียวกับ PHP
$cssPath = $cssFile;

$cssExists = file_exists($cssPath);
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo ucfirst(str_replace('_', ' ', $page)); ?></title>

  <?php if ($cssExists): ?>
    <link rel="stylesheet" href="<?php echo $cssPath; ?>" />
  <?php else: ?>
    <!-- ไม่พบไฟล์ CSS: <?php echo $cssPath; ?> -->
  <?php endif; ?>
</head>
<body>
