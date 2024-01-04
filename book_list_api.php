<?php
include 'db_connect.php';

$sql = "SELECT tbl_book.idx, tbl_book.book_uniq_idx, tbl_book.bookname, content_owner.name AS content_owner, publisher.name AS publisher, tbl_book.created_timetick FROM tbl_book
        INNER JOIN content_owner ON tbl_book.co_id = content_owner.idx
        INNER JOIN publisher ON tbl_book.publisher_id = publisher.idx";

$result = $conn->query($sql);

$bookList = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookList[] = array(
            'idx' => $row['book_uniq_idx'],
            'bookname' => $row['bookname'],
            'content_owner' => $row['content_owner'],
            'publisher' => $row['publisher'],
            'created_timetick' => $row['created_timetick']
        );
    }
}

header('Content-Type: application/json');
echo json_encode($bookList);

$conn->close();
?>
