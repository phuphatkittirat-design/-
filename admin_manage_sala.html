<?php
session_start();
require 'connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$action = $_POST['action'] ?? '';

if ($action === 'add') {
    $name = $_POST['name'];
    $capacity = $_POST['capacity'];
    $features = $_POST['features'];
    $price = $_POST['price'];
    $imagePath = '';

    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        $filename = uniqid() . '_' . basename($_FILES['image']['name']);
        $targetDir = 'photo/';
        $targetPath = $targetDir . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $imagePath = $targetPath;
        }
    }

    $stmt = $conn->prepare("INSERT INTO salas (name, capacity, features, price, image_path) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $name, $capacity, $features, $price, $imagePath);

    if ($stmt->execute()) {
        header("Location: index_admin.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} elseif ($action === 'delete') {
    $sala_id = intval($_POST['sala_id']);
    $stmt = $conn->prepare("DELETE FROM salas WHERE id = ?");
    $stmt->bind_param("i", $sala_id);

    if ($stmt->execute()) {
        header("Location: index_admin.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Action ไม่ถูกต้อง";
}
