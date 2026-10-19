<?php
require_once 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $from = isset($_POST['from']) ? htmlspecialchars(trim($_POST['from'])) : '';
    $to = isset($_POST['to']) ? htmlspecialchars(trim($_POST['to'])) : '';
    $departure = isset($_POST['departure']) ? htmlspecialchars(trim($_POST['departure'])) : '';
    $passengers = isset($_POST['passengers']) ? intval($_POST['passengers']) : 1;

    // Check for empty fields
    if (empty($from) || empty($to) || empty($departure)) {
        header("Location: index.php?error=emptyfields");
        exit();
    }

    // Prevent booking dates in the past
    $today = date('Y-m-d');

    if ($departure < $today) {
        header("Location: index.php?error=pastdate");
        exit();
    }

    $flight_id_1 = "OM-" . rand(100, 999);
    $price_1 = rand(350, 1200);

    $flight_id_2 = "OM-" . rand(400, 800);
    $price_2 = $price_1 + 220;

} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Flight Search Results | Omega Airlines</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body style="padding: 2rem;">

    <div style="max-width: 800px; margin: 0 auto;">

        <a
            href="index.php"
            style="display: inline-block; margin-bottom: 1.5rem; color: var(--primary); text-decoration: none; font-weight: 600;"
        >
            <i class="fa-solid fa-arrow-left"></i> Modify Search
        </a>

        <div
            style="background: var(--primary); color: #fff; padding: 2rem; border-radius: 8px; margin-bottom: 2rem;"
        >
            <h1
                style="font-size: 1.8rem; margin-bottom: 0.5rem; color: var(--accent);"
            >
                Available Flights
            </h1>

            <p>
                Route:
                <strong><?php echo $from; ?></strong>
                &rarr;
                <strong><?php echo $to; ?></strong>
                |
                Date:
                <strong><?php echo $departure; ?></strong>
                |
                Passengers:
                <strong><?php echo $passengers; ?></strong>
            </p>
        </div>

        <!-- Flight Option 1 -->

        <div
            style="background: #fff; padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; border-left: 5px solid var(--accent);"
        >

            <div>
                <h3
                    style="font-size: 1.2rem; color: var(--primary); margin-bottom: 0.3rem;"
                >
                    Omega Express (<?php echo $flight_id_1; ?>)
                </h3>

                <p style="font-size: 0.9rem; color: #64748b;">
                    08:00 AM &mdash; 11:30 AM | Direct | Non-Stop
                </p>
            </div>

            <div style="text-align: right;">

                <div
                    style="font-size: 1.5rem; font-weight: 700; color: var(--primary);"
                >
                    $<?php echo $price_1; ?>
                </div>

                <form
                    action="payment.php"
                    method="POST"
                    style="margin-top: 0.5rem;"
                >

                    <input type="hidden" name="from" value="<?php echo $from; ?>">
                    <input type="hidden" name="to" value="<?php echo $to; ?>">
                    <input type="hidden" name="departure" value="<?php echo $departure; ?>">
                    <input type="hidden" name="passengers" value="<?php echo $passengers; ?>">
                    <input type="hidden" name="select_flight_id" value="<?php echo $flight_id_1; ?>">
                    <input type="hidden" name="price" value="<?php echo $price_1; ?>">
                    <input type="hidden" name="flight_type" value="Omega Express">

                    <button
                        type="submit"
                        style="background: var(--accent); color: var(--primary); border: none; padding: 0.6rem 1.2rem; border-radius: 4px; font-weight: 600; cursor: pointer;"
                    >
                        Proceed to Payment
                    </button>

                </form>

            </div>

        </div>

        <!-- Flight Option 2 -->

        <div
            style="background: #fff; padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; border-left: 5px solid var(--accent);"
        >

            <div>

                <h3
                    style="font-size: 1.2rem; color: var(--primary); margin-bottom: 0.3rem;"
                >
                    Omega Executive (<?php echo $flight_id_2; ?>)
                </h3>

                <p style="font-size: 0.9rem; color: #64748b;">
                    02:15 PM &mdash; 05:45 PM | Direct | Non-Stop
                </p>

            </div>

            <div style="text-align: right;">

                <div
                    style="font-size: 1.5rem; font-weight: 700; color: var(--primary);"
                >
                    $<?php echo $price_2; ?>
                </div>

                <form
                    action="payment.php"
                    method="POST"
                    style="margin-top: 0.5rem;"
                >

                    <input type="hidden" name="from" value="<?php echo $from; ?>">
                    <input type="hidden" name="to" value="<?php echo $to; ?>">
                    <input type="hidden" name="departure" value="<?php echo $departure; ?>">
                    <input type="hidden" name="passengers" value="<?php echo $passengers; ?>">
                    <input type="hidden" name="select_flight_id" value="<?php echo $flight_id_2; ?>">
                    <input type="hidden" name="price" value="<?php echo $price_2; ?>">
                    <input type="hidden" name="flight_type" value="Omega Executive">

                    <button
                        type="submit"
                        style="background: var(--accent); color: var(--primary); border: none; padding: 0.6rem 1.2rem; border-radius: 4px; font-weight: 600; cursor: pointer;"
                    >
                        Proceed to Payment
                    </button>

                </form>

            </div>

        </div>

    </div>

</body>
</html>