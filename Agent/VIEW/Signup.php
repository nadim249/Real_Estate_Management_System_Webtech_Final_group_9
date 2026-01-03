<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>

    <style>
        body
        {
            margin:0;
            font-family: Arial, sans-serif;
            height: 100vh;

        }

        
        .container {
            display: flex;
            height: 100vh;
        }

     
        .left {
            width: 50%;
        }

        .left img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

       
        .rightpart {
            width: 50%;
            padding: 40px;
            align-items: center;
            text-align: center;
        }

        h1 {
            margin-bottom: 10px;
        }

        p {
            margin-bottom: 20px;
        }

        input {
            width: 50%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 20px;
        }

       button {
    width: 150px;
    padding: 8px;
    margin: 10px auto;   
    font-size: 14px;
    background-color: rgb(0 0 0);
    color: white;
    border-radius: 20px;
    display: block;
}

    </style>
</head>
<body>
    
    <div class="container">

      
        <div class="left">
            <img src="Images/homeImg.jpg" alt="Image">
        </div>

        <div class="rightpart">
            <h1>Create an Account</h1>
            <hr>
            <p>Already have an account? <a href="Login.php">Login</a></p>
            <br>
            <br>

            <input type="text" placeholder="First Name">
            <input type="text" placeholder="Last Name">
            <input type="email" placeholder="Email">
            <input type="password" placeholder="Password">
        
            <br>
            <br>
            <br>
            <br>
            <button>Create Account</button>
        </div>

    </div>
</body>

</html>