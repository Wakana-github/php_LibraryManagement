<!--
Author: Wakana Gushi
Purpose: Validate book details from edit-book.php to update book data
Created: 25/04/2024
Last modified: 26/04/2024
-->
<html>
    <head>
        <title>Library system</title>
    </head>
    <body>
        <h1>Update Book</h1>
        <?php
        //check input items
         if ((empty($_REQUEST['BookID'])) ||(empty($_REQUEST['ISBN'])) || (empty($_REQUEST['Author']))||(empty($_REQUEST['Title']))||(empty($_REQUEST['BookTypeID']))||(empty($_REQUEST['Price'])))
            die("You must use the edit screen to supply all values for the book");

            if (!is_numeric($_REQUEST['Price']))
                { die("Error - Price must be numeric");}

                $BookID = trim($_REQUEST['BookID']);
                $ISBN = trim($_REQUEST['ISBN']);
                $Author = trim($_REQUEST['Author']);
                $Title = trim($_REQUEST['Title']);
                $BookTypeID = trim($_REQUEST['BookTypeID']);
                $Price = trim($_REQUEST['Price']);

                if (!$BookID || !$ISBN || !$Author ||
	                        !$Title || !$BookTypeID || !$Price)
		            die("Some book information has not been supplied");

                //Output posted items
                 //echo "$ISBN, $Author, $Title, $BookTypeID, $Price ";

                //open the server connection
                require 'dbConnectBooks.php';
                //update the record
                $sql = "UPDATE books SET ISBN='$ISBN', Author='$Author', Title='$Title', BookTypeID='$BookTypeID', Price=$Price
                        WHERE BookID='$BookID'";
                //echo "$sql";
                $result = mysqli_query($conn, $sql) or die("Error updating record ".mysqli_error($conn));
                $numrows = mysqli_affected_rows($conn);
                //check the number of rows affected
                if ($numrows == 1)
                    echo "update successful!";
                else
                    echo "update failed. $numrows were updated";
                mysqli_close($conn);
            ?>

            <a href="book-list.php"><br><br>Book List</a>
            <a href="new-book.php"><br><br>New Book</a>
    </body>
</html>
