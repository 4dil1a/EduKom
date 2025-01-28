<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 35px;
            background-color: #176B87;
            display: flex;
            justify-content: space-between; /* Align left and right */
            align-items: center;
            padding: 0 10px;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .footer .left,
        .footer .right {
            color: white;
            font-size: 0.75rem; /* Make font smaller */
        }

        .footer .right {
            text-align: right; /* Align text to the right */
        }
    </style>
</head>
<body>
    <!-- Your page content goes here -->

    <footer class="footer">
        <div class="left">© 2025 All Rights Reserved Dinas Komunikasi dan Informatika Kabupaten Pekalongan</div>
        <div class="right">Made with ♡ - Intern Undip</div>
    </footer>
</body>
</html>
