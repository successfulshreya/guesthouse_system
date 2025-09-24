<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
include '../db_connect.php';

// fetch guesthouses for select box
$gh_result = $conn->query("SELECT id, name FROM guesthouses ORDER BY name");

$msg = '';
if(isset($_GET['success'])){
    $msg="room added successfully :)";
}
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // get inputs safely
    $guesthouse_id = intval($_POST['guesthouse_id'] ?? 0);
    $room_id = trim($_POST['room_id'] ?? '');
    $status = trim($_POST['status'] ?? '');

    if ($guesthouse_id <= 0 || $room_id === '' || $status === '') {
        $msg = "Please fill all the fields.";
    } else {
        $stmt = $conn->prepare("INSERT INTO rooms (guesthouse_id, room_id, status) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $guesthouse_id, $room_id, $status);

        if ($stmt->execute()) {
            // $msg = "Room added successfully.";
            header("Location:add_room.php?success=1");
            exit();
        } else {
            $msg = "Error: " . htmlspecialchars($stmt->error);
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="container mt-4">
    <h2>Add Room</h2>

    <?php if ($msg): ?>
        <div class='alert alert-info'><?php echo htmlspecialchars($msg); ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="guesthouse_id" class="form-label">Guesthouse</label>
            <select name="guesthouse_id" id="guesthouse_id" class="form-control" required>
                <option value="">Select a guesthouse</option>
                <?php
                if ($gh_result) {
                    while ($row = $gh_result->fetch_assoc()) {
                        echo '<option value="' . intval($row['id']) . '">' . htmlspecialchars($row['name']) . '</option>';
                    }
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="room_id" class="form-label">Room Number</label>
            <input type="text" name="room_id" id="room_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <input type="text" name="status" id="status" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Room</button>
        <a href="dashboard.php" class="btn btn-secondary">Back</a>
    </form>

</body>
</html>
