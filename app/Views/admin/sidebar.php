<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Admin Sidebar</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #f3f4f6;
        }
        
        .sidebar {
            width: 205px;
            background-color: #176B87;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
        }
        
        .nav-menu {
            margin-top: 24px;
        }
        
        .menu-list {
            margin-top: 64px;
            padding: 0;
        }
        
        .menu-item {
            margin-bottom: 7px;
            list-style: none;
        }
        
        .menu-link {
            display: flex;
            align-items: center;
            padding: 12px 0;
            padding-left: 26px; /* Changed from 30px to 24px */
            color: white;
            font-weight: 600;
            text-decoration: none;
        }
        
        .menu-link:hover {
            background-color: #D9D9D9;
            color: black;
        }
        
        .menu-icon {
            width: 20px;
            font-size: 18px;
        }
        
        .menu-text {
            margin-left: 19px; /* Changed from 20px to 17px */
            font-size: 15px;
        }
        
        .active {
            background-color: #D9D9D9;
            color: black;
        }

        .content-wrapper {
            margin-left: 220px;
            width: calc(100% - 220px);
        }
    </style>
</head>
<body>
    <!-- Fixed Sidebar -->
    <div class="sidebar">
        <!-- Menu Sidebar -->
        <nav class="nav-menu">
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="/admin/dashboard" class="menu-link">
                        <i class="fas fa-home menu-icon"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/admin/materi" class="menu-link">
                        <i class="fas fa-book menu-icon"></i>
                        <span class="menu-text">Materi</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/admin/seminar" class="menu-link">
                        <i class="fas fa-info-circle menu-icon"></i>
                        <span class="menu-text">Info Seminar</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/admin/data_pengguna" class="menu-link">
                        <i class="fas fa-users menu-icon"></i>
                        <span class="menu-text">Data Pengguna</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/admin/kuis" class="menu-link">
                        <i class="fas fa-tasks menu-icon"></i>
                        <span class="menu-text">Kuis</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</body>
</html>