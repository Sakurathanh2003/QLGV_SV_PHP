<?php
require '../../BLL/adminBLL.php';
require '../../Common/commonfunction.php';

navigateIfNeed('admin');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    logout();
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<link rel="stylesheet" href="adminUI.css">
<body>
    <!--Left side bar-->
    <div class="sidebar">
        <div class="logo-content">
            <div class="logo">
            <i class='bx bxs-invader'></i>
            <h3>Admin</h3>
            </div>
            <i class='bx bx-menu' id="btn"></i>
        </div>

        <ul class="list">
            <li class="list-item active">
                <a href="#" onClick="openTab('dashboardTab');">
                    <i class='bx bxs-dashboard' ></i>
                    <span class="links-name">Dashboard</span>
                </a>
            </li>
            <li class="list-item">
                <a href="#" onClick="openTab('studentTab');">
                    <i class='bx bxs-graduation'></i>
                    <span class="links-name">Student</span>
                </a>
            </li>
            <li class="list-item">
                <a href="#" onClick="openTab('teacherTab');">
                    <i class='bx bx-body'></i>
                    <span class="links-name">Teacher</span>
                </a>
            </li>
        </ul>

        <form action="" method="post" id="logoutForm">
            <ul class="list-logout">
                <li>
                    <a href="#" onClick="login();">
                        <i class='bx bx-log-out' ></i>
                        <span class="links-name">Logout</span>
                    </a>
                </li>
            </ul>
        </form>
    </div>

    <!--Content-->
    <div class="content">
        <!--Navigation bar-->
        <?php include "nav.php";?>
        
        <!--TAB-->
        <div id="dashboardTab" class="tab">
            <?php
                include "../Admin/Tab/dashboardTabUI.php";
            ?>
        </div>
        
        <div id="studentTab" class="tab" style="display: none">
            <?php
                include "../Admin/Tab/studentTabUI.php";
            ?>
        </div>

        <div id= "teacherTab" class="tab" style="display: none">
            <?php
                 include "../Admin/Tab/teacherTabUI.php";
            ?>
        </div>
    </div>
    <script src="adminUI.js"></script>
</body>
</html>