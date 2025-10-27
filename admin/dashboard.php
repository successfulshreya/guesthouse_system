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
      <link rel="stylesheet" href="styleadmin.css?v=<?php echo time(); ?>">
  
</head>
<body>

<!-- SIDEBAR -->
<nav class="sidebar d-flex flex-column" id="sidebar">
    
      <div class="sidebar-header">
            <img src="logo.png" alt="Logo" style="width: 180px;" ><br><br>
            <div class="user-title">Admin</div>
            <div class="user-subtitle">Dashboard</div>
        </div>
  
    <ul class="nav nav-pills flex-column flex-grow-1 p-2">
        <li><a href="add_user.php" class="nav-link"><i class="bi bi-person-plus"></i><span> Add User</span></a></li>
        <li><a href="add_guesthouse.php" class="nav-link"><i class="bi bi-building"></i><span> Add Guesthouse</span></a></li>
        <li><a href="add_room.php" class="nav-link"><i class="bi bi-door-open"></i><span> Add Room</span></a></li>
        <li><a href="manage_booking.php" class="nav-link"><i class="bi bi-calendar-check"></i><span> Manage Booking</span></a></li>
    </ul>
    <div class="p-3">
           <a href="../logout.php" class="nav-link text-dark-50"><i class="bi bi-box-arrow-right"></i><span> Logout</span></a>
    </div>
</nav>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="topbar">
        <h5>Dashboard</h5>
        <div class="d-flex align-items-center">
                <button class="btn btn-light btn-sm me-3" onclick="toggleSidebar()">
                <i class="bi bi-list"></i></button>
                      
           <?php echo htmlspecialchars($_SESSION['email']); ?>
           <i class="bi bi-person-circle fs-2 ms-2"></i>
            
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