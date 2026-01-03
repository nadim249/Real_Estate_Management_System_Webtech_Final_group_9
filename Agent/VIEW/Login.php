-<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            height: 100vh;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        
        .image {
            width: 50%;
        }

        .image img {
            width: 100%;
            height: 100%;
            object-fit:fill;
            
        }

      
        .login {
            width: 50%;
            display: flex;
            flex-direction: column;   
            align-items: center;
            padding-top: 30px;       
        }

        
        .login h1 {
            margin: 0 0 20px 0;       
        }

       
        .box {
            width: 250px;
            text-align: auto;
            margin-top:50px;
        }

        .box h2 {
            margin-bottom: 15px;
        }

        input {
          width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 20px;
        }

        button {
            width: 100px;
            padding: 8px;
            margin-top: 10px;
            font-size: 14px;
            background-color: rgb(0 0 0);
            color: black;
            border-radius: 10px;
            
            color: white;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="image">
            <img src="Images/homeImg.jpg" alt="Image">
        </div>

        <div class="login">
          
            <h1 style="font-family:serif; font-weight:bold;font-size:60px ;">Estate-Us</h1>

            
            <div class="box">
                <h2>Login</h2>
                <input type="text" placeholder="Username">
                <input type="password" placeholder="Password">
                <button>Login</button>
                <a href=""></a>Forget Password?
                <br>
                <br>
                <br>

                <p style="margin-top: 10px;font-size:14px;">
                    New here?
                    <a href="Signup.php" >
                  <button>Sign up</button>
                    </a>
                </p>
            </div>
        </div>

    </div>


</body>
</html>
