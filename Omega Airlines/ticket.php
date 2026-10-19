<?php

session_start();

require_once 'includes/db.php';


/*
 * =====================================================
 * CHECK CLIENT LOGIN
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
 * GET BOOKING ID
 * =====================================================
 */

$booking_id = intval($_GET['id'] ?? 0);

if ($booking_id <= 0) {
    die("Invalid ticket.");
}


/*
 * =====================================================
 * FETCH ONLY THIS CLIENT'S BOOKING
 * =====================================================
 */

$stmt = $pdo->prepare("
    SELECT *
    FROM bookings
    WHERE id = ?
    AND user_id = ?
");

$stmt->execute([
    $booking_id,
    $_SESSION['user_id']
]);

$booking = $stmt->fetch(PDO::FETCH_ASSOC);


/*
 * Booking doesn't belong to this client
 */

if (!$booking) {
    die("Ticket not found.");
}


/*
 * =====================================================
 * CREATE BOOKING REFERENCE
 * =====================================================
 */

$booking_reference = 'OMEGA-' .
    str_pad(
        $booking['id'],
        6,
        '0',
        STR_PAD_LEFT
    );


/*
 * =====================================================
 * CLIENT DETAILS
 * =====================================================
 */

$passenger_name = $_SESSION['user_name'];
$passenger_email = $_SESSION['user_email'];

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
        Ticket <?php echo htmlspecialchars($booking_reference); ?>
        | Omega Airlines
    </title>

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    >

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 40px 20px;
            background: #eef2f7;
            font-family: 'Montserrat', sans-serif;
            color: #0b1f38;
        }

        .ticket-wrapper {
            max-width: 900px;
            margin: 0 auto;
        }

        .ticket {
            background: #ffffff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0,0,0,0.12);
        }

        .ticket-header {
            background: #0b1f38;
            color: #ffffff;
            padding: 28px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .logo {
            font-size: 25px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .logo i {
            margin-right: 10px;
        }

        .logo span {
            color: #d8ad32;
        }

        .confirmed {
            background: #149c91;
            color: #ffffff;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .ticket-main {
            padding: 35px;
        }

        .reference-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 25px;
            margin-bottom: 30px;
            gap: 20px;
        }

        .label {
            font-size: 11px;
            color: #7a8798;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 7px;
        }

        .reference {
            font-size: 25px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .flight-number {
            text-align: right;
            font-size: 20px;
            font-weight: 700;
        }

        .route {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 25px;
            margin-bottom: 35px;
        }

        .airport:last-child {
            text-align: right;
        }

        .city {
            font-size: 30px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .airport-code {
            color: #7a8798;
            font-size: 12px;
            margin-top: 5px;
        }

        .plane {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: #f3e5b3;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0b1f38;
            font-size: 20px;
        }

        .details {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 25px 0;
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
        }

        .detail-value {
            font-size: 15px;
            font-weight: 600;
            word-break: break-word;
        }

        .passenger-section {
            margin-top: 30px;
        }

        .passenger-name {
            font-size: 18px;
            font-weight: 700;
        }

        .passenger-email {
            color: #7a8798;
            font-size: 13px;
            margin-top: 5px;
        }

        .price-row {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f7f9fc;
            padding: 20px;
            border-radius: 8px;
        }

        .price {
            font-size: 24px;
            font-weight: 700;
            color: #b78c20;
        }

        .ticket-footer {
            background: #f7f9fc;
            padding: 20px 35px;
            color: #7a8798;
            font-size: 11px;
            text-align: center;
            border-top: 1px dashed #cbd5e1;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 25px;
        }

        .action-button {
            border: none;
            text-decoration: none;
            padding: 12px 22px;
            border-radius: 5px;
            font-family: inherit;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
        }

        .print-button {
            background: #0b1f38;
            color: #ffffff;
        }

        .back-button {
            background: #d8ad32;
            color: #0b1f38;
        }

        @media (max-width: 700px) {

            .ticket-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .reference-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .flight-number {
                text-align: left;
            }

            .route {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .airport:last-child {
                text-align: center;
            }

            .plane {
                margin: 0 auto;
                transform: rotate(90deg);
            }

            .details {
                grid-template-columns: repeat(2, 1fr);
            }

            .price-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

        }

        @media print {

            body {
                background: #ffffff;
                padding: 0;
            }

            .ticket {
                box-shadow: none;
                border: 1px solid #ddd;
            }

            .actions {
                display: none;
            }

            .ticket-wrapper {
                max-width: 100%;
            }

        }

    </style>

</head>


<body>


<div class="ticket-wrapper">


    <div class="ticket">


        <!-- HEADER -->

        <div class="ticket-header">

            <div class="logo">

                <i class="fa-solid fa-plane-departure"></i>

                OMEGA
                <span>AIRLINES</span>

            </div>


            <div class="confirmed">

                <i class="fa-solid fa-circle-check"></i>

                CONFIRMED

            </div>

        </div>


        <!-- MAIN -->

        <div class="ticket-main">


            <!-- REFERENCE -->

            <div class="reference-row">

                <div>

                    <div class="label">
                        BOOKING REFERENCE
                    </div>

                    <div class="reference">

                        <?php
                        echo htmlspecialchars(
                            $booking_reference
                        );
                        ?>

                    </div>

                </div>


                <div>

                    <div class="label">
                        FLIGHT
                    </div>

                    <div class="flight-number">

                        <?php
                        echo htmlspecialchars(
                            $booking['flight_id']
                        );
                        ?>

                    </div>

                </div>

            </div>


            <!-- ROUTE -->

            <div class="route">


                <div class="airport">

                    <div class="label">
                        FROM
                    </div>

                    <div class="city">

                        <?php
                        echo htmlspecialchars(
                            $booking['departure_city']
                        );
                        ?>

                    </div>

                    <div class="airport-code">
                        DEPARTURE
                    </div>

                </div>


                <div class="plane">

                    <i class="fa-solid fa-plane"></i>

                </div>


                <div class="airport">

                    <div class="label">
                        TO
                    </div>

                    <div class="city">

                        <?php
                        echo htmlspecialchars(
                            $booking['arrival_city']
                        );
                        ?>

                    </div>

                    <div class="airport-code">
                        ARRIVAL
                    </div>

                </div>


            </div>


            <!-- DETAILS -->

            <div class="details">


                <div>

                    <div class="label">
                        DEPARTURE DATE
                    </div>

                    <div class="detail-value">

                        <?php
                        echo htmlspecialchars(
                            $booking['departure_date']
                        );
                        ?>

                    </div>

                </div>


                <div>

                    <div class="label">
                        PASSENGERS
                    </div>

                    <div class="detail-value">

                        <?php
                        echo htmlspecialchars(
                            $booking['passengers']
                        );
                        ?>

                    </div>

                </div>


                <div>

                    <div class="label">
                        CABIN
                    </div>

                    <div class="detail-value">

                        <?php
                        echo htmlspecialchars(
                            $booking['flight_type']
                        );
                        ?>

                    </div>

                </div>


                <div>

                    <div class="label">
                        BOOKED ON
                    </div>

                    <div class="detail-value">

                        <?php
                        echo htmlspecialchars(
                            $booking['created_at']
                        );
                        ?>

                    </div>

                </div>


            </div>


            <!-- PASSENGER -->

            <div class="passenger-section">

                <div class="label">
                    PASSENGER
                </div>

                <div class="passenger-name">

                    <?php
                    echo htmlspecialchars(
                        $passenger_name
                    );
                    ?>

                </div>

                <div class="passenger-email">

                    <?php
                    echo htmlspecialchars(
                        $passenger_email
                    );
                    ?>

                </div>

            </div>


            <!-- PRICE -->

            <div class="price-row">

                <div>

                    <div class="label">
                        TOTAL FARE
                    </div>

                    <strong>
                        Flight Ticket
                    </strong>

                </div>


                <div class="price">

                    $

                    <?php
                    echo number_format(
                        $booking['total_price'],
                        2
                    );
                    ?>

                </div>

            </div>


        </div>


        <!-- FOOTER -->

        <div class="ticket-footer">

            Please present this ticket and a valid
            identification document when required.

            <br>

            Omega Airlines · Fly Beyond Limits

        </div>


    </div>


    <!-- ACTIONS -->

    <div class="actions">

        <button
            class="action-button print-button"
            onclick="window.print()"
        >

            <i class="fa-solid fa-print"></i>

            Print / Save as PDF

        </button>


        <a
            href="portal.php"
            class="action-button back-button"
        >

            <i class="fa-solid fa-arrow-left"></i>

            Back to Portal

        </a>

    </div>


</div>


</body>

</html>