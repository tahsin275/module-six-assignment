<?php
session_start();

// Validate form inputs
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_FILES['profile_picture']['name'])) {
  die('Please fill out all fields');
}

if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  die('Invalid email format');
}

// Save profile picture
$target_dir = 'uploads/';
$target_file = $target_dir . basename($_FILES['profile_picture']['name']);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Generate unique filename with date and time
$date = date('Ymd_His');
$target_file = $target_dir . $date . '.' . $imageFileType;

if(move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
  echo 'Profile picture uploaded successfully<br>';
} else {
  die('Error uploading profile picture');
}

// Save user information to CSV file
$file = fopen('users.csv', 'a');
fputcsv($file, [$_POST['name'], $_POST['email'], $target_file]);
fclose($file);

// Set session and cookie
$_SESSION['name'] = $_POST['name'];
setcookie('name', $_POST['name'], time()+3600); // Cookie expires in 1 hour

// Redirect to success page
header('Location: success.php');
exit();
