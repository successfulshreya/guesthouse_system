<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Panel Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            background-color: #f0f2f5; /* Light gray background for a modern feel */
        }
        .sidebar {
            width: 250px; /* Slightly wider sidebar */
            background: #212529; /* Darker background for more contrast */
            color: #fff;
            flex-shrink: 0;
            transition: width 0.3s;
        }
        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #495057;
        }
        .sidebar .nav-link {
            color: #adb5bd; /* Lighter gray text */
            padding: 15px 20px;
        }
        .sidebar .nav-link.active {
            background: #495057;
            color: #fff;
            border-left: 3px solid #0d6efd; /* Highlight active link */
        }
        .sidebar .nav-link:hover {
            background: #343a40;
            color: #fff;
        }
        .sidebar .nav-link i {
            margin-right: 12px;
            font-size: 1.2rem;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
        }
        .topbar {
            height: 70px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 20px;
            border-radius: 8px; /* Rounded corners for the topbar */
            box-shadow: 0 2px 4px rgba(0,0,0,0.05); /* Subtle shadow */
        }
        .welcome-card {
            background-color: #0d6efd; /* Bootstrap primary color */
            color: #fff;
            text-align: center;
            padding: 40px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .card-action {
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e9ecef;
        }
        .card-action:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        .card-action .card-body {
            display: flex;
            align-items: center;
            padding: 25px;
        }
        .card-action .icon-circle {
            background: #f8f9fa;
            border-radius: 50%;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
        }
        .card-action .icon-circle i {
            font-size: 2rem;
            color: #0d6efd;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<nav class="sidebar d-flex flex-column">
    <div class="sidebar-header">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none">
            <i class="bi bi-people fs-1"></i>
            <span class="fs-4 ms-3">USER<br><h6 class="text-white-50">(Book Room)</h6></span>
        </a>
    </div>
    <ul class="nav nav-pills flex-column flex-grow-1 p-3">
        <li class="nav-item">
            <a href="availability.php" class="nav-link"><i class="bi bi-building"></i> Availability</a>
        </li>
        <li class="nav-item">
            <a href="my_booking.php" class="nav-link"><i class="bi bi-door-open"></i> My Bookings</a>
        </li>
        <li class="nav-item">
            <a href="book_room.php" class="nav-link"><i class="bi bi-calendar-check"></i> Book Room</a>
        </li>
    </ul>
    <div class="p-3">
        <a href="../logout.php" class="nav-link text-white-50"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
</nav>

<!-- Main content area -->
<div class="main-content">
    <div class="topbar">
        <h5 class="mb-0">Dashboard</h5>
        <div class="d-flex align-items-center">
            <h4 class="mb-0 me-3">SARDA ENERGY and MINERALS LTD</h4>
            <span>Welcome, User</span>
        </div>
    </div>

    <div class="container-fluid">
        <div class="welcome-card mb-4">
            <h1 class="display-4">Welcome, User!</h1>
            <p class="lead">Book a room for your guests with ease.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <a href="my_booking.php" class="text-decoration-none">
                    <div class="card card-action h-100">
                        <div class="card-body">
                            <div class="icon-circle">
                                <i class="bi bi-door-open"></i>
                            </div>
                            <h5 class="card-title mb-0">My Bookings</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="book_room.php" class="text-decoration-none">
                    <div class="card card-action h-100">
                        <div class="card-body">
                            <div class="icon-circle">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <h5 class="card-title mb-0">Book a Room</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="availability.php" class="text-decoration-none">
                    <div class="card card-action h-100">
                        <div class="card-body">
                            <div class="icon-circle">
                                <i class="bi bi-building"></i>
                            </div>
                            <h5 class="card-title mb-0">Check Available Rooms</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoC54FuqKaufMkyO5o6FGSh+I4q3p5KlvTXCUzwx4Pp1FBr"
        crossorigin="anonymous"></script>

</body>
</html>
