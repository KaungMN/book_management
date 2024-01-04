<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookId = $_POST['book_id'];
    $bookname = mysqli_real_escape_string($conn, $_POST['update_bookname']);
    $co_id = (int)$_POST['update_co_id'];
    $publisher_id = (int)$_POST['update_publisher_id'];

    $sql = "UPDATE tbl_book SET bookname=?, co_id=?, publisher_id=? WHERE idx=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siii", $bookname, $co_id, $publisher_id, $bookId);

    if ($stmt->execute()) {
        echo "Book updated successfully <a href='index.php'>Go back to Book List</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
