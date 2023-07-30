<?php

require_once('config/db.php');

$query = "SELECT 
            i.id ,
            i.item_code,
            ic.category AS item_category,
            isc.sub_category AS item_subcategory,
            i.item_name,
            i.quantity,
            i.unit_price
          FROM `item` i
          JOIN `item_category` ic ON i.item_category = ic.id
          JOIN `item_subcategory` isc ON i.item_subcategory = isc.id";

$itemResult = mysqli_query($con, $query);


if (isset($_POST['id'])) {
    $itemId = $_POST['id'];
    $itemDeleteQuery = "DELETE FROM `item` WHERE id = ?";
    $stmt = mysqli_prepare($con, $itemDeleteQuery);
    mysqli_stmt_bind_param($stmt, "i", $itemId);
    $itemDeleteResult = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($itemDeleteResult) {
        echo "success";
    } else {
        echo "error";
    }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ERP System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
  <div class="container-fluid ">
    
    <h2 class="mt-5">Items Details</h2>
    <div class="d-flex justify-content-end">
    <button type="button" class="btn btn-primary mt-3 mb-3" onclick="redirectToAddItem()">
        Add New Item
    </button>

    </div>

    

    <table class="table">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Item Code</th>
            <th scope="col">Item Category</th>
            <th scope="col">Item Subcategory</th>
            <th scope="col">Item Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Options</th>
            </tr>
            
        </thead>
        <tbody>
        <tr>
        <?php
        while ($row = mysqli_fetch_assoc($itemResult)) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['item_code']."</td>";
            echo "<td>".$row['item_category']."</td>";
            echo "<td>".$row['item_subcategory']."</td>";
            echo "<td>".$row['item_name']."</td>";
            echo "<td>".$row['quantity']."</td>";
            echo "<td>".$row['unit_price']."</td>";
          
            echo "<td>";
            echo "<button class='btn btn-primary btn-sm edit-btn' style='margin-right: 10px;' onclick='openUpdateItem(" . $row['id'] . ")'>Edit</button>";
            echo "<button class='btn btn-danger btn-sm delete-btn' data-item-id='".$row['id']."'>Delete</button>";

            echo "</td>";
            echo "</tr>";
            }
        ?>
        </tr>
        </tbody>
    </table>
    </div>
  </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    function redirectToAddItem() {
        window.location.href = 'addItems.php';
    }
    </script>
    <script>
    $(document).on('click', '.delete-btn', function() {
        var itemId = $(this).data('item-id');

        if (confirm('Are you sure you want to delete this customer?')) {
            $.ajax({
                type: 'POST',
                url: 'items.php',
                data: { id: itemId },
                success: function(response) {
                    alert('Customer deleted successfully!');
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while deleting the customer.');
                }
            });
        }
    });
</script>
<script>
    function openUpdateItem(itemId) {
        window.location.href = 'updateItem.php?id=' + itemId;
    }
</script>


  </body>
</html>