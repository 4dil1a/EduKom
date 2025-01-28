<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduKom Header</title>
    <style>
        @font-face {
            font-family: 'ADLaM Display';
            src: url('assets/fonts/adlam-display.woff2') format('woff2'),
                 url('assets/fonts/adlam-display.woff') format('woff');
            font-weight: normal;
            font-style: normal;
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px;
            background-color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .logo {
            display: flex;
            align-items: center;
            color: #2B6777;
            text-decoration: none;
            font-weight: bold;
            font-size: 25px;  /* Increased font size */
        }

        .logo img {
            height: 40px;  /* Set the logo image size */
            margin-right: 10px;
        }

        .header nav a {
            color: #2B6777;
            text-decoration: none;
        }
    </style>
</head>
<body>

<header class="header">
    <a href="/" class="logo">
        <img src="/logo.png" alt="EduKom Logo">
        EduKom
    </a>
    <nav>
        <div class="mt-auto">
            <a href="<?= site_url('admin/logout'); ?>" 
                class="btn-logout" 
                onclick="return confirm('Apakah Anda yakin ingin keluar?');">
                <i class="fas fa-sign-out-alt" style="font-size: 24px; padding-right: 10px"></i>
            </a>

        </div>
    </nav>
</header>

</body>
</html>
