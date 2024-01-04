<?php
include 'db_connect.php';

$sql = "SELECT tbl_book.idx, tbl_book.book_uniq_idx, tbl_book.bookname, content_owner.name AS content_owner, publisher.name AS publisher, tbl_book.created_timetick FROM tbl_book
        INNER JOIN content_owner ON tbl_book.co_id = content_owner.idx
        INNER JOIN publisher ON tbl_book.publisher_id = publisher.idx";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Book List</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="style/update_modal.css">
    <link rel="stylesheet" type="text/css" href="style/booklist.css">

</head>

<body>
    <table id="bookTable">
        <thead>
            <tr>
                <th>Idx</th>
                <th>Book Name</th>
                <th>Content Owner</th>
                <th>Publisher</th>
                <th>Created Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["book_uniq_idx"] . "</td>";
                    echo "<td>" . $row["bookname"] . "</td>";
                    echo "<td>" . $row["content_owner"] . "</td>";
                    echo "<td>" . $row["publisher"] . "</td>";
                    echo "<td>" . $row["created_timetick"] . "</td>";
                    echo '<td><button class="showUpdateModalBtn booklist-button" onclick="editBook(\'' . $row["idx"] . '\')">Edit</button>';
                    echo '<button class="booklist-button" onclick="deleteBook(\'' . $row["idx"] . '\')">Delete</button></td>';
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <button class="booklist-button"><a style="text-decoration:none;color:white"
            href="http://localhost/book_management/add_book.php">Add new book</a></button>

    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeUpdateModalBtn">&times;</span>
            <form id="updateForm" style="display: none;" action="update_book.php" method="post">
                <input type="hidden" name="book_id">
                <label for="update_bookname">Book Name:</label>
                <input type="text" name="update_bookname" required><br>


                <label for="update_co_id">Content Owner:</label>
                <select name="update_co_id" required>
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
                <label for="update_publisher_id">Publisher:</label>
                <select name="update_publisher_id" required>
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
                <button type="submit">Update Book</button>
            </form>
        </div>
    </div>

    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="script/script.js"></script>
</body>

</html>