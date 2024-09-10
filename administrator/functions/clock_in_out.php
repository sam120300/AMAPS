<?php

// Database configuration
$host = 'localhost';
$db = 'astra_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emp_no = $_POST['emp_no'];
    $action = $_POST['action'];
    $current_date = date('Y-m-d');
    $current_time = date('H:i');

    if ($action === 'clock_in') {
        // Insert new record for clock in
        $sql = "INSERT INTO attendance (emp_no, time_in, date) VALUES (:emp_no, :time_in, :date)";
        $params = ['emp_no' => $emp_no, 'time_in' => $current_time, 'date' => $current_date];
    } elseif ($action === 'clock_out') {
        // Update existing record for clock out for the same date
        $sql = "UPDATE attendance SET time_out = :time_out WHERE emp_no = :emp_no AND date = :date AND time_out IS NULL ORDER BY id DESC LIMIT 1";
        $params = ['time_out' => $current_time, 'emp_no' => $emp_no, 'date' => $current_date];
    }

    try {
        // Log SQL and parameters for debugging
        error_log("SQL: " . $sql);
        error_log("Params: " . json_encode($params));

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        // Check if any rows were affected
        $affectedRows = $stmt->rowCount();
        if ($affectedRows > 0) {
            echo "Success";
        } else {
            echo "Error: No rows affected. Check if there is a matching clock-in record.";
        }
    } catch (PDOException $e) {
        echo "PDOException: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
?>
