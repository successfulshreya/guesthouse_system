<?php
session_start();
include '../db_connect.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user'){
    header('Location:../index.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '' ;

$guesthouse_id = isset($_GET['guesthouse_id']) ? intval($_GET['guesthouse_id']) : 0 ;
//agar guesthouse id url mai present hai tho integer vaLUE KARKE STORE KARLO ELSE O ZERO STORE KARKE FALSE STAQORE KAROO

//FETCHING THE GUESTHOUSE NAME FOR DROPDOWN
$gh_stmt=$conn->Prepare("SELECT id , name FROM guesthouses WHERE name IN ('VIP karishma guest house','Colony guesthouse siltara')");
$gh_stmt->execute();
$guesthouses=$gh_stmt->get_result();
$gh_stmt->close();

$data = null;

//if date filter applied
$sql = "SELECT 
    b.id,
    b.user_id,
    b.room_id,
    b.guest_name,
    b.guest_designation,
    b.checkin_date,
    b.checkout_date,
    b.status,
    b.total_cost,
    b.room_id AS room_label,
    IFNULL(r.rate_per_day, 0) AS rate_per_day,
    g.name AS guesthouse_name,
    DATEDIFF(b.checkout_date, b.checkin_date) AS days_calc
FROM bookings b
JOIN rooms r ON b.room_id = r.id
JOIN guesthouses g ON r.guesthouse_id = g.id
WHERE b.user_id = ?
AND b.checkin_date BETWEEN ? AND ? AND b.status = 'approved'";


//GUESTHOUSE FILTER
if ($guesthouse_id > 0) {
    $sql .= " AND g.id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Failed to prepare statement: " . $conn->error);
    }
    $stmt->bind_param('issi', $user_id, $from, $to, $guesthouse_id);
} else {
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Failed to prepare statement: " . $conn->error);
    }
    $stmt->bind_param('iss', $user_id, $from, $to);
}


$stmt->execute();
$data=$stmt->get_result();
$stmt->close();

?>



<!DOCTYPE html>
<html>
<head>
    <title>Booking Report</title>
    <meta charset="utf-8" />

    <!--  Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        /*  Table styling */
        table, th, td {
            border: 1px solid #ddd;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }

        /*  Layout styling */
        .sidebar {
            width: 250px;
            background: #212529;
            color: #fff;
            min-height: 100vh;
        }
        .main-content { padding: 20px; }
        .topbar {
            background: #fff;
            padding: 12px 18px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        .btn-sm { font-size: .85rem; }
        .table{
            width:50%;
        }
    </style>
</head>

<body style="display: flex; min-height: 100vh; background: #f0f2f5;">

<!--  Sidebar -->
<nav class="sidebar d-flex flex-column p-3">
    <div class="sidebar-header text-center mb-3">
        <i class="bi bi-people fs-1"></i>
        <div class="mt-2"><strong>USER</strong></div>
        <small class="text-white-50">(Reports)</small>
    </div>

    <ul class="nav nav-pills flex-column">
        
        <li class="nav-item"><a href="dashboard.php" class="nav-link text-light"><i class="bi bi-building"></i> Dashboard</a></li>
        <li class="nav-item"><a href="availability.php" class="nav-link text-light"><i class="bi bi-building"></i> Availability</a></li>
        <li class="nav-item"><a href="my_booking.php" class="nav-link text-light"><i class="bi bi-door-open"></i> My Bookings</a></li>
        <li class="nav-item"><a href="book_room.php" class="nav-link text-light"><i class="bi bi-calendar-check"></i> Book Room</a></li>
        <li class="nav-item"><a href="report.php" class="nav-link active text-light"><i class="bi bi-journal"></i> Booking Report</a></li>
    </ul>

    <div class="mt-auto p-3">
        <a href="../logout.php" class="nav-link text-white-50"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
</nav>

<!--  Main content -->
<div class="main-content flex-grow-1">

    <!--  Topbar -->
    <div class="topbar d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-0">Booking Report</h5>
            <small class="text-muted">View & export your bookings</small>
        </div>
        <div>
            <strong style="color:chocolate">SARDA ENERGY and MINERALS LTD</strong>
        </div>
    </div>

    <!--  Filters -->
    <form method="get" class="row g-2 align-items-end mb-3">
        <div class="col-auto">
            <label class="form-label">From</label>
            <input type="date" name="from" class="form-control" required value="<?= htmlspecialchars($from) ?>">
        </div>
        <div class="col-auto">
            <label class="form-label">To</label>
            <input type="date" name="to" class="form-control" required value="<?= htmlspecialchars($to) ?>">
        </div>
        <div class="col-auto">
            <label class="form-label">Guesthouse</label>
            <select name="guesthouse_id" class="form-select">
                <option value="0">All Guesthouses</option>
                <?php while ($gh = $guesthouses->fetch_assoc()): ?>
                    <option value="<?= $gh['id'] ?>" <?= $guesthouse_id == $gh['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($gh['name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary">View</button>
        </div>
    </form>

    <!--  Print / Copy / Export Buttons -->
    <div class="mb-3">
        <button class="btn btn-success btn-sm me-2" onclick="printReport()">
            <i class="bi bi-printer"></i> Print
        </button>
        <button class="btn btn-primary btn-sm me-2" onclick="copyReport()">
            <i class="bi bi-clipboard"></i> Copy
        </button>
        <button class="btn btn-warning btn-sm" onclick="exportCSV()">
            <i class="bi bi-download"></i> Export CSV
        </button>
    </div>

    <!--  Report Table -->
    <?php if ($from && $to): ?>
        <?php if ($data && $data->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table" id="reportTable">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Guesthouse</th>
                            <th>Room</th>
                            <!-- <th>Guest</th> -->
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Days</th>
                            <!-- <th>Rate (Rs)</th> -->
                            <th>Total Cost (Rs)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($b = $data->fetch_assoc()): 
                            $days = max(1, (int)$b['days_calc']);
                            $rate = (float)$b['rate_per_day'];
                            $total = (float)$b['total_cost'] > 0 ? $b['total_cost'] : $days * $rate;
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($b['id']) ?></td>
                            <td><?= htmlspecialchars($b['guesthouse_name']) ?></td>
                            <td><?= htmlspecialchars($b['room_label']) ?></td>
                       
                            <td><?= htmlspecialchars($b['checkin_date']) ?></td>
                            <td><?= htmlspecialchars($b['checkout_date']) ?></td>
                            <td><?= $days ?></td>
                         
                            <td><?= number_format($total,2) ?></td>
                            <td>
                                <span class="badge 
                                    <?= $b['status']=='approved' ? 'bg-success' : 
                                       ($b['status']=='pending' ? 'bg-warning text-dark' : 'bg-danger') ?>">
                                    <?= ucfirst($b['status']) ?>
                                </span>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">No bookings found in this date range.</div>
        <?php endif; ?>
    <?php endif; ?>
</div>



<!--  JS Functions -->
<script>
function printReport() {
    const table = document.getElementById('reportTable');
    if (!table) return alert('No report to print');

    const w = window.open('', '_blank');
    w.document.write(`
        <html><head><title>Print Report</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            table, th, td { border:1px solid #ddd; border-collapse:collapse; padding:8px; }
        </style>
        </head><body>
        <h3>Booking Report</h3>
        ${table.outerHTML}
        </body></html>
    `);
    w.document.close();
    w.print();
}

function copyReport() {
    const table = document.getElementById('reportTable');
    if (!table) return alert('No report to copy');

    const range = document.createRange();
    range.selectNode(table);
    const sel = window.getSelection();
    sel.removeAllRanges();
    sel.addRange(range);

    try {
        document.execCommand('copy');
        alert('Report copied to clipboard. now can paste on Excel/Word .');
    } catch (e) {
        alert('Copy failed: ' + e);
    }
    sel.removeAllRanges();
}

function exportCSV() {
    const table = document.getElementById('reportTable');
    if (!table) return alert('No report to export');

    const rows = [];
    const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.innerText.trim());
    rows.push(headers.join(','));

    table.querySelectorAll('tbody tr').forEach(tr => {
        const cols = Array.from(tr.querySelectorAll('td')).map(td => {
            let txt = td.innerText.replace(/"/g, '""').trim();
            if (txt.includes(',') || txt.includes('"')) txt = `"${txt}"`;
            return txt;
        });
        rows.push(cols.join(','));
    });

    const csv = rows.join('\n');
    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');

    const from = document.querySelector('input[name="from"]').value || 'from';
    const to = document.querySelector('input[name="to"]').value || 'to';
    a.download = `booking_report_${from}_to_${to}.csv`;

    a.href = url;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}
</script>

</body>
</html>

