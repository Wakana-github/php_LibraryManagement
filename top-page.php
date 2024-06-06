<!--
Author: Wakana Gushi
Purpose:  Search Books by Book type.
Created: 25/04/2024
Last modified: 26/04/2024
-->


<html>
 <head>
 <title>Library system</title>
 <head>
 <body>
    <h1>Search for books by Book Type:</h1>
   <!--Building the dropdown list-->
    <form action="book-list.php" method="POST">
        <label for="BookTypeID">Book Type:</label>
        <br>
        <select name="BookTypeID">
        <option value="A">All</option>
        <?php
        //open the server connection
        require 'dbConnectBooks.php';
        //read through book types
        $sql = "SELECT * FROM booktypes ORDER BY BookType";
        $result = mysqli_query($conn, $sql) or die("Error reading book types - ".mysqli_error($conn));
        if($result)

        while ($row = mysqli_fetch_array($result))
        {
        echo "<option value= \"$row[BookTypeID]\">$row[BookType]</option>";
        }
        echo "</select>";
        mysqli_close($conn);

        ?>

        <input type="submit" value="Search">
    </form>

 </body>
</html>
