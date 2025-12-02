<?php
  session_start();
  $username = $_POST['username'];
  $password = $_POST['password'];
  $failLocation = "Location: ./loginFail.html";
  $acceptLocation  = "Location: ../MenuOptions/landingPage.php";

  $host = 'localhost';
  $user = 'Godwin';
  $pass = 'ZsJrjhp7M';
  $dbname = 'CS344Project';
  
  $user1= "CS344";
  $pass1="CS344F25";
  $dbname1= "CS344F25";

  if($username == null || $password == null){
        header($failLocation);
        exit;
  }

 $conn = new mysqli($host, $user, $pass, $dbname);

  if($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
  }

  $stmt = $conn->prepare("SELECT * FROM LoginEL WHERE username=? AND password=?");
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
      $_SESSION['username'] = $username;
      header($acceptLocation);
      exit;
  } else {
      header($failLocation);
      exit;
  }
?>
