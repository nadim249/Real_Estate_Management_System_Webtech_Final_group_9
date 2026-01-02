<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../Public/CSS/styles.css">
</head>
<body>
    <body id="page-login">

    <div class="login-card">
        <div class="login-header">
            <h2>EstateMgr Admin</h2>
            <p>Please login to your account</p>
        </div>

        <form onsubmit="">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" id="login-email" class="email-input" placeholder="admin@example.com" >
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" id="login-pass" class="pass-input" placeholder="••••••••" >
            </div>

            <button type="submit" class="log-btn">Login</button>
        </form>

        <div class="login-footer">
            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>
    </div>
</body>
</html>