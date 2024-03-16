<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payroll System</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      overflow: hidden;
    }

    .navbar {
      background-color: #333;
      padding: 15px;
      color: white;
      text-align: center;
    }

    .menu-bar {
      display: flex;
      justify-content: space-between;
      padding: 10px;
    }

    .menu-items {
      list-style: none;
      display: flex;
      margin: 0;
      padding: 0;
    }

    .menu-item {
      margin: 0 10px;
    }

    .curtain {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: none;
      justify-content: center;
      align-items: center;
    }

    .curtain-content {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      max-width: 400px;
    }

    /* Add media queries for responsiveness */
    @media (max-width: 600px) {
      .menu-bar {
        flex-direction: column;
      }

      .menu-items {
        margin-top: 10px;
      }
    }
  </style>
</head>
<body>

  <div class="navbar">Payroll System</div>

  <div class="curtain" id="curtain">
    <div class="curtain-content">
      <!-- Add your curtain content here -->
      <p>This is the curtain content.</p>
      <button onclick="closeCurtain()">Close Curtain</button>
    </div>
  </div>

  <div class="menu-bar">
    <div class="menu-items">
      <li class="menu-item"><a href="#">Home</a></li>
      <li class="menu-item"><a href="#">Employees</a></li>
      <li class="menu-item"><a href="#">Payroll</a></li>
      <li class="menu-item"><a href="#">Reports</a></li>
    </div>
    <div class="menu-item">
      <button onclick="openCurtain()">Open Curtain</button>
    </div>
  </div>

  <!-- JavaScript for opening and closing the curtain -->
  <script>
    function openCurtain() {
      document.getElementById("curtain").style.display = "flex";
    }

    function closeCurtain() {
      document.getElementById("curtain").style.display = "none";
    }
  </script>

</body>
</html>
