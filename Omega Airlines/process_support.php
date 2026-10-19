<?php

require_once 'includes/db.php';


/*
 * Only allow POST requests
 */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: support.php");
    exit();
}


/*
 * Get and clean submitted values
 */
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$inquiry_type = trim($_POST['inquiry_type'] ?? '');
$message = trim($_POST['message'] ?? '');


/*
 * Validate required fields
 */
if (
    empty($name) ||
    empty($email) ||
    empty($inquiry_type) ||
    empty($message)
) {
    header("Location: support.php?error=emptyfields");
    exit();
}


/*
 * Validate email
 */
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: support.php?error=invalidemail");
    exit();
}


/*
 * Insert support request securely
 */
try {

    $stmt = $pdo->prepare("
        INSERT INTO support_requests
        (
            name,
            email,
            inquiry_type,
            message
        )
        VALUES
        (
            :name,
            :email,
            :inquiry_type,
            :message
        )
    ");

    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':inquiry_type' => $inquiry_type,
        ':message' => $message
    ]);


    /*
     * Return to Support page after successful submission
     */
    header("Location: support.php?success=1");
    exit();


} catch (PDOException $e) {

    /*
     * Database error
     */
    header("Location: support.php?error=database");
    exit();

}
?>