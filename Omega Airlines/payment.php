<?php

session_start();

require_once 'includes/db.php';

$success = false;
$error = '';

/*
 * =====================================================
 * CHECK LOGIN
 * =====================================================
 */

if (
    !isset($_SESSION['user_logged_in']) ||
    $_SESSION['user_logged_in'] !== true ||
    !isset($_SESSION['user_id'])
) {
    header("Location: portal.php");
    exit();
}


/*
 * =====================================================
 * RECEIVE FLIGHT DATA
 * =====================================================
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $from = trim($_POST['from'] ?? '');
    $to = trim($_POST['to'] ?? '');
    $departure = trim($_POST['departure'] ?? '');
    $passengers = intval($_POST['passengers'] ?? 1);

    $selected_flight = trim(
        $_POST['select_flight_id'] ?? ''
    );

    $selected_price = floatval(
        $_POST['price'] ?? 0
    );

    $flight_type = trim(
        $_POST['flight_type'] ?? ''
    );


    /*
     * =================================================
     * FINAL PAYMENT / BOOKING
     * =================================================
     */

    if (isset($_POST['confirm_payment'])) {

        try {

            /*
             * Save booking together with
             * the logged-in client's user_id
             */

            $stmt = $pdo->prepare("
                INSERT INTO bookings
                (
                    user_id,
                    flight_id,
                    departure_city,
                    arrival_city,
                    departure_date,
                    passengers,
                    flight_type,
                    total_price
                )
                VALUES
                (
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?
                )
            ");

            $stmt->execute([
                $_SESSION['user_id'],
                $selected_flight,
                $from,
                $to,
                $departure,
                $passengers,
                $flight_type,
                $selected_price
            ]);

            $success = true;

        } catch (PDOException $e) {

            $error = "Unable to complete the booking. Please try again.";

        }

    }

} else {

    header("Location: index.php");
    exit();

}

?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Secure Checkout | Omega Airlines
    </title>

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    >

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head>


<body style="
    padding: 3rem 1rem;
    background: #f8fafc;
">


<div style="
    max-width: 600px;
    margin: 0 auto;
    background: #fff;
    padding: 2.5rem;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    border: 1px solid #e2e8f0;
">


<?php if ($success): ?>


    <!-- =================================================
         PAYMENT SUCCESS
         ================================================= -->

    <div style="
        text-align: center;
        padding: 2rem 0;
    ">

        <i
            class="fa-solid fa-circle-check"
            style="
                font-size: 4rem;
                color: #10b981;
                margin-bottom: 1rem;
            "
        ></i>


        <h2 style="
            color: var(--primary);
            margin-bottom: 0.5rem;
        ">
            Payment Successful!
        </h2>


        <p style="
            color: #64748b;
            margin-bottom: 2rem;
        ">
            Your flight ticket has been booked
            and securely recorded in the system.
        </p>


        <a
            href="portal.php"
            style="
                background: var(--primary);
                color: #fff;
                padding: 0.8rem 2rem;
                border-radius: 4px;
                text-decoration: none;
                font-weight: 600;
            "
        >
            View My Ticket
        </a>

    </div>


<?php else: ?>


    <!-- =================================================
         CHECKOUT
         ================================================= -->

    <h2 style="
        color: var(--primary);
        margin-bottom: 0.3rem;
    ">

        <i
            class="fa-solid fa-lock"
            style="color: var(--accent);"
        ></i>

        Secure Checkout

    </h2>


    <p style="
        color: #64748b;
        font-size: 0.9rem;
        margin-bottom: 2rem;
    ">

        Complete your payment details to confirm
        flight

        <strong>
            <?php
            echo htmlspecialchars($selected_flight);
            ?>
        </strong>.

    </p>


    <?php if (!empty($error)): ?>

        <div style="
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 0.9rem;
            border-radius: 4px;
            margin-bottom: 1.5rem;
        ">

            <?php
            echo htmlspecialchars($error);
            ?>

        </div>

    <?php endif; ?>


    <!-- FLIGHT SUMMARY -->

    <div style="
        background: #f1f5f9;
        padding: 1.2rem;
        border-radius: 6px;
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    ">


        <div>

            <div style="
                font-size: 0.85rem;
                color: #64748b;
                font-weight: 600;
            ">

                <?php
                echo htmlspecialchars($flight_type);
                ?>

                (

                <?php
                echo htmlspecialchars($from);
                ?>

                &rarr;

                <?php
                echo htmlspecialchars($to);
                ?>

                )

            </div>


            <div style="
                font-size: 0.9rem;
                color: var(--primary);
                font-weight: 600;
                margin-top: 0.2rem;
            ">

                Date:

                <?php
                echo htmlspecialchars($departure);
                ?>

                |

                Passengers:

                <?php
                echo htmlspecialchars($passengers);
                ?>

            </div>

        </div>


        <div style="
            font-size: 1.4rem;
            font-weight: 700;
            color: #10b981;
        ">

            $
            <?php
            echo number_format(
                $selected_price,
                2
            );
            ?>

        </div>

    </div>


    <!-- PAYMENT FORM -->

    <form
        action="payment.php"
        method="POST"
    >

        <input
            type="hidden"
            name="from"
            value="<?php echo htmlspecialchars($from); ?>"
        >

        <input
            type="hidden"
            name="to"
            value="<?php echo htmlspecialchars($to); ?>"
        >

        <input
            type="hidden"
            name="departure"
            value="<?php echo htmlspecialchars($departure); ?>"
        >

        <input
            type="hidden"
            name="passengers"
            value="<?php echo htmlspecialchars($passengers); ?>"
        >

        <input
            type="hidden"
            name="select_flight_id"
            value="<?php echo htmlspecialchars($selected_flight); ?>"
        >

        <input
            type="hidden"
            name="price"
            value="<?php echo htmlspecialchars($selected_price); ?>"
        >

        <input
            type="hidden"
            name="flight_type"
            value="<?php echo htmlspecialchars($flight_type); ?>"
        >


        <!-- CARDHOLDER -->

        <div style="
            margin-bottom: 1.2rem;
        ">

            <label style="
                display: block;
                font-size: 0.8rem;
                font-weight: 600;
                color: #64748b;
                margin-bottom: 0.4rem;
            ">
                CARDHOLDER NAME
            </label>

            <input
                type="text"
                placeholder="John Doe"
                style="
                    width: 100%;
                    padding: 0.8rem;
                    border: 1px solid #cbd5e1;
                    border-radius: 4px;
                    box-sizing: border-box;
                "
                required
            >

        </div>


        <!-- CARD NUMBER -->

        <div style="
            margin-bottom: 1.2rem;
        ">

            <label style="
                display: block;
                font-size: 0.8rem;
                font-weight: 600;
                color: #64748b;
                margin-bottom: 0.4rem;
            ">
                CARD NUMBER
            </label>

            <input
                type="text"
                placeholder="4111 2222 3333 4444"
                maxlength="19"
                style="
                    width: 100%;
                    padding: 0.8rem;
                    border: 1px solid #cbd5e1;
                    border-radius: 4px;
                    box-sizing: border-box;
                "
                required
            >

        </div>


        <!-- EXPIRY / CVV -->

        <div style="
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 2rem;
        ">


            <div>

                <label style="
                    display: block;
                    font-size: 0.8rem;
                    font-weight: 600;
                    color: #64748b;
                    margin-bottom: 0.4rem;
                ">
                    EXPIRY DATE
                </label>

                <input
                    type="text"
                    placeholder="MM/YY"
                    maxlength="5"
                    style="
                        width: 100%;
                        padding: 0.8rem;
                        border: 1px solid #cbd5e1;
                        border-radius: 4px;
                        box-sizing: border-box;
                    "
                    required
                >

            </div>


            <div>

                <label style="
                    display: block;
                    font-size: 0.8rem;
                    font-weight: 600;
                    color: #64748b;
                    margin-bottom: 0.4rem;
                ">
                    CVV
                </label>

                <input
                    type="password"
                    placeholder="123"
                    maxlength="4"
                    style="
                        width: 100%;
                        padding: 0.8rem;
                        border: 1px solid #cbd5e1;
                        border-radius: 4px;
                        box-sizing: border-box;
                    "
                    required
                >

            </div>

        </div>


        <button
            type="submit"
            name="confirm_payment"
            style="
                background-color: var(--accent);
                color: var(--primary);
                border: none;
                padding: 0.9rem;
                border-radius: 4px;
                font-weight: 700;
                cursor: pointer;
                width: 100%;
            "
        >

            Pay $

            <?php
            echo number_format(
                $selected_price,
                2
            );
            ?>

            & Confirm Booking

        </button>


    </form>


<?php endif; ?>


</div>


</body>

</html>