<!--
Author: Wakana.G
Purpose:  Delete a selected book.
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
 <h1>Delete Book</h1>
    <?php
        if (empty($_REQUEST['BookID']))
        die("You must select a book to delete");
        $BookID = $_REQUEST['BookID'];
        //open the server connection
        require 'dbConnectBooks.php';
        //delete the book
        $sql = "DELETE FROM Books WHERE BookID = '$BookID'";
        //echo "$sql";
        $result = mysqli_query($conn, $sql) or die("Error deleting record - ".mysqli_error($conn));
        $numrows = mysqli_affected_rows($conn);
        if ($numrows == 1)
        echo "<h2 class='text-success'>1 book deleted</h2>";
        else
        echo "<h2 class='text-danger'>delete failed. $numrows were deleted</h2>";
        mysqli_close($conn);
    ?>
    <a href="book-list.php"><button class="btn btn-secondary mt-3">Book List</button></a>
    <a href="new-book.php"><button class="btn btn-secondary mt-3 ms-2">New Book</button></a>

    <p class="mx-3 mt-5 text-end" style="font-size:0.8rem;">Created by Wakana Gushi, 2025</p>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
 </body>
</html>
