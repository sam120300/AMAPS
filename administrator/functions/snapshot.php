<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $photoData = $_FILES['photo']['tmp_name'];
    $empNo = $_POST['emp_no'];

    $fileName = $empNo . '_' . time() . '.jpg'; 

    $uploadDir = '../../uploads/snapshots/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (move_uploaded_file($photoData, $uploadDir . $fileName)) {
        echo 'Photo uploaded successfully';
    } else {
        echo 'Failed to upload photo';
    }
} else {
    echo 'Invalid request method';
}
?>
