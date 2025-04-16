<!--
Author: Wakana.G
Purpose: 　Edit book details in the Library database.
Created: 25/04/2024
Last modified: 7/05/2024
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
        <h1>Edit Book</h1>
        <?php
            if(empty($_REQUEST['BookID']))
                die("You need to select a book from the search result");
            $BookID = $_REQUEST['BookID'];

            //open the server connection
            require 'dbConnectBooks.php';

            //get the book record
            $sql = "SELECT * FROM Books WHERE BookID = $BookID";
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
        echo "<label for=ISBN class='form-label mt-2'>ISBN:</label>";
        echo "<input type=text id=ISBN name=ISBN value=\"$ISBN\" class='form-control'>";
        echo "<label for=Author class='form-label'>Author:</label>";
        echo "<input type=text id=Author name=Author value=\"$Author\" class='form-control'>";
        echo "<label for=Title class='form-label'><br>Title:</label>";
        echo "<input type=text id=Title name=Title value=\"$Title\" class='form-control'>";
        echo "<label for=BookTypeID class='form-label'><br>Book Type:</label>";
        echo "<select id=BookTypeID name=BookTypeID class='form-select w-50'>>";
        //echo "<option value=\"$BookTypeID\">$BookTypeID</option>";
            //read through the datatype to write out a drop down list
            $sql = "SELECT * FROM Booktypes ORDER BY BookType";
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
        echo "<label for=Price class='form-label'><br>Price(S): </label>";
        echo "<input type=text id=Price name=Price value=$Price class='form-control'>";
        echo "<button type=submit value=\"Update Book\" class='btn btn-primary mt-2'>Update Book</button>";
        echo "</form>";

        mysqli_close($conn);
        ?>

            <a href="book-list.php"><button class="btn btn-secondary mt-4">Book List</button></a>
            <a href="search-page.php"><button class="btn btn-secondary mt-4 ms-2">Search again</button></a>
            <p class="mx-3 mt-5 text-end" style="font-size:0.8rem;">Created by Wakana Gushi, 2025</p>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        </div>
      </body>
</html>
