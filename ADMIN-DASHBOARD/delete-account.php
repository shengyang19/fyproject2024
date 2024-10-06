<?php
// Database connection parameters
$host = 'localhost';
$db = 'phmsdb';
$user = 'root'; // Change if your username is different
$pass = '';     // Change if your password is different

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Handle the delete action
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $category = $_GET['category'];
    if($category=="customer")
        $stmt = $pdo->prepare("DELETE FROM account WHERE customer_id = ?");
    else
        $stmt = $pdo->prepare("DELETE FROM staff_account WHERE staff_id = ?");
    $stmt->execute([$id]);
    header("Location: $category.php"); // Redirect to avoid resubmission
    exit;
}

// // Fetch names from the database
// $stmt = $pdo->query("SELECT * FROM account");
// $names = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name List</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Name List</h1>
        <ul class="list-group">
            <?php foreach ($names as $name): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo htmlspecialchars($name['username']); ?>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDelete" data-id="<?php echo $name['customer_id']; ?>">
                        Delete
                    </button>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this name?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="delete-customer.php" id="deleteForm" method="GET" style="display: inline;">
                        <input type="hidden" name="delete" id="deleteId">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Set the ID of the name to delete in the modal
        $('#confirmDelete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id'); // Extract info from data-* attributes
            var modal = $(this);
            modal.find('#deleteId').val(id); // Set the value of the hidden input
        });
    </script>
</body>
</html>