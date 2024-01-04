<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book_id'])) {
    $bookId = $_POST['book_id'];

    $sqlDelete = "DELETE FROM tbl_book WHERE idx = ?";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bind_param("s", $bookId);

    if ($stmtDelete->execute()) {
        echo "Book deleted successfully";
        $sqlResetAutoIncrement = "ALTER TABLE tbl_book AUTO_INCREMENT = 1";
        $conn->query($sqlResetAutoIncrement);
    } else {
        echo "Error: " . $stmtDelete->error;
    }

    $stmtDelete->close();
}

$conn->close();
?>
