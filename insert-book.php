<!--
Author: Wakana Gushi
Purpose: Validate new book input from new-book.php
Created: 25/04/2024
Last modified: 26/04/2024
-->

<html>
    <head>
        <title>Library system</title>
    </head>
    <body>
        <h1>Insert Book</h1>
        <?php
        //check input items
         if ((!empty($_REQUEST['ISBN'])) && (!empty($_REQUEST['Author']))&&(!empty($_REQUEST['Title']))&&(!empty($_REQUEST['BookTypeID']))&&(!empty($_REQUEST['Price'])))
           {

            if (!is_numeric($_REQUEST['Price']))
                { echo "<a href=\"new-book.php\">Return New book<br><br></a>";
                  die("Error - Price must be numeric");
                }


            else{


                $ISBN = $_REQUEST['ISBN'];
                $Author = $_REQUEST['Author'];
                $Title = $_REQUEST['Title'];
                $BookTypeID = $_REQUEST['BookTypeID'];
                $Price = $_REQUEST['Price'];

            //Output posted items
            // echo "$ISBN, $Author, $Title, $BookTypeID, $Price ";


                //open the server connection
                require 'dbConnectBooks.php';
                //insert data in the database
                $sql = "INSERT INTO books(ISBN, Author, Title, BookTypeID, Price) values('$ISBN', '$Author',  '$Title', '$BookTypeID', '$Price')";
                $result = mysqli_query($conn, $sql) or die("Error inserting a book - ".mysqli_error($conn));

                //check the number of rows affected
                $numrows = mysqli_affected_rows($conn);
                if ($numrows == 1)
                echo "<h1>1 book added successfully</h1>";
                else
                echo "<h1>book add failed. $numrows were updated</h1>";
                }
            }
        else
        {
           echo "<a href=\"new-book.php\">Return New book<br><br></a>";
           die("Error - You must supply all book details");
         }
    ?>

        <a href="book-list.php"><br><br>Book list</a>
        <a href="new-book.php"><br><br>New Book</a>
    </body>
</html>
