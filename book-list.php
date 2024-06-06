<!--
Author: Wakana Gushi
Purpose:  Display a list of books based on book type selected in the search page (top-page.php)
Created: 25/04/2024
Last modified: 26/04/2024
-->

<html>
    <head>
        <title>Library system</title>
    <head>
        <body>
        <h1>Library Search Results</h1>
        <?php

            if(!empty($_REQUEST['BookTypeID']))
              {$booktype = $_REQUEST['BookTypeID'];
                setcookie('BookTypeID', $booktype, time()+3600); }

            elseif ( !empty($_COOKIE['BookTypeID']))
                $booktype = $_COOKIE['BookTypeID'];

            else  { die("<a href=\"top-page.php\"><br><br>Select book type</a>");}

            //open the server connection
            require 'dbConnectBooks.php';
            //select table items
            if ($booktype == 'A'){
                $sql = "SELECT * FROM books ORDER BY BookID";}
                else
                {$sql = "SELECT * FROM books WHERE BookTypeID = '$booktype' ORDER BY BookID";}
            $result = mysqli_query($conn, $sql) or die("Error reading books - ".mysqli_error($conn));

            //Display the search criteria
            if ($booktype == 'A'){
                echo "<h2>Search Criteria: Book Type: All </h2>";}
                else
                {echo "<h2>Search Criteria: Book Type: $booktype </h2>";}

            //Display the book list table
            echo "<table border=1>";
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
                echo "<td ><a href=\"edit-book.php?BookID=$row[BookID]\">Edit</a> " .
                "<a href=\"delete-book.php?BookID=$row[BookID]\">Delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";

            $numrows = mysqli_affected_rows($conn);
            if ($numrows == 0)
               echo "<br>No record found. Please add a new book.";


            mysqli_close($conn);

            ?>
            <a href="new-book.php"><br><br>New Book</a>
            <a href="top-page.php"><br><br>Search again</a>
        </body>
</html>
