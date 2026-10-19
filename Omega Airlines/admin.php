<?php
session_start();
require_once 'includes/db.php';

$error = '';

/*
 * Handle admin login
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_login'])) {

    $user = trim($_POST['username'] ?? '');
    $pass = trim($_POST['password'] ?? '');

    if ($user === 'admin' && $pass === 'omega2026') {

        $_SESSION['admin_logged_in'] = true;

        header("Location: admin.php");
        exit();

    } else {

        $error = "Invalid administrator credentials.";

    }
}


/*
 * Handle logout
 */
if (isset($_GET['logout'])) {

    unset($_SESSION['admin_logged_in']);

    header("Location: admin.php");
    exit();
}

/*
 * Update support request status
 */
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['update_status']) &&
    isset($_POST['support_id']) &&
    isset($_POST['status'])
) {

    $support_id = (int) $_POST['support_id'];
    $status = trim($_POST['status']);

    $allowed_statuses = [
        'Pending',
        'In Progress',
        'Resolved'
    ];

    if (in_array($status, $allowed_statuses, true)) {

        $stmt = $pdo->prepare("
            UPDATE support_requests
            SET status = :status
            WHERE id = :id
        ");

        $stmt->execute([
            ':status' => $status,
            ':id' => $support_id
        ]);
    }

    header("Location: admin.php");
    exit();
}
/*
 * Show login page if not authenticated
 */
if (
    !isset($_SESSION['admin_logged_in']) ||
    $_SESSION['admin_logged_in'] !== true
):

    include 'includes/header.php';
?>

<main style="padding: 5rem 10%; display: flex; justify-content: center;">

    <div style="
        background: #fff;
        padding: 3rem;
        border-radius: 8px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 400px;
    ">

        <h2 style="
            color: var(--primary);
            text-align: center;
            margin-bottom: 0.5rem;
        ">
            Admin Access
        </h2>

        <p style="
            color: #64748b;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 0.9rem;
        ">
            Restricted to authorized personnel only.
        </p>

        <?php if ($error): ?>

            <div style="
                background: #ef4444;
                color: #fff;
                padding: 0.8rem;
                border-radius: 4px;
                margin-bottom: 1rem;
                font-size: 0.9rem;
                text-align: center;
            ">
                <?php echo htmlspecialchars($error); ?>
            </div>

        <?php endif; ?>

        <form action="admin.php" method="POST">

            <div style="margin-bottom: 1.2rem;">

                <label style="
                    display: block;
                    font-size: 0.8rem;
                    font-weight: 600;
                    color: #64748b;
                    margin-bottom: 0.4rem;
                ">
                    USERNAME
                </label>

                <input
                    type="text"
                    name="username"
                    style="
                        width: 100%;
                        padding: 0.8rem;
                        border: 1px solid #cbd5e1;
                        border-radius: 4px;
                    "
                    required
                >

            </div>

            <div style="margin-bottom: 1.5rem;">

                <label style="
                    display: block;
                    font-size: 0.8rem;
                    font-weight: 600;
                    color: #64748b;
                    margin-bottom: 0.4rem;
                ">
                    PASSWORD
                </label>

                <input
                    type="password"
                    name="password"
                    style="
                        width: 100%;
                        padding: 0.8rem;
                        border: 1px solid #cbd5e1;
                        border-radius: 4px;
                    "
                    required
                >

            </div>

            <button
                type="submit"
                name="admin_login"
                style="
                    background-color: var(--primary);
                    color: var(--accent);
                    border: none;
                    padding: 0.9rem;
                    border-radius: 4px;
                    font-weight: 700;
                    cursor: pointer;
                    width: 100%;
                "
            >
                Authenticate
            </button>

        </form>

    </div>

</main>

<?php

include 'includes/footer.php';
exit();

endif;


/*
 * =====================================================
 * FETCH BOOKINGS
 * =====================================================
 */

$stmt = $pdo->query("
    SELECT *
    FROM bookings
    ORDER BY created_at DESC
");

$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);


/*
 * =====================================================
 * FETCH SUPPORT REQUESTS
 * =====================================================
 */

$stmt = $pdo->query("
    SELECT *
    FROM support_requests
    ORDER BY created_at DESC
");

$support_requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
/*
 * Dashboard summary counts
 */

$total_bookings = count($bookings);

$total_support_requests = count($support_requests);

$pending_requests = 0;
$resolved_requests = 0;

foreach ($support_requests as $request) {

    if ($request['status'] === 'Pending') {
        $pending_requests++;
    }

    if ($request['status'] === 'Resolved') {
        $resolved_requests++;
    }
}


include 'includes/header.php';

?>

<main style="padding: 4rem 5%;">

    <!-- DASHBOARD HEADER -->

<div style="
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 2rem;
    gap: 1rem;
    flex-wrap: wrap;
">

    <div>

        <h1 style="
            font-size: 2.2rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        ">
            Admin Dashboard
        </h1>

        <p style="color: #64748b;">
            Overview of Omega Airlines bookings and customer support.
        </p>

    </div>

    <a
        href="admin.php?logout=true"
        style="
            background: #ef4444;
            color: #fff;
            padding: 0.8rem 1.2rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
        "
    >
        Logout
    </a>

</div>


<!-- SUMMARY CARDS -->

<div style="
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.2rem;
    margin-bottom: 3rem;
">

    <!-- TOTAL BOOKINGS -->

    <div style="
        background: #fff;
        padding: 1.5rem;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    ">

        <div style="
            font-size: 0.8rem;
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 0.7rem;
        ">
            Total Bookings
        </div>

        <div style="
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
        ">
            <?php echo $total_bookings; ?>
        </div>

        <div style="
            margin-top: 0.5rem;
            color: #64748b;
            font-size: 0.85rem;
        ">
            Flight bookings
        </div>

    </div>


    <!-- TOTAL SUPPORT -->

    <div style="
        background: #fff;
        padding: 1.5rem;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    ">

        <div style="
            font-size: 0.8rem;
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 0.7rem;
        ">
            Support Requests
        </div>

        <div style="
            font-size: 2rem;
            font-weight: 700;
            color: #0f766e;
        ">
            <?php echo $total_support_requests; ?>
        </div>

        <div style="
            margin-top: 0.5rem;
            color: #64748b;
            font-size: 0.85rem;
        ">
            Customer inquiries
        </div>

    </div>


    <!-- PENDING -->

    <div style="
        background: #fff;
        padding: 1.5rem;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    ">

        <div style="
            font-size: 0.8rem;
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 0.7rem;
        ">
            Pending Requests
        </div>

        <div style="
            font-size: 2rem;
            font-weight: 700;
            color: #d97706;
        ">
            <?php echo $pending_requests; ?>
        </div>

        <div style="
            margin-top: 0.5rem;
            color: #64748b;
            font-size: 0.85rem;
        ">
            Awaiting response
        </div>

    </div>


    <!-- RESOLVED -->

    <div style="
        background: #fff;
        padding: 1.5rem;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    ">

        <div style="
            font-size: 0.8rem;
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 0.7rem;
        ">
            Resolved Requests
        </div>

        <div style="
            font-size: 2rem;
            font-weight: 700;
            color: #16a34a;
        ">
            <?php echo $resolved_requests; ?>
        </div>

        <div style="
            margin-top: 0.5rem;
            color: #64748b;
            font-size: 0.85rem;
        ">
            Successfully completed
        </div>

    </div>

</div>
    <!-- =================================================
         BOOKINGS
         ================================================= -->

    <h2 style="
        color: var(--primary);
        margin: 3rem 0 1rem;
    ">
        Flight Bookings
    </h2>

    <div style="
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        overflow-x: auto;
        border: 1px solid #e2e8f0;
    ">

        <table style="
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        ">

            <thead>

                <tr style="
                    background: var(--primary);
                    color: #fff;
                ">

                    <th style="padding: 1rem;">ID</th>
                    <th style="padding: 1rem;">Flight Code</th>
                    <th style="padding: 1rem;">Route</th>
                    <th style="padding: 1rem;">Date</th>
                    <th style="padding: 1rem;">Passengers</th>
                    <th style="padding: 1rem;">Tier</th>
                    <th style="padding: 1rem;">Price</th>
                    <th style="padding: 1rem;">Timestamp</th>

                </tr>

            </thead>

            <tbody>

                <?php if (count($bookings) > 0): ?>

                    <?php foreach ($bookings as $row): ?>

                        <tr style="
                            border-bottom: 1px solid #e2e8f0;
                        ">

                            <td style="padding: 1rem;">
                                <?php echo htmlspecialchars($row['id']); ?>
                            </td>

                            <td style="
                                padding: 1rem;
                                font-weight: 600;
                                color: var(--primary);
                            ">
                                <?php echo htmlspecialchars($row['flight_id']); ?>
                            </td>

                            <td style="padding: 1rem;">
                                <?php echo htmlspecialchars($row['departure_city']); ?>
                                &rarr;
                                <?php echo htmlspecialchars($row['arrival_city']); ?>
                            </td>

                            <td style="padding: 1rem;">
                                <?php echo htmlspecialchars($row['departure_date']); ?>
                            </td>

                            <td style="padding: 1rem;">
                                <?php echo htmlspecialchars($row['passengers']); ?>
                            </td>

                            <td style="padding: 1rem;">
                                <?php echo htmlspecialchars($row['flight_type']); ?>
                            </td>

                            <td style="
                                padding: 1rem;
                                font-weight: 600;
                            ">
                                $<?php echo htmlspecialchars($row['total_price']); ?>
                            </td>

                            <td style="
                                padding: 1rem;
                                color: #64748b;
                                font-size: 0.85rem;
                            ">
                                <?php echo htmlspecialchars($row['created_at']); ?>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td
                            colspan="8"
                            style="
                                padding: 2rem;
                                text-align: center;
                                color: #64748b;
                            "
                        >
                            No flight bookings found.

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>


    <!-- =================================================
         SUPPORT REQUESTS
         ================================================= -->

    <h2 style="
        color: var(--primary);
        margin: 4rem 0 1rem;
    ">
        Customer Support Requests
    </h2>

    <div style="
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        overflow-x: auto;
        border: 1px solid #e2e8f0;
    ">

        <table style="
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        ">

            <thead>

                <tr style="
                    background: var(--primary);
                    color: #fff;
                ">

                    <th style="padding: 1rem;">ID</th>
                    <th style="padding: 1rem;">Name</th>
                    <th style="padding: 1rem;">Email</th>
                    <th style="padding: 1rem;">Inquiry</th>
                    <th style="padding: 1rem;">Message</th>
                    <th style="padding: 1rem;">Status</th>
                    <th style="padding: 1rem;">Submitted</th>

                </tr>

            </thead>

            <tbody>

                <?php if (count($support_requests) > 0): ?>

                    <?php foreach ($support_requests as $row): ?>

                        <tr style="
                            border-bottom: 1px solid #e2e8f0;
                            vertical-align: top;
                        ">

                            <td style="padding: 1rem;">
                                <?php echo htmlspecialchars($row['id']); ?>
                            </td>

                            <td style="
                                padding: 1rem;
                                font-weight: 600;
                            ">
                                <?php echo htmlspecialchars($row['name']); ?>
                            </td>

                            <td style="padding: 1rem;">
                                <?php echo htmlspecialchars($row['email']); ?>
                            </td>

                            <td style="padding: 1rem;">
                                <?php echo htmlspecialchars($row['inquiry_type']); ?>
                            </td>

                            <td style="
                                padding: 1rem;
                                min-width: 250px;
                                line-height: 1.5;
                            ">
                                <?php echo nl2br(htmlspecialchars($row['message'])); ?>
                            </td>

                            <td style="padding: 1rem;">

                                <form action="admin.php" method="POST" style="display: flex; gap: 0.5rem; align-items: center;">

    <input
        type="hidden"
        name="support_id"
        value="<?php echo (int) $row['id']; ?>"
    >

    <select
        name="status"
        style="
            padding: 0.45rem 0.7rem;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-family: inherit;
            font-size: 0.85rem;
            background: #fff;
        "
    >

        <option
            value="Pending"
            <?php echo ($row['status'] === 'Pending') ? 'selected' : ''; ?>
        >
            Pending
        </option>

        <option
            value="In Progress"
            <?php echo ($row['status'] === 'In Progress') ? 'selected' : ''; ?>
        >
            In Progress
        </option>

        <option
            value="Resolved"
            <?php echo ($row['status'] === 'Resolved') ? 'selected' : ''; ?>
        >
            Resolved
        </option>

    </select>

    <button
        type="submit"
        name="update_status"
        style="
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 0.45rem 0.7rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.8rem;
            font-weight: 600;
        "
    >
        Update
    </button>

</form>

                            </td>

                            <td style="
                                padding: 1rem;
                                color: #64748b;
                                font-size: 0.85rem;
                                white-space: nowrap;
                            ">
                                <?php echo htmlspecialchars($row['created_at']); ?>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td
                            colspan="7"
                            style="
                                padding: 2rem;
                                text-align: center;
                                color: #64748b;
                            "
                        >
                            No customer support requests found.

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</main>

<?php include 'includes/footer.php'; ?>