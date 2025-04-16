<!--
Author: Wakana.G
Purpose: Validate new book input from new-book.php
Created: 25/04/2024
Last modified: 26/04/2024
-->
<?php
session_start();

  if ($_POST['token'] !== $_SESSION['token']) {
      die("Invalid request");
  }

  if (!isset($_SESSION['last_request'])) {
    $_SESSION['last_request'] = time();  // record inmitial timestamp
  } elseif (time() - $_SESSION['last_request'] < 10) {
    die("Too many requests. Please wait.");  // block request
  }
  $_SESSION['last_request'] = time();//update request time

?>
<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Library system</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
      <div class="m-3">
        <h1>Insert Book</h1>
        <?php
        //check input items
         if (
           (!empty($_POST['ISBN'])) &&
           (!empty($_POST['Author']))&&
           (!empty($_POST['Title']))&&
           (!empty($_POST['BookTypeID']))&&
           (!empty($_POST['Price'])))
           {
              if (!is_numeric($_POST['Price']))
                  {   die("Error - Price must be numeric
                    <br><a href=\"new-book.php\"><button class='btn btn-primary my-3'>Return New book</button></a>");
                  }

              else{

                  $ISBN = htmlspecialchars(trim($_POST['ISBN']));
                  $Author = htmlspecialchars(trim($_POST['Author']));
                  $Title = htmlspecialchars(trim($_POST['Title']));
                  $BookTypeID = $_POST['BookTypeID'];
                  $Price = $_POST['Price'];

              //Output posted items
              // echo "$ISBN, $Author, $Title, $BookTypeID, $Price ";

              if ($_POST['token'] !== $_SESSION['token']){
              die("Invalid request");
              }


                  //open the server connection
                  require 'dbConnectBooks.php';

                  //Prepared Statement to prevent SQL injection
                  $stmt = $conn->prepare("INSERT INTO Books (ISBN, Author, Title, BookTypeID, Price) VALUES (?, ?, ?, ?, ?)");
                  $stmt->bind_param("ssssd", $ISBN, $Author, $Title, $BookTypeID, $Price);

                  //insert data in the database -- only in local environment
                  //$sql = "INSERT INTO Books(ISBN, Author, Title, BookTypeID, Price) values('$ISBN', '$Author',  '$Title', '$BookTypeID', '$Price')";
                  //$result = mysqli_query($conn, $sql) or die("Error inserting a book - ".mysqli_error($conn));

                  //check the number of rows affected

                  if ($stmt->execute()){
                    $numrows = $stmt->affected_rows;
                    if ($numrows == 1)
                      echo "<h2 class='text-success'>1 book added successfully</h2>";
                    else
                      echo "<h2 class='text-danger'>Book add failed: $numrows were updated</h2>";
                  }else{
                    echo "<h2 class='text-danger'>Failed to execute statement: " . $stmt->error . "</h2>";
                  }

                  $stmt->close();
                  mysqli_close($conn);
            }
        }
        else
        {
           die("Error - You must supply all book details
                <br><a href=\"new-book.php\"><button class='btn btn-primary my-3'>Return New book</button></a>");
         }
    ?>

    <a href="book-list.php"><button class="btn btn-secondary mt-3">Book list</button></a>
    <a href="new-book.php"><button class="btn btn-secondary mt-3 ms-2">New Book</button></a>
  </div>

    <p class="mx-3 mt-5 text-end" style="font-size:0.8rem;">Created by Wakana Gushi, 2025</p>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
