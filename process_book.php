<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $bookname = mysqli_real_escape_string($conn, $_POST['bookname']);
    $co_id = (int) $_POST['co_id'];
    $publisher_id = (int) $_POST['publisher_id'];


    $sqlMaxIdx = "SELECT MAX(idx) FROM tbl_book";
    $result = $conn->query($sqlMaxIdx);

    if ($result && $row = $result->fetch_assoc()) {

        $maxIdx = (int) $row['MAX(idx)'];
        $book_uniq_idx = "BOK" . sprintf("%04d", $maxIdx + 1);
    } else {

        $book_uniq_idx = "BOK0001";
    }


    $sql = "INSERT INTO tbl_book (co_id, publisher_id, book_uniq_idx, bookname) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $co_id, $publisher_id, $book_uniq_idx, $bookname);

    if ($stmt->execute()) {
        echo "New book created successfully <a href='index.php'>Go back to Book List</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>