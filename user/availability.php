<?php
session_start();

// Check if user is logged in and has role 'user'; otherwise redirect to login/home
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../index.php");
    exit();
}

include '../db_connect.php';  // include DB connection (defines $conn)

// Fetch list of guesthouses (id, name) to populate the dropdown in the form
$gh_result = $conn->query("SELECT id, name FROM guesthouses ORDER BY name");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Check Availability</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="container my-4">
    <h2>Check Room Availability</h2>

    <!-- Form for user to choose guesthouse and date range -->
    <form method="GET" class="mb-4">
        <div class="row g-3">
            <!-- Guesthouse dropdown -->
            <div class="col-md-4">
                <label class="form-label">Guesthouse</label>
                <select name="guesthouse_id" class="form-control" required>
                    <option value="">-- Select --</option>
                    <?php while ($r = $gh_result->fetch_assoc()): ?>
                        <option value="<?php echo $r['id']; ?>"
                            <?php if (isset($_GET['guesthouse_id']) && $_GET['guesthouse_id'] == $r['id']) echo 'selected'; ?>>
                            <?= htmlspecialchars($r['name']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Check-in date input -->
            <div class="col-md-3">
                <label class="form-label">Check-in</label>
                <input type="date" name="checkin" class="form-control"
                       value="<?= isset($_GET['checkin']) ? htmlspecialchars($_GET['checkin']) : '' ?>"
                       min="<?= date('Y-m-d') ?>" required>
            </div>

            <!-- Check-out date input -->
            <div class="col-md-3">
                <label class="form-label">Check-out</label>
                <input type="date" name="checkout" class="form-control"
                       value="<?= isset($_GET['checkout']) ? htmlspecialchars($_GET['checkout']) : '' ?>"
                       min="<?= date('Y-m-d') ?>" required>
            </div>

            <!-- Submit button -->
            <div class="col-md-2 align-self-end">
                <button class="btn btn-primary w-100">Check</button>
            </div>
        </div>
    </form>

<?php
// Only run this block if the form was submitted with all required fields
if (isset($_GET['guesthouse_id'], $_GET['checkin'], $_GET['checkout'])) {
    $guesthouse_id = intval($_GET['guesthouse_id']);
    $checkin = $_GET['checkin'];
    $checkout = $_GET['checkout'];
    $today = date('Y-m-d');

    // Validate dates
    if ($checkin < $today) {
        echo "<div class='alert alert-danger'>Check-in date cannot be in the past.</div>";
    } elseif ($checkout <= $checkin) {
        echo "<div class='alert alert-danger'>Check-out date must be after check-in date.</div>";
    } else {
        // Prepare SQL to fetch all rooms in the selected guesthouse
        $rooms_stmt = $conn->prepare("SELECT id, room_id FROM rooms WHERE guesthouse_id = ?");
        $rooms_stmt->bind_param("i", $guesthouse_id);
        $rooms_stmt->execute();
        $rooms_result = $rooms_stmt->get_result();

        if ($rooms_result->num_rows > 0) {
            echo "<table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>Room</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            while ($room = $rooms_result->fetch_assoc()) {
                $room_id = $room['id'];

                // Check booking overlap
                $book_stmt = $conn->prepare("
                    SELECT 1 FROM bookings
                    WHERE room_id = ?
                      AND checkin_date < ?
                      AND checkout_date > ?
                ");
                $book_stmt->bind_param("iss", $room_id, $checkout, $checkin);
                $book_stmt->execute();
                $book_stmt->store_result();

                if ($book_stmt->num_rows > 0) {
                    echo "<tr>
                            <td>" . htmlspecialchars($room['room_id']) . "</td>
                            <td><span class='badge bg-danger'>Booked</span></td>
                            <td>-</td>
                          </tr>";
                } else {
                    echo "<tr>
                            <td>" . htmlspecialchars($room['room_id']) . "</td>
                            <td><span class='badge bg-success'>Available</span></td>
                            <td>
                                <form method='POST' action='book_room.php' class='m-0'>
                                    <input type='hidden' name='guesthouse_id' value='$guesthouse_id'>
                                    <input type='hidden' name='room_id' value='$room_id'>
                                    <input type='hidden' name='checkin_date' value='$checkin'>
                                    <input type='hidden' name='checkout_date' value='$checkout'>
                                    <button class='btn btn-sm btn-primary'>Book Now</button>
                                </form>
                            </td>
                          </tr>";
                }

                $book_stmt->close();
            }

            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-info'>No rooms found for this guesthouse.</div>";
        }
    }
}
?>
</body>
</html>
