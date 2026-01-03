<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EstateNexus - Home</title>
  <link rel="stylesheet" href="../Public/css/style6.css" />
</head>
<body>

  <header class="nav">
    <div class="nav-left">
      <span class="logo">EstateNexus</span>
    </div>

    <nav class="nav-center">
      <a href="dashboard.php">Home</a>
      <a href="properties.php">Properties</a>
      <a href="aboutus.php">About Us</a>
      <a href="contact.php">Contact</a>
    </nav>

    <div class="nav-right">
      <a class="login" href="login.php">Log In</a>
      <a class="signup" href="signup.php">Sign Up</a>
    </div>
  </header>

  <section class="hero">
    <div class="hero-box">
      <h1>Find Your Dream Home</h1>
      <p>Browse thousands of properties for sale and rent.</p>


      <div class="search-panel">
        <div class="tabs">
          <button class="tab active">Buy</button>
        </div>

        <div class="search-row">
          <div class="field">
            <label>Property Type</label>
            <select>
              <option>Any Type</option>
              <option>Apartment</option>
              <option>House</option>
              <option>Villa</option>
            </select>
          </div>

          <div class="field">
            <label>Location</label>
            <select>
              <option>Gulshan</option>
              <option>Bashundhara</option>
              <option>Banani</option>
              <option>Dhanmondi</option>
            </select>
          </div>

          <div class="field">
            <label>Price Range</label>
            <select>
              <option>Minimum - Maximum</option>
              <option>20,000,000 BDT - 300,000,000 BDT</option>
              <option>300,000,000 BDT - 700,000,000 BDT</option>
              <option>700,000,000 BDT</option>
            </select>
          </div>

          <button class="search-btn"> Search</button>
        </div>
      </div>
    </div>
  </section>


  <section class="featured">
    <h2>Featured Properties</h2>

    <div class="cards">

      <div class="p-card">
        <div class="p-img">
          <span class="badge sale">For Sale</span>
          <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?q=80&w=1200&auto=format&fit=crop" alt="Villa">
        </div>
        <div class="p-body">
          <div class="p-price">450,000,000 BDT</div>
          <div class="p-title">Modern Villa</div>
          <div class="p-loc"> Gulshan 2, Dhaka</div>
        </div>
      </div>

      <div class="p-card">
        <div class="p-img">
          <span class="badge rent">For Rent</span>
          <img src="https://images.unsplash.com/photo-1505691938895-1758d7feb511?q=80&w=1200&auto=format&fit=crop" alt="Apartment">
        </div>
        <div class="p-body">
          <div class="p-price">200,000 BDT/mo</div>
          <div class="p-title">City Apartment</div>
          <div class="p-loc">Banani, Dhaka</div>
        </div>
      </div>

      <div class="p-card">
        <div class="p-img">
          <span class="badge sale">For Sale</span>
          <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=1200&auto=format&fit=crop" alt="House">
        </div>
        <div class="p-body">
          <div class="p-price">50,200,000 BDT</div>
          <div class="p-title">Modern Family Home</div>
          <div class="p-loc"> Bashundhara R/A, Dhaka</div>
        </div>
      </div>

      <div class="p-card">
        <div class="p-img">
          <span class="badge sale">For Sale</span>
          <img src="https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?q=80&w=1200&auto=format&fit=crop" alt="Penthouse">
        </div>
        <div class="p-body">
          <div class="p-price">200,500,000 BDT</div>
          <div class="p-title">Luxury Penthouse</div>
          <div class="p-loc"> Dhanmondi,Dhaka</div>
        </div>
      </div>

    </div>
  </section>
</body>
</html>
