<!--
Author: Wakana Gushi
Purpose: 　Edit book details in the Library database.
Created: 25/04/2024
Last modified: 7/05/2024
-->

<html>
    <head>
        <title>Library system</title>
    </head>
    <body>
        <h1>Edit Book</h1>
        <?php
            if(empty($_REQUEST['BookID']))
                die("You need to select a book from the search result");
            $BookID = $_REQUEST['BookID'];

            //open the server connection
            require 'dbConnectBooks.php';

            //get the book record
            $sql = "SELECT * FROM books WHERE BookID = $BookID";
            $result = mysqli_query($conn, $sql) or die("Error reading book types - ".mysqli_error($conn));
            if (mysqli_affected_rows($conn) == 0)
	            die("Error – record not found to edit");
            while ($row = mysqli_fetch_array($result))
                {
                    $ISBN = $row['ISBN'];
                    $Author = $row['Author'];
                    $Title = $row['Title'];
                    $BookTypeID = $row['BookTypeID'];
                    $Price = $row['Price'];
                }


        echo "<form action=update-book.php method=POST>";
        echo "<input type=hidden name=BookID value=\"$BookID\">";
        echo "<label for=ISBN >ISBN:</label>";
        echo "<input type=text id=ISBN name=ISBN value=\"$ISBN\">";
        echo "<label for=Author>Author:</label>";
        echo "<input type=text id=Author name=Author value=\"$Author\">";
        echo "<label for=Title><br>Title:</label>";
        echo "<input type=text id=Title name=Title value=\"$Title\">";
        echo "<label for=BookTypeID><br>Book Type:</label>";
        echo "<select id=BookTypeID name=BookTypeID>";
        //echo "<option value=\"$BookTypeID\">$BookTypeID</option>";
            //read through the datatype to write out a drop down list
            $sql = "SELECT * FROM booktypes ORDER BY BookType";
            $result = mysqli_query($conn, $sql) or die("Error reading book types - ".mysqli_error($conn));
            while ($row = mysqli_fetch_array($result)){
              if($BookTypeID==$row['BookTypeID']){
                echo "<option value= \"$row[BookTypeID]\" selected> $row[BookType]</option>";
              }
              else
                {
                  echo "<option value= \"$row[BookTypeID]\"> $row[BookType]</option>";
                }
              }

        echo "</select>";
        echo "<label for=Price><br>Price(S): </label>";
        echo "<input type=text id=Price name=Price value=$Price>";
        echo "<br><br><input type=submit value=\"Update Book\">";
        echo "</form>";

        mysqli_close($conn);
        ?>

            <a href="book-list.php"><br>Book List</a>
            <a href="top-page.php"><br><br>Search again</a>


        </body>
</html>
