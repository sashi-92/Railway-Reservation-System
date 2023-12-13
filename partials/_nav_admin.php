<style>
.nav-link:hover {
    color: white;
}

#logout:hover {
    color: white;
}

#logout {
    color: #FFFFFF8C;
}

.dropdown:hover {
    color: white;
}

.dropbtn {
    background-color: #000916;
    color: grey;
    padding: 8px;
    font-size: 16px;
    border: none;
}

.dropbtn:hover {
    color: white;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: black;
    min-width: 160px;
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: white;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
    background-color: white;
    color: black;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
    background-color: #000916;
}
</style>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #000916;">
    <div class="container-fluid">
        <a class="navbar-brand" href="/rrs-xampp"><strong>ISM Railway</strong></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../admin/welcome_admin.php">Home</a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="dropbtn">Trains</button>
                        <div class="dropdown-content">
                            <a href="../admin/add_train.php">Add Train</a>
                            <a href="../admin/delete_train.php">Delete Train</a>
                        </div>
                    </div>
                    <!-- <a class="nav-link" aria-current="page" href="/rrs/manage_trains.php">Manage Train</a> -->
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="dropbtn">Manage Admins</button>
                        <div class="dropdown-content">
                            <a href="../admin/add_admin.php">Add admin</a>
                            <a href="../admin/delete_admin.php">Delete admin</a>
                        </div>
                    </div>
                    <!-- <a class="nav-link" aria-current="page" href="/rrs/manage_admin.php">Manage Admin</a> -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../admin/manage_users.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../admin/show_booking.php">Bookings</a>
                </li>
            </ul>

        </div>
        <?php
            //session_start();
           // $username=$_SESSION['username'];
        ?>

        <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <div class="dropdown">
                    <button class="dropbtn" style="font-size:18px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-person" viewBox="0 0 16 16">
                            <path
                                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                        </svg></button>
                    <div class="dropdown-content">
                        <a href="display_profile.php">View Profile</a>
                        <a href="edit_profile.php">Edit Profile</a>
                        <a href="change_pswd.php">Change Password</a>
                    </div>
                </div>
            </li>
        </ul>

        <div id="logout" class="row mx-2">
            <a class="nav-link" href="../partials/logout.php">Logout</a>
        </div>
    </div>
</nav>
