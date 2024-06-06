<!--
Author: Wakana Gushi
Purpose:  Enter new book data into the database.
Created: 25/04/2024
Last modified: 25/04/2024
-->

<html>
    <head>
        <title>Library system</title>
    </head>
    <body>
        <h1>New Book</h1>
        <form action="insert-book.php" method="POST">
            <label for="ISBN">ISBN:</label>
            <input type="text" id="ISBN" name="ISBN">
            <label for="Author">Author:</label>
            <input type="text" id="Author" name="Author">
            <label for="Title"><br>Title:</label>
            <input type="text" id="Title" name="Title">
            <label for="BookTypeID"><br>Book Type:</label>
            <select id="BookTypeID" name="BookTypeID">
                <option value="">Select BookType</option>
            <?php
            //open the server connection
            require 'dbConnectBooks.php';
            //read through book types
            $sql = "SELECT * FROM booktypes ORDER BY BookType";
            $result = mysqli_query($conn, $sql) or die("Error reading book types - ".mysqli_error($conn));

            while ($row = mysqli_fetch_array($result))
            {
            echo "<option value= \"$row[BookTypeID]\"> $row[BookType]</option>";
            }

            mysqli_close($conn);
            ?>

            </select>
            <label for="Price"><br>Price(S): </label>
            <input type="text" id="Price" name="Price">
            <input type="submit" value="Insert Book">
        </form>
            <a href="book-list.php"><br>Book list</a>


        </body>
</html>
