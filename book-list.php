<!--
Author: Wakana.G
Purpose:  Display a list of books based on book type selected in the search page (search-page.php)
Created: 25/04/2024
Last modified: 26/04/2024
-->
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
          <h1>Library Search Results</h1>
          <?php

              if(!empty($_POST['BookTypeID']))
                {$booktype = $_POST['BookTypeID'];
                  setcookie('BookTypeID', $booktype, time()+3600); }

              elseif ( !empty($_COOKIE['BookTypeID']))
                  $booktype = $_COOKIE['BookTypeID'];

              else  { die("<a href=\"search-page.php\"><br><br>Select book type</a>");}

              //open the server connection
              require 'dbConnectBooks.php';
              //select table items
              if ($booktype == 'A'){
                  $sql = "SELECT * FROM Books ORDER BY BookID";}
                  else
                  {$sql = "SELECT * FROM Books WHERE BookTypeID = '$booktype' ORDER BY BookID";}
              $result = mysqli_query($conn, $sql) or die("Error reading books - ".mysqli_error($conn));

              //Display the search criteria
              if ($booktype == 'A'){
                  echo "<h2>Search Criteria: Book Type: All </h2>";}
                  else
                  {echo "<h2>Search Criteria: Book Type: $booktype </h2>";}

              //Display the book list table
              echo "<table border=1 class='table table-sm'>";
              echo "<tr><td>BookID</td><td>ISBN</td><td>Title</td><td>Author</td><td>BookTypeID</td><td>Price</td><td>Action</td></tr>";

              while ($row = mysqli_fetch_array($result))
              {
                  echo "<tr>";
                  echo "<td>$row[BookID]</td>";
                  echo "<td>$row[ISBN]</td>";
                  echo "<td>$row[Title]</td>";
                  echo "<td>$row[Author]</td>";
                  echo "<td>$row[BookTypeID]</td>";
                  echo "<td>$$row[Price]</td>";
                  echo "<td ><a href=\"edit-book.php?BookID=$row[BookID]\"><button class='btn btn-primary btn-sm'>Edit</button></a> " .
                  "<a href=\"delete-book.php?BookID=$row[BookID]\"><button class='btn btn-primary btn-sm m-1'>Delete</button></a></td>";
                  echo "</tr>";
              }
              echo "</table>";

              $numrows = mysqli_affected_rows($conn);
              if ($numrows == 0)
                 echo "<br>No record found. Please add a new book.";


              mysqli_close($conn);

            ?>
            <a href="new-book.php"><button class="btn btn-secondary mt-3">New Book</button></a>
            <a href="search-page.php"><button class="btn btn-secondary mt-3 ms-2">Search again</button></a>
            <br><a href="logout.php"><button class="btn btn-warning mt-3">Log out</button></a>

            <p class="mx-3 mt-5 text-end" style="font-size:0.8rem;">Created by Wakana Gushi, 2025</p>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
          </div>
        </body>
</html>
