<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .layout
        {
            display: flex;
            height: 100vh;
        }

        .sidebar{
            width: 220px;
            background: rgb(0, 0, 0);
            color:rgb(255, 255, 255);
            padding:20px;
            position:fixed;
            top: 0;
            left: 0;
            bottom: 0;


        }
        .sidebar a 
        {
    display: block;
    text-decoration: none;
    color: rgb(255, 255, 255);
    margin: 60px 0;
    border-radius: 5px;
    font-family: serif;
    font-size: 20px;
        }
    .sidebar a:hover 
    {
      background: #333;
    }
    
    .gap
    {
        margin: 80px;
    }
      

        </style>


</head>
<body>

    <div class="layout">
      
    <div class="sidebar">
          <h2> Estate-Us</h2>
          <hr>
          <div class="gap">

          </div>
      <a href="#">Dashboard</a>
      <a href="#">My Properties</a>
      <a href="#">Inquiries</a>
      <a href="#">Add Property</a>
    </div>



    </div>
    
</body>
</html>