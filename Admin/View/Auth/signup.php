<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/CSS/styles.css">
    <title>Sign up</title>

</head>
<body id="page-signup">
    
    <div class="signup-card">
        <div class="signup-header">
            <h2>Create Account</h2>
        </div>

        <form onsubmit="">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" class="signup-input" placeholder="Nabil" >
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" class="signup-input" placeholder="nabil@example.com" >
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="signup-input" placeholder="••••••••" >
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="signup-input" placeholder="••••••••" >
            </div>

            <button type="submit" class="signup-btn">Register</button>
        </form>

        <div class="signup-footer">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>
</body>
</html>