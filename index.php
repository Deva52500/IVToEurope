
<?php include "./inc/dbinfo.inc"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IV Form</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Sriracha&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php

$insert = false;
if(isset($_POST['name'])){  
  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(RDS_HOSTNAME, RDS_USERNAME, RDS_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, RDS_DB_NAME);
 
    // Collect post variables
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $desc = $_POST['desc'];
    $sql = "INSERT INTO `ebdb`.`IV` (`Name`, `Age`, `Gender`, `Email`, `Phone`, `Description`) VALUES ('$name', '$age', '$gender', '$email', '$phone', '$desc');";
    // echo $sql;

    // Execute the query
    if($connection->query($sql) == true){
        // echo "Successfully inserted";

        // Flag for successful insertion
        $insert = true;
    }
    else{
        echo "ERROR: $sql <br> $connection->error";
    }

    // Close the database connection
    $connection->close();
    }
?>

    <img class="bg" src="Uni.jpg" alt="University">
    <div class="container">
        <h1>Welcome to Industrial Visit to Europe 2023</h3>
        <p>Enter your details and submit this form to confirm your participation in the IV </p>
        <?php
        
        if($insert == true){
        echo "<p class='submitMsg'>Thanks for submitting your form. We are happy to see you joining us for the Europe trip</p>";
        }
    ?>
        <form action="index.php" method="post">
        <input type="text" name="name" id="name" placeholder="Enter your name" required>
            <input type="number" size="6" name="age" id="age" min="18" max="99" placeholder="Enter your Age" required>
            <input type="text" name="gender" id="gender" placeholder="Enter your gender: M/F" required pattern=" *[MmFf]? *"> 
            <input type="email" name="email" id="email" placeholder="Enter your email: abc@xyz">
            <input type="tel" id="phone" name="phone" placeholder="Phone: 12345678900" pattern="[0-9]{11}" required> 
            <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Enter any other information here"></textarea>
            <button class="btn">Submit</button></form>
        </form>
    </div>
    <script src="index.js"></script>
    
</body>
</html>
