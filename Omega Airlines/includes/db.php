<?php

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'omega_airlines';

try {

    /*
     * Connect to MySQL server
     */
    $pdo = new PDO(
        "mysql:host=$host;charset=utf8mb4",
        $username,
        $password
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );


    /*
     * Create database if it does not already exist
     */
    $pdo->exec(
        "CREATE DATABASE IF NOT EXISTS `$dbname`"
    );


    /*
     * Select Omega Airlines database
     */
    $pdo->exec(
        "USE `$dbname`"
    );


    /*
     * =====================================================
     * USERS TABLE
     * =====================================================
     */

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (

            id INT AUTO_INCREMENT PRIMARY KEY,

            name VARCHAR(100) NOT NULL,

            email VARCHAR(150) NOT NULL UNIQUE,

            password VARCHAR(255) NOT NULL,

            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

        )
    ");


    /*
     * =====================================================
     * BOOKINGS TABLE
     * =====================================================
     */

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS bookings (

            id INT AUTO_INCREMENT PRIMARY KEY,

            flight_id VARCHAR(50) NOT NULL,

            departure_city VARCHAR(100) NOT NULL,

            arrival_city VARCHAR(100) NOT NULL,

            departure_date DATE NOT NULL,

            passengers INT NOT NULL,

            flight_type VARCHAR(100) NOT NULL,

            total_price DECIMAL(10,2) NOT NULL,

            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

        )
    ");


    /*
     * =====================================================
     * ADD USER ID TO EXISTING BOOKINGS
     * =====================================================
     *
     * Existing bookings remain safe.
     * New bookings will later be connected
     * to the logged-in client.
     */

    $columns = $pdo->query("
        SHOW COLUMNS FROM bookings LIKE 'user_id'
    ")->fetch();

    if (!$columns) {

        $pdo->exec("
            ALTER TABLE bookings
            ADD COLUMN user_id INT NULL AFTER id
        ");

    }


    /*
     * =====================================================
     * SUPPORT REQUESTS TABLE
     * =====================================================
     */

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS support_requests (

            id INT AUTO_INCREMENT PRIMARY KEY,

            name VARCHAR(100) NOT NULL,

            email VARCHAR(150) NOT NULL,

            inquiry_type VARCHAR(50) NOT NULL,

            message TEXT NOT NULL,

            status VARCHAR(30) NOT NULL DEFAULT 'Pending',

            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

        )
    ");


} catch (PDOException $e) {

    die(
        "Database connection failed: "
        . $e->getMessage()
    );

}

?>