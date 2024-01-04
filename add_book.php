<?php
include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Book</title>
    <link rel="stylesheet" type="text/css" href="style/add_book.css">
</head>

<body>
    <form id="inputForm" action="process_book.php" method="post">
        <h2>Add Book</h2>
        <label for="bookname">Book Name:</label>
        <input type="text" name="bookname" required><br>
        <label for="co_id">Content Owner:</label>
        <select name="co_id" required>
            <?php
            $sqlContentOwners = "SELECT * FROM content_owner";
            $resultContentOwners = $conn->query($sqlContentOwners);

            if ($resultContentOwners->num_rows > 0) {
                while ($row = $resultContentOwners->fetch_assoc()) {
                    echo "<option value='" . $row['idx'] . "'>" . $row['name'] . "</option>";
                }
            }
            ?>
        </select><br>
        <label for="publisher_id">Publisher:</label>
        <select name="publisher_id" required>
            <?php
            $sqlPublishers = "SELECT * FROM publisher";
            $resultPublishers = $conn->query($sqlPublishers);

            if ($resultPublishers->num_rows > 0) {
                while ($row = $resultPublishers->fetch_assoc()) {
                    echo "<option value='" . $row['idx'] . "'>" . $row['name'] . "</option>";
                }
            }
            ?>
        </select><br>
        <div class="buttonHolder">
            <button type="submit">Add Book</button>
            <br />
            <a id="index-link" href="index.php">Back to Book List</a>
        </div>

    </form>
</body>

</html>