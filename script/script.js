// Add a variable to store the selected book ID
var selectedBookId = null;

$(document).ready(function () {
    $('#bookTable').DataTable();

    // Add an event listener for the "Edit" button
    $('#bookTable tbody').on('click', 'button[onclick^="editBook"]', function () {
        // Extract the book ID from the button's onclick attribute
        selectedBookId = $(this).attr('onclick').match(/'([^']+)'/)[1];

        // Fetch book details and populate the form
        $.ajax({
            type: "POST",
            url: "get_book_details.php", // You need to create this file to fetch book details
            data: { book_id: selectedBookId },
            dataType: 'json', // Expect JSON response
            success: function (response) {
                // Populate the form with the fetched details
                $('#book_id').val(response.idx);
                $('#bookname').val(response.bookname);
                $('#co_id').val(response.co_id);
                $('#publisher_id').val(response.publisher_id);

                // Show the form
                $('#inputForm').show();
            },
            error: function (xhr, status, error) {
                alert("Error: " + error);
            }
        });
    });
});

function editBook(bookId) {
    $.ajax({
        type: "POST",
        url: "get_book_details.php",
        data: { book_id: bookId },
        success: function (response) {
            // Fill the update form with book details
            $('#updateForm').find('[name="book_id"]').val(bookId);
            $('#updateForm').find('[name="update_bookname"]').val(response.bookname);
            $('#updateForm').find('[name="update_co_id"]').val(response.co_id);
            $('#updateForm').find('[name="update_publisher_id"]').val(response.publisher_id);

            // Show the update form
            var updateForm = document.getElementById('updateForm');
            updateForm.style.display = 'block';
        },
        error: function (xhr, status, error) {
            alert("Error: " + error);
        }
    });
}

function deleteBook(bookId) {
    var confirmation = confirm("Are you sure you want to delete this book?");
    if (confirmation) {
        $.ajax({
            type: "POST",
            url: "delete_book.php",
            data: { book_id: bookId },
            success: function (response) {
                alert(response);
                window.location.reload();
            },
            error: function (xhr, status, error) {
                alert("Error: " + error);
            }
        });
    }
}

$(document).on('click', '.showUpdateModalBtn', function() {
    document.getElementById('updateModal').style.display = 'block'
});

document.getElementById('closeUpdateModalBtn').addEventListener('click', function () {
    console.log('Close modal button clicked');
    document.getElementById('updateModal').style.display = 'none';
});

window.addEventListener('click', function (event) {
    if (event.target === document.getElementById('updateModal')) {
        document.getElementById('updateModal').style.display = 'none';
    }
});