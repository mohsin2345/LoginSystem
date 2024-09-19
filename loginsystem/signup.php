<?php
$showAlert = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partial/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $exists = false;

    // Check if username already exists
    $sql = "SELECT * FROM `user` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);
    $numExistRows = mysqli_num_rows($result);

    if ($numExistRows > 0) {
        $exists = true;
        $showError = "Username already exists";
    }

    // Check if passwords match and username does not exist
    if (($password == $cpassword) && !$exists) {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO `user` (`username`, `password`, `dt`) VALUES (?, ?, current_timestamp())");
        $stmt->bind_param("ss", $username, $password);
        $result = $stmt->execute();

        if ($result) {
            $showAlert = true;
        } else {
            $showError = "Error: " . $stmt->error;
        }
    } elseif ($password !== $cpassword) {
        $showError = "Passwords do not match";
    }
}

// Display messages if needed
// if ($showAlert) {
//     echo "<div class='alert alert-success'>Signup successful!</div>";
// }

// if ($showError) {
//     echo "<div class='alert alert-danger'>$showError</div>";
// }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Signup</title>
  </head>
  <body>
    <?php require 'partial/_nav.php'?>
    <?php
    if($showAlert){
  echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Sucess!</strong> Your account is now created and you can login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
';
}
?>
   <?php
    if($showError){
  echo '  <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> '.$showError.'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
';
}
?>
    <div class="container">
        <h1 class="text-center">Signup to our website</h1>
        <form action="/loginsystem/signup.php" method="post">
        
  <div class="mb-3">
    <label for="Username" class="form-label">User Name</label>
    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
    
  </div>
  <div class="mb-3">
    <label for="Password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="mb-3">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword">
    <div id="emailHelp" class="form-text">Make sure to type same password</div>
  </div>
  
 
  <button type="submit" class="btn btn-primary">Signup</button>
</form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
</head>
<body>
    
</body>
</html>