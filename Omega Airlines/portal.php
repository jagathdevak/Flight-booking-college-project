<?php

if (!session_id()) {
    session_start();
}

require_once 'includes/db.php';

$error = '';
$success = '';

/*
 * =====================================================
 * DETERMINE LOGIN / REGISTER VIEW
 * =====================================================
 */

$view = (
    isset($_GET['view']) &&
    $_GET['view'] === 'register'
)
    ? 'register'
    : 'login';


/*
 * =====================================================
 * LOGOUT
 * =====================================================
 */

if (
    isset($_GET['action']) &&
    $_GET['action'] === 'logout'
) {

    session_unset();
    session_destroy();

    header("Location: portal.php");
    exit();
}


/*
 * =====================================================
 * REGISTRATION
 * =====================================================
 */

if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['action']) &&
    $_POST['action'] === 'register'
) {

    $view = 'register';

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (
        empty($name) ||
        empty($email) ||
        empty($password) ||
        empty($confirm_password)
    ) {

        $error = 'Please fill in all fields.';

    } elseif (
        !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {

        $error = 'Please enter a valid email address.';

    } elseif (
        strlen($password) < 6
    ) {

        $error = 'Password must be at least 6 characters.';

    } elseif (
        $password !== $confirm_password
    ) {

        $error = 'Passwords do not match.';

    } else {

        try {

            /*
             * Check whether email already exists
             */

            $stmt = $pdo->prepare("
                SELECT id
                FROM users
                WHERE email = ?
            ");

            $stmt->execute([
                $email
            ]);

            if ($stmt->fetch()) {

                $error = 'An account with this email already exists.';

            } else {

                /*
                 * Secure password hashing
                 */

                $hashed_password = password_hash(
                    $password,
                    PASSWORD_DEFAULT
                );

                /*
                 * Create account
                 */

                $stmt = $pdo->prepare("
                    INSERT INTO users
                    (
                        name,
                        email,
                        password
                    )
                    VALUES
                    (
                        ?,
                        ?,
                        ?
                    )
                ");

                $stmt->execute([
                    $name,
                    $email,
                    $hashed_password
                ]);

                /*
                 * Switch back to login
                 */

                $view = 'login';

                $success = 'Account created successfully. You can now sign in.';
            }

        } catch (PDOException $e) {

            $error = 'Database error. Please try again.';

        }
    }
}


/*
 * =====================================================
 * LOGIN
 * =====================================================
 */

if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['action']) &&
    $_POST['action'] === 'login'
) {

    $view = 'login';

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (
        empty($email) ||
        empty($password)
    ) {

        $error = 'Please fill in all fields.';

    } else {

        try {

            $stmt = $pdo->prepare("
                SELECT *
                FROM users
                WHERE email = ?
            ");

            $stmt->execute([
                $email
            ]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (
                $user &&
                password_verify(
                    $password,
                    $user['password']
                )
            ) {

                /*
                 * Store client information in session
                 */

                $_SESSION['user_logged_in'] = true;

                $_SESSION['user_id'] = $user['id'];

                $_SESSION['user_name'] = $user['name'];

                $_SESSION['user_email'] = $user['email'];

                header("Location: portal.php");

                exit();

            } else {

                $error = 'Invalid email or password.';

            }

        } catch (PDOException $e) {

            $error = 'Database error. Please try again.';

        }
    }
}


/*
 * =====================================================
 * FETCH CLIENT BOOKINGS
 * =====================================================
 */

$user_bookings = [];

if (
    isset($_SESSION['user_logged_in']) &&
    $_SESSION['user_logged_in'] === true &&
    isset($_SESSION['user_id'])
) {

    $stmt = $pdo->prepare("
        SELECT *
        FROM bookings
        WHERE user_id = ?
        ORDER BY created_at DESC
    ");

    $stmt->execute([
        $_SESSION['user_id']
    ]);

    $user_bookings = $stmt->fetchAll(
        PDO::FETCH_ASSOC
    );
}

?>


<?php include 'includes/header.php'; ?>


<main style="
    max-width: 1200px;
    margin: 60px auto;
    padding: 0 20px;
    min-height: 60vh;
">


<?php if (
    isset($_SESSION['user_logged_in']) &&
    $_SESSION['user_logged_in'] === true
): ?>


    <!-- =================================================
         LOGGED-IN CLIENT DASHBOARD
         ================================================= -->

    <div style="
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #333;
        gap: 20px;
        flex-wrap: wrap;
    ">

        <div>

            <h2 style="
                color: #fff;
                margin: 0 0 8px;
                font-family: 'Montserrat', sans-serif;
            ">
                Welcome back,
                <?php
                echo htmlspecialchars(
                    $_SESSION['user_name']
                );
                ?>!
            </h2>

            <p style="
                color: #888;
                margin: 0;
            ">
                <?php
                echo htmlspecialchars(
                    $_SESSION['user_email']
                );
                ?>
            </p>

        </div>


        <a
            href="portal.php?action=logout"
            style="
                background: #dc3545;
                text-decoration: none;
                padding: 10px 20px;
                border-radius: 4px;
                color: #fff;
                font-weight: 600;
            "
        >
            Logout
        </a>

    </div>


    <!-- =================================================
         CLIENT DASHBOARD
         ================================================= -->

    <div style="
        background: #16191e;
        padding: 30px;
        border-radius: 8px;
        color: #ccc;
        font-family: 'Montserrat', sans-serif;
        border: 1px solid #2a2e35;
        margin-bottom: 30px;
    ">

        <h3 style="
            color: #c99c47;
            margin-top: 0;
        ">
            Client Dashboard
        </h3>

        <p style="margin-bottom: 0;">
            Manage your Omega Airlines bookings
            and view your tickets below.
        </p>

    </div>


    <!-- =================================================
         MY TICKETS
         ================================================= -->

    <h2 style="
        color: #fff;
        font-family: 'Montserrat', sans-serif;
        margin-bottom: 20px;
    ">
        My Tickets
    </h2>


    <?php if (count($user_bookings) > 0): ?>


        <div style="
            display: grid;
            gap: 20px;
        ">

            <?php foreach (
                $user_bookings as $booking
            ): ?>


                <div style="
                    background: #16191e;
                    border: 1px solid #2a2e35;
                    border-radius: 8px;
                    padding: 25px;
                    color: #ccc;
                ">


                    <div style="
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        gap: 15px;
                        flex-wrap: wrap;
                        margin-bottom: 20px;
                    ">


                        <div>

                            <div style="
                                color: #c99c47;
                                font-size: 0.8rem;
                                font-weight: 700;
                                letter-spacing: 1px;
                            ">
                                FLIGHT
                            </div>

                            <div style="
                                color: #fff;
                                font-size: 1.4rem;
                                font-weight: 700;
                                margin-top: 5px;
                            ">
                                <?php
                                echo htmlspecialchars(
                                    $booking['flight_id']
                                );
                                ?>
                            </div>

                        </div>


                        <div style="
                            background: #0f766e;
                            color: #fff;
                            padding: 7px 14px;
                            border-radius: 20px;
                            font-size: 0.8rem;
                            font-weight: 600;
                        ">
                            CONFIRMED
                        </div>

                    </div>


                    <div style="
                        display: grid;
                        grid-template-columns:
                            repeat(4, 1fr);
                        gap: 20px;
                    ">


                        <div>

                            <div style="
                                color: #777;
                                font-size: 0.75rem;
                                margin-bottom: 5px;
                            ">
                                FROM
                            </div>

                            <strong style="color: #fff;">
                                <?php
                                echo htmlspecialchars(
                                    $booking['departure_city']
                                );
                                ?>
                            </strong>

                        </div>


                        <div>

                            <div style="
                                color: #777;
                                font-size: 0.75rem;
                                margin-bottom: 5px;
                            ">
                                TO
                            </div>

                            <strong style="color: #fff;">
                                <?php
                                echo htmlspecialchars(
                                    $booking['arrival_city']
                                );
                                ?>
                            </strong>

                        </div>


                        <div>

                            <div style="
                                color: #777;
                                font-size: 0.75rem;
                                margin-bottom: 5px;
                            ">
                                DEPARTURE
                            </div>

                            <strong style="color: #fff;">
                                <?php
                                echo htmlspecialchars(
                                    $booking['departure_date']
                                );
                                ?>
                            </strong>

                        </div>


                        <div>

                            <div style="
                                color: #777;
                                font-size: 0.75rem;
                                margin-bottom: 5px;
                            ">
                                PASSENGERS
                            </div>

                            <strong style="color: #fff;">
                                <?php
                                echo htmlspecialchars(
                                    $booking['passengers']
                                );
                                ?>
                            </strong>

                        </div>


                    </div>


                    <div style="
                        border-top: 1px solid #2a2e35;
                        margin-top: 20px;
                        padding-top: 15px;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        gap: 15px;
                        flex-wrap: wrap;
                    ">

                        <span style="color: #888;">
                            <?php
                            echo htmlspecialchars(
                                $booking['flight_type']
                            );
                            ?>
                        </span>

                        <strong style="color: #c99c47;">
                            $
                            <?php
                            echo htmlspecialchars(
                                $booking['total_price']
                            );
                            ?>
                        </strong>

                    </div>


                    <!-- =================================================
                         VIEW / PRINT TICKET
                         ================================================= -->

                    <a
                        href="ticket.php?id=<?php echo $booking['id']; ?>"
                        target="_blank"
                        style="
                            display: inline-block;
                            margin-top: 20px;
                            background: #c99c47;
                            color: #000;
                            padding: 11px 20px;
                            border-radius: 4px;
                            text-decoration: none;
                            font-weight: 700;
                        "
                    >
                        <i class="fa-solid fa-ticket"></i>
                        View / Print Ticket
                    </a>


                </div>


            <?php endforeach; ?>

        </div>


    <?php else: ?>


        <div style="
            background: #16191e;
            border: 1px solid #2a2e35;
            border-radius: 8px;
            padding: 40px;
            text-align: center;
            color: #888;
        ">

            <i
                class="fa-solid fa-ticket"
                style="
                    font-size: 2rem;
                    color: #c99c47;
                    margin-bottom: 15px;
                "
            ></i>

            <h3 style="
                color: #fff;
                margin: 10px 0;
            ">
                No Tickets Yet
            </h3>

            <p style="margin-bottom: 20px;">
                You don't have any bookings associated
                with your account yet.
            </p>

            <a
                href="index.php"
                style="
                    display: inline-block;
                    background: #c99c47;
                    color: #000;
                    padding: 11px 20px;
                    border-radius: 4px;
                    text-decoration: none;
                    font-weight: 700;
                "
            >
                Search Flights
            </a>

        </div>


    <?php endif; ?>


<?php else: ?>


    <!-- =================================================
         LOGIN / REGISTER
         ================================================= -->

    <div style="
        max-width: 500px;
        margin: 0 auto;
    ">


        <!-- =================================================
             LOGIN
             ================================================= -->

        <div
            style="
                background: #16191e;
                padding: 35px;
                border-radius: 8px;
                border: 1px solid #2a2e35;
                box-shadow:
                    0 10px 25px rgba(0,0,0,0.5);
                display:
                    <?php
                    echo (
                        $view === 'login'
                    )
                        ? 'block'
                        : 'none';
                    ?>;
            "
        >

            <h2 style="
                color: #fff;
                text-align: center;
                margin-bottom: 25px;
                font-family: 'Montserrat', sans-serif;
                font-weight: 600;
            ">
                Client Portal
            </h2>


            <?php if (!empty($error)): ?>

                <div style="
                    background:
                        rgba(220, 53, 69, 0.2);
                    color: #ff6b6b;
                    border: 1px solid #dc3545;
                    padding: 10px 15px;
                    border-radius: 4px;
                    margin-bottom: 20px;
                    font-size: 14px;
                    text-align: center;
                ">
                    <?php
                    echo htmlspecialchars($error);
                    ?>
                </div>

            <?php endif; ?>


            <?php if (!empty($success)): ?>

                <div style="
                    background:
                        rgba(25, 135, 84, 0.2);
                    color: #5ee7a0;
                    border: 1px solid #198754;
                    padding: 10px 15px;
                    border-radius: 4px;
                    margin-bottom: 20px;
                    font-size: 14px;
                    text-align: center;
                ">
                    <?php
                    echo htmlspecialchars($success);
                    ?>
                </div>

            <?php endif; ?>


            <form
                action="portal.php"
                method="POST"
            >

                <input
                    type="hidden"
                    name="action"
                    value="login"
                >


                <div style="margin-bottom: 20px;">

                    <label style="
                        display: block;
                        color: #aaa;
                        margin-bottom: 8px;
                        font-size: 14px;
                    ">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        required
                        style="
                            width: 100%;
                            padding: 12px;
                            background: #0c0d0f;
                            border: 1px solid #333;
                            border-radius: 4px;
                            color: #fff;
                            box-sizing: border-box;
                        "
                    >

                </div>


                <div style="margin-bottom: 25px;">

                    <label style="
                        display: block;
                        color: #aaa;
                        margin-bottom: 8px;
                        font-size: 14px;
                    ">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        required
                        style="
                            width: 100%;
                            padding: 12px;
                            background: #0c0d0f;
                            border: 1px solid #333;
                            border-radius: 4px;
                            color: #fff;
                            box-sizing: border-box;
                        "
                    >

                </div>


                <button
                    type="submit"
                    style="
                        width: 100%;
                        padding: 12px;
                        background: #c99c47;
                        color: #000;
                        border: none;
                        font-weight: 600;
                        cursor: pointer;
                        border-radius: 4px;
                    "
                >
                    Sign In
                </button>

            </form>


            <div style="
                text-align: center;
                margin-top: 20px;
                color: #888;
                font-size: 0.9rem;
            ">

                Don't have an account?

                <a
                    href="portal.php?view=register"
                    style="
                        color: #c99c47;
                        text-decoration: none;
                        font-weight: 600;
                    "
                >
                    Create one
                </a>

            </div>

        </div>


        <!-- =================================================
             REGISTER
             ================================================= -->

        <div
            style="
                background: #16191e;
                padding: 35px;
                border-radius: 8px;
                border: 1px solid #2a2e35;
                box-shadow:
                    0 10px 25px rgba(0,0,0,0.5);
                display:
                    <?php
                    echo (
                        $view === 'register'
                    )
                        ? 'block'
                        : 'none';
                    ?>;
            "
        >

            <h2 style="
                color: #fff;
                text-align: center;
                margin-bottom: 25px;
                font-family: 'Montserrat', sans-serif;
                font-weight: 600;
            ">
                Create Account
            </h2>


            <?php if (
                $view === 'register' &&
                !empty($error)
            ): ?>

                <div style="
                    background:
                        rgba(220, 53, 69, 0.2);
                    color: #ff6b6b;
                    border: 1px solid #dc3545;
                    padding: 10px 15px;
                    border-radius: 4px;
                    margin-bottom: 20px;
                    font-size: 14px;
                    text-align: center;
                ">
                    <?php
                    echo htmlspecialchars($error);
                    ?>
                </div>

            <?php endif; ?>


            <form
                action="portal.php"
                method="POST"
            >

                <input
                    type="hidden"
                    name="action"
                    value="register"
                >


                <div style="margin-bottom: 15px;">

                    <label style="
                        display: block;
                        color: #aaa;
                        margin-bottom: 8px;
                        font-size: 14px;
                    ">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        required
                        style="
                            width: 100%;
                            padding: 12px;
                            background: #0c0d0f;
                            border: 1px solid #333;
                            border-radius: 4px;
                            color: #fff;
                            box-sizing: border-box;
                        "
                    >

                </div>


                <div style="margin-bottom: 15px;">

                    <label style="
                        display: block;
                        color: #aaa;
                        margin-bottom: 8px;
                        font-size: 14px;
                    ">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        required
                        style="
                            width: 100%;
                            padding: 12px;
                            background: #0c0d0f;
                            border: 1px solid #333;
                            border-radius: 4px;
                            color: #fff;
                            box-sizing: border-box;
                        "
                    >

                </div>


                <div style="margin-bottom: 15px;">

                    <label style="
                        display: block;
                        color: #aaa;
                        margin-bottom: 8px;
                        font-size: 14px;
                    ">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        minlength="6"
                        required
                        style="
                            width: 100%;
                            padding: 12px;
                            background: #0c0d0f;
                            border: 1px solid #333;
                            border-radius: 4px;
                            color: #fff;
                            box-sizing: border-box;
                        "
                    >

                </div>


                <div style="margin-bottom: 25px;">

                    <label style="
                        display: block;
                        color: #aaa;
                        margin-bottom: 8px;
                        font-size: 14px;
                    ">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="confirm_password"
                        minlength="6"
                        required
                        style="
                            width: 100%;
                            padding: 12px;
                            background: #0c0d0f;
                            border: 1px solid #333;
                            border-radius: 4px;
                            color: #fff;
                            box-sizing: border-box;
                        "
                    >

                </div>


                <button
                    type="submit"
                    style="
                        width: 100%;
                        padding: 12px;
                        background: #c99c47;
                        color: #000;
                        border: none;
                        font-weight: 600;
                        cursor: pointer;
                        border-radius: 4px;
                    "
                >
                    Create Account
                </button>

            </form>


            <div style="
                text-align: center;
                margin-top: 20px;
                color: #888;
                font-size: 0.9rem;
            ">

                Already have an account?

                <a
                    href="portal.php"
                    style="
                        color: #c99c47;
                        text-decoration: none;
                        font-weight: 600;
                    "
                >
                    Sign in
                </a>

            </div>

        </div>


    </div>


<?php endif; ?>


</main>


<?php include 'includes/footer.php'; ?>


<style>

@media (max-width: 750px) {

    main > div {
        max-width: 100% !important;
    }

    [style*="grid-template-columns: repeat(4, 1fr)"] {
        grid-template-columns: repeat(2, 1fr) !important;
    }

}

</style>