<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            background-image: url('https://img.freepik.com/premium-vector/abstract-colorful-gradient-background-combination-shades-arranged-plate_622214-20852.jpg?ga=GA1.1.1553320582.1730781172');
            background-size: cover;
            color: #333;
            line-height: 1.6;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            max-width: 600px;
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 2.5rem;
            color: #4CAF50;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 1.1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #0056b3;
        }

        .success-message {
            color: #4CAF50;
            font-weight: bold;
            margin-top: 20px;
        }

        .error-message {
            color: #f44336;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php 
    $session = session();
    if (!$session->get('isLoggedIn')): ?>
        <script>window.location.href = '/login';</script>
    <?php endif; ?>

    <div class="container">
        <h1>Welcome, <?= esc($name) ?>!</h1>
        <p>You are now logged in!</p>
        <a href="<?= site_url('logout') ?>">Logout</a>
    </div>
</body>
</html>
