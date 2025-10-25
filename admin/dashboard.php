<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            background-color: #f0f2f5;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #1976d2, #42a5f5);
            color: #fff;
            flex-shrink: 0;
            transition: width 0.3s ease;
        }
        .sidebar.collapsed {
            width: 80px;
        }
        .sidebar-header {
            padding: 20px;
            text-align: center;
        }
        .sidebar .nav-link {
            color: #e3e3e3;
            padding: 15px 20px;
            border-radius: 8px;
            margin: 5px 10px;
            transition: background 0.2s;
        }
        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            border-left: 4px solid #ffffff;
        }
        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
        }
        .sidebar .nav-link i {
            margin-right: 12px;
        }

        /* MAIN AREA */
        .main-content {
            flex-grow: 1;
            padding: 20px;
        }

        /* TOPBAR */
        .topbar {
            height: 70px;
            background: #1976d2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            border-radius: 8px;
            color: #fff;
            margin-bottom: 20px;
        }

        /* CARDS */
        .card-action {
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 20px;
            border: none;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(5px);
        }
        .card-action:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.15);
        }
        .icon-circle {
            background: rgba(0,0,0,0.05);
            border-radius: 50%;
            padding: 15px;
            margin-right: 20px;
        }

        /* COLLAPSE ICON HIDE TEXT */
        .sidebar.collapsed .nav-link span {
            display: none;
        }
        .sidebar.collapsed .nav-link i {
            margin: 0;
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<nav class="sidebar d-flex flex-column" id="sidebar">
    <div class="sidebar-header">
        <img src="logo.png" style="width: 180px;">
    </div>
    <ul class="nav nav-pills flex-column flex-grow-1 p-2">
        <li><a href="add_user.php" class="nav-link"><i class="bi bi-person-plus"></i><span> Add User</span></a></li>
        <li><a href="add_guesthouse.php" class="nav-link"><i class="bi bi-building"></i><span> Add Guesthouse</span></a></li>
        <li><a href="add_room.php" class="nav-link"><i class="bi bi-door-open"></i><span> Add Room</span></a></li>
        <li><a href="manage_booking.php" class="nav-link"><i class="bi bi-calendar-check"></i><span> Manage Booking</span></a></li>
    </ul>
    <div class="p-3">
        <a href="../logout.php" class="nav-link text-white-50"><i class="bi bi-box-arrow-right"></i><span> Logout</span></a>
    </div>
</nav>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="topbar">
        <h5>Dashboard</h5>
        <div class="d-flex align-items-center">
            <button class="btn btn-light btn-sm me-3" onclick="toggleSidebar()"><i class="bi bi-list"></i></button>
           <?php echo htmlspecialchars($_SESSION['email']); ?>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <a href="add_user.php" class="text-decoration-none">
                    <div class="card card-action h-100 p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle"><i class="bi bi-person-plus fs-3"></i></div>
                            <div><h5>Add User</h5><p>Create new user accounts</p></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="add_guesthouse.php" class="text-decoration-none">
                    <div class="card card-action h-100 p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle"><i class="bi bi-building fs-3"></i></div>
                            <div><h5>Add Guesthouse</h5><p>Add new guesthouse info</p></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="add_room.php            " class="text-decoration-none">
                    <div class="card card-action h-100 p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle"><i class="bi bi-door-open fs-3"></i></div>
                            <div><h5>Add Room</h5><p>Manage rooms in guesthouses</p></div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-4">
                <a href="manage_booking.php" class="text-decoration-none">
                    <div class="card card-action h-100 p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle"><i class="bi bi-calendar-check fs-3"></i></div>
                            <div><h5>Manage Bookings</h5><p>View and handle all bookings</p></div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-4">
                <a href="../logout.php" class="text-decoration-none">
                    <div class="card card-action h-100 p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle"><i class="bi bi-box-arrow-right fs-3"></i></div>
                            <div><h5>Logout</h5><p>Sign out from the system</p></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- SIDEBAR TOGGLE SCRIPT -->
<script>
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("collapsed");
    }

    // Highlight current sidebar menu based on URL
    const links = document.querySelectorAll('.sidebar .nav-link');
    links.forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add('active');
        }
    });
</script>

</body>
</html>

