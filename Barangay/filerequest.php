<?php

require_once('phpexecution/uniretrieve.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/filerequest1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="icon" type="image/x-icon" href="css/pictures/Logo/brgylogo.svg">
    <title>File Request</title>
</head>
<body>
  <div class="sidebar">
    <div id="sidebartopa">
        <a href="dashboard.php">
          <div id="sidebartopwimg" class="sidebartopwimg" onclick="toggleActive('sidebartopwimg1')">
              <img src="css/pictures/sidebar/home.svg" alt="home">
              <span>Home</span>    
          </div>
      </a>

      <a href="filerequest.php">
          <div id="sidebartopwimg" class="sidebartopwimg active">
              <img src="css/pictures/sidebar/fileactive.svg" alt="File">
              <span>File Request</span>
          </div>
      </a>

      <a href="profileuser.php">
          <div id="sidebartopwimg" class="sidebartopwimg" onclick="toggleActive('sidebartopwimg3')">
              <img src="css/pictures/sidebar/profile.svg" alt="Profile">
              <span>Profile</span>   
          </div>
      </a>

      <a href="phpexecution/endsession.php">
          <div id="sidebartopwimg" class="sidebartopwimg" onclick="toggleActive('sidebartopwimg4')">
              <img src="css/pictures/sidebar/logout.svg" alt="Logout">
              <span>Logout</span>  
          </div>
      </a>
  </div>

  <div id="sidebarbottoma">
      <a href="usersupport.php">
          <div id="sidebartopwimg" class="sidebartopwimg" onclick="toggleActive('sidebartopwimg4')">
              <img src="css/pictures/sidebar/support.svg" alt="Support">
              <span>Support</span>  
          </div>
      </a>
  </div>

    <hr>

    <div id="profilebox">
        <div id="profileimage"></div>

        <div id="namebox">
            <h5 id="firstname"><?php echo $user['last_name'] . ', ' . substr($user['first_name'], 0, 1).'.';?></h5>
            <p><?php echo $user['email'];?></p>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        var firstname = $('#firstname').text();
        var intials = firstname.charAt(0);
        $('#profileimage').text(intials);
    });
</script>

<section id="for100vh">
    <div id="aboutsection">
      <h1>FILE REQUEST</h1>
      <p>Available Request:</p>
      <div class="container">
          <a href="file1.php" class="card">
              <img src="css/pictures/filereq/file1img.svg" alt="Image 1 description">
              <p>Barangay Clearance</p>
              <span>Ask for Barangay Clearance?</span>
            </a>
            <a href="file2.php" class="card">
              <img src="css/pictures/filereq/file2img.svg" alt="Image 2 description">
              <p>First Time Job Seeker</p>
              <span>Ask for First Time Job Seeker?</span>
            </a>
            <a href="file3.php" class="card">
              <img src="css/pictures/filereq/file3img.svg" alt="Image 2 description">
              <p>Business Permit</p>
              <span>Ask for Business Permit?</span>
            </a>
            <a href="file4.php" class="card">
              <img src="css/pictures/filereq/file4img.svg" alt="Image 2 description">
              <p>Certificate of Indigency</p>
              <span>Ask for Indigency?</span>
            </a>
      </div>
    </div>
</section>
</body>
</html>
