<?php
// register.php - User registration page

// Site configuration (moved from config.php)
$church_name = "Church of Christ-Disciples";
$tagline = "To God be the Glory";
$tagline2 = "Becoming Christlike and Blessing Others";
$address = "25 Artemio B. Fule St., San Pablo City, Laguna 4000 Philippines";
$phone = "0927 012 7127";
$email = "cocd1910@gmail.com";

// Start session
session_start();
$register_error = "";
$register_success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? "";
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";
    $confirm_password = $_POST["confirm_password"] ?? "";
    
    // Basic validation
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $register_error = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $register_error = "Passwords do not match.";
    } else {
        // In a real application, you would:
        // 1. Connect to a database
        // 2. Check if username/email already exists
        // 3. Hash the password
        // 4. Insert new user into database
        
        // For demonstration purposes only
        $register_success = "Registration successful! Please log in.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | <?php echo $church_name; ?></title>
    <link rel="icon" type="image/png" href="logo/cocd_icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Reusing the same styles from login page */
        :root {
            --primary-color: #3a3a3a;
            --accent-color: rgb(0, 139, 30);
            --light-gray: #d0d0d0;
            --white: #ffffff;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--white);
            color: var(--primary-color);
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        header {
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 100;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }
        
        .logo {
            display: flex;
            align-items: center;
        }
        
        .logo h1 {
            font-size: 24px;
            margin-left: 10px;
            color: var(--primary-color);
        }
        
        nav ul {
            display: flex;
            list-style: none;
        }
        
        nav ul li {
            margin-left: 20px;
        }
        
        nav ul li a {
            text-decoration: none;
            color: var(--primary-color);
            font-weight: 500;
            transition: color 0.3s;
        }
        
        nav ul li a:hover {
            color: var(--accent-color);
        }
        
        .register-container {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 70px;
            padding-right: 50px;
            overflow: hidden;
        }
        
        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('logo/churchpic.jpg');
            background-size: cover;
            background-position: center;
            filter: blur(5px);
            opacity: 0.8;
        }
        
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
        }
        
        .register-box {
            position: relative;
            z-index: 10;
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(5px);
            padding: 40px;
            border-radius: 10px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        
        .register-box h2 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
        }
        
        .register-box .church-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .register-box .church-logo img {
            height: 80px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--light-gray);
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(0, 139, 30, 0.2);
        }
        
        .form-group .input-icon {
            position: relative;
        }
        
        .form-group .input-icon i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
        }
        
        .form-group .input-icon input {
            padding-right: 40px;
        }
        
        .register-btn {
            width: 100%;
            background-color: var(--accent-color);
            color: var(--white);
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }
        
        .register-btn:hover {
            background-color: rgb(0, 112, 9);
        }
        
        .register-btn:active {
            transform: scale(0.98);
        }
        
        .login-link {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--light-gray);
        }
        
        .login-link a {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        .error-message {
            background-color: #ffebee;
            color: #c62828;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .success-message {
            background-color: #e8f5e9;
            color: #2e7d32;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
            }
            
            nav ul {
                margin-top: 15px;
            }
            
            .register-container {
                margin-top: 120px;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <img src="logo/cocd_icon.png" alt="Church Logo" style="height: 50px; margin-right: 20px;">
                    <h1><?php echo $church_name; ?></h1>
                </div>
                <nav>
                    <ul>
                        <li><a href="index.php#home">Home</a></li>
                        <li><a href="index.php#events">About</a></li>
                        <li><a href="index.php#services">Services</a></li>
                        <li><a href="index.php#about">News</a></li>
                        <li><a href="index.php#contact">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <section class="register-container">
        <div class="background-image"></div>
        <div class="overlay"></div>
        <div class="register-box">
            <div class="church-logo">
                <img src="logo/cocd_icon.png" alt="Church Logo">
            </div>
            <h2>Create Account</h2>
            
            <?php if (!empty($register_error)): ?>
                <div class="error-message">
                    <?php echo $register_error; ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($register_success)): ?>
                <div class="success-message">
                    <?php echo $register_success; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-icon">
                        <input type="text" id="username" name="username" required autocomplete="username">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-icon">
                        <input type="email" id="email" name="email" required autocomplete="email">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-icon">
                        <input type="password" id="password" name="password" required autocomplete="new-password">
                        <i class="fas fa-lock"></i>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <div class="input-icon">
                        <input type="password" id="confirm_password" name="confirm_password" required autocomplete="new-password">
                        <i class="fas fa-lock"></i>
                    </div>
                </div>
                
                <button type="submit" class="register-btn">Sign Up</button>
            </form>
            
            <div class="login-link">
                <p>Already have an account? <a href="login.php">Sign In</a></p>
            </div>
        </div>
    </section>
</body>
</html>