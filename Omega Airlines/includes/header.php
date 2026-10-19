<?php
if (!session_id()) {
    session_start();
}

$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Omega Airlines | Fly Beyond Limits</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    >

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<header>

    <div class="logo">
        <i class="fa-solid fa-plane-departure"></i>
        OMEGA <span>AIRLINES</span>
    </div>

    <nav>
        <ul>

            <li>
                <a
                    href="index.php"
                    class="<?php echo ($current_page === 'index.php') ? 'active' : ''; ?>"
                >
                    Home
                </a>
            </li>

            <li>
                <a
                    href="destinations.php"
                    class="<?php echo ($current_page === 'destinations.php') ? 'active' : ''; ?>"
                >
                    Destinations
                </a>
            </li>

            <li>
                <a
                    href="experience.php"
                    class="<?php echo ($current_page === 'experience.php') ? 'active' : ''; ?>"
                >
                    Experience
                </a>
            </li>

            <li>
                <a
                    href="support.php"
                    class="<?php echo ($current_page === 'support.php') ? 'active' : ''; ?>"
                >
                    Support
                </a>
            </li>

        </ul>
    </nav>

   <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>

    <a href="portal.php" class="auth-btn">
        Client Portal
    </a>

<?php else: ?>

    <a href="portal.php" class="auth-btn">
        Client Portal
    </a>

<?php endif; ?>

</header>