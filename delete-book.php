<!--
Author: Wakana Gushi
Purpose:  Delete a selected book.
Created: 25/04/2024
Last modified: 26/04/2024
--><html>
 <head>
 <title>Library system</title>
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
        $sql = "DELETE FROM books WHERE BookID = '$BookID'";
        //echo "$sql";
        $result = mysqli_query($conn, $sql) or die("Error deleting record - ".mysqli_error($conn));
        $numrows = mysqli_affected_rows($conn);
        if ($numrows == 1)
        echo "<h2>1 book deleted</h2>";
        else
        echo "<h2>delete failed. $numrows were deleted</h2>";
        mysqli_close($conn);
    ?>
        <a href="book-list.php"><br><br>Book List</a>
        <a href="new-book.php"><br><br>New Book</a>
 </body>
</html>
