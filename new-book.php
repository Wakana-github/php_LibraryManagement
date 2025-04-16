<!--
Author: Wakana.G
Purpose:  Enter new book data into the database.
Created: 25/04/2024
Last modified: 25/04/2024
-->
<?php
  //create new token
  session_start();
  if (empty($_SESSION['token'])) {
      $_SESSION['token'] = bin2hex(random_bytes(32));
  }
?>
<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Library system</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
      <div class="mx-3">
        <h1>New Book</h1>
        <form action="insert-book.php" method="POST">
            <input type="hidden" class="form-control" name="token" value="<?php echo $_SESSION['token']; ?>">
            <label for="ISBN" class="form-label mt-2">ISBN:</label>
            <input type="text" class="form-control" id="ISBN" name="ISBN">
            <label for="Author" class="form-label">Author:</label>
            <input type="text" id="Author" name="Author" class="form-control">
            <label for="Title" class="form-label"><br>Title:</label>
            <input type="text" id="Title" name="Title" class="form-control">
            <label for="BookTypeID" class="form-label"><br>Book Type:</label>
            <select id="BookTypeID" name="BookTypeID" class="form-select w-50">
                <option value="">Select BookType</option>
            <?php
            //open the server connection
            require 'dbConnectBooks.php';
            //read through book types
            $sql = "SELECT * FROM Booktypes ORDER BY BookType";
            $result = mysqli_query($conn, $sql) or die("Error reading book types - ".mysqli_error($conn));

            while ($row = mysqli_fetch_array($result))
            {
            echo "<option value= \"$row[BookTypeID]\"> $row[BookType]</option>";
            }

            mysqli_close($conn);
            ?>

            </select>
            <label for="Price" class="form-label"><br>Price(S): </label>
            <input type="text" id="Price" name="Price" class="form-control">
            <button type="submit" value="Insert Book" class="btn btn-primary mt-2">Insert Book</button>
        </form>
            <a href="book-list.php"><button class="btn btn-secondary mt-5">Book list</button></a>
      </div>

      <p class="mx-3 mt-5 text-end" style="font-size:0.8rem;">Created by Wakana Gushi, 2025</p>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
