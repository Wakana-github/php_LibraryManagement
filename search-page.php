<!--
Author: Wakana.G
Purpose:  Search Books by Book type.
Created: 25/04/2024
Last modified: 2/02/2025
-->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
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
    <h1>Search for books by Book Type:</h1>
   <!--Building the dropdown list-->
    <form action="book-list.php" method="POST">
        <label for="BookTypeID">Book Type:</label>
        <br>
        <select name="BookTypeID" class="form-select w-50 m-3">
        <option value="A">All</option>
        <?php
        //open the server connection
        require 'dbConnectBooks.php';
        //read through book types
        $sql = "SELECT * FROM Booktypes ORDER BY BookType";
        $result = mysqli_query($conn, $sql) or die("Error reading book types - ".mysqli_error($conn));
        if($result){

          while ($row = mysqli_fetch_array($result))
          {
          echo "<option value= \"$row[BookTypeID]\">$row[BookType]</option>";
          }
          echo "</select>";
        }
        mysqli_close($conn);

        ?>
        <div class="mt-2">
          <button type="submit" value="Search" class="btn btn-primary">Search</button>
        </div>
    </form>
  <a href="logout.php"><button class="btn btn-warning mt-3">Log out</button></a>
  <p class="mt-5 text-end" style="font-size:0.8rem;">Created by Wakana Gushi, 2025</p>
  </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
 </body>
</html>
