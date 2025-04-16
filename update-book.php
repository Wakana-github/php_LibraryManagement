<!--
Author: Wakana.G
Purpose: Validate book details from edit-book.php to update book data
Created: 25/04/2024
Last modified: 26/04/2024
-->
<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Update Book</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
      <div class="m-3">
        <h1>Update Book</h1>
        <?php
        //check input items
         if ((empty($_POST['BookID'])) ||(empty($_POST['ISBN'])) || (empty($_POST['Author']))||(empty($_POST['Title']))||(empty($_POST['BookTypeID']))||(empty($_POST['Price'])))
            die("You must use the edit screen to supply all values for the book<br>
            <a href=\"book-list.php\"><button class='btn btn-primary my-3'>Return Book list</button></a><br>");

            if (!is_numeric($_POST['Price']))
                { die("Error - Price must be numeric
                      <br><a href=\"book-list.php\"><button class='btn btn-primary my-3'>Return Book list</button></a><br>");}

                $BookID = trim($_POST['BookID']);
                $ISBN = trim($_POST['ISBN']);
                $Author = trim($_POST['Author']);
                $Title = trim($_POST['Title']);
                $BookTypeID = trim($_POST['BookTypeID']);
                $Price = trim($_POST['Price']);

                if (!$BookID || !$ISBN || !$Author ||
	                        !$Title || !$BookTypeID || !$Price)
		            die("Some book information has not been supplied");

                //Output posted items
                 //echo "$ISBN, $Author, $Title, $BookTypeID, $Price ";

                //open the server connection
                require 'dbConnectBooks.php';
                //update the record
                $sql = "UPDATE Books SET ISBN='$ISBN', Author='$Author', Title='$Title', BookTypeID='$BookTypeID', Price=$Price
                        WHERE BookID='$BookID'";
                //echo "$sql";
                $result = mysqli_query($conn, $sql) or die("Error updating record ".mysqli_error($conn));
                $numrows = mysqli_affected_rows($conn);
                //check the number of rows affected
                if ($numrows == 1)
                    echo "<h2 class='text-success'>update successful!</h2>";
                else
                    echo "<h2 class='text-danger'>update failed. $numrows were updated</h2>
                        <br><a href=\"book-list.php\"><button class='btn btn-primary my-3'>Return Book list</button></a>";
                mysqli_close($conn);
            ?>
            <br>
            <a href="book-list.php"><button class="btn btn-secondary mt-4">Book List</button></a>
            <a href="new-book.php"><button class="btn btn-secondary mt-4 ms-2">New Book</button></a>
          </div>
          <p class="mx-3 mt-5 text-end" style="font-size:0.8rem;">Created by Wakana Gushi, 2025</p>

          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
