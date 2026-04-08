<?php
session_start();

// Hardcode username dan password
$USERNAME = "project";
$PASSWORD = "pbo";

// Proses login
$error = "";
if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if ($user === $USERNAME && $pass === $PASSWORD) {
        $_SESSION['logged_in'] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login SIAKAD MINI</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #ffe6f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background: #fff0f5;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            width: 350px;
            text-align: center;
        }
        h2 { color: #d6336c; margin-bottom: 30px; }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #e75480;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #d6336c;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover { background: #e75480; }
        .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>
<div class="login-box">
    <h2>Login SIAKAD MINI</h2>
    <?php if ($error) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="login">Login</button>
    </form>
</div>
</body>
</html>