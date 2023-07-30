<?php

require_once('config/db.php');
$query = "SELECT c.id, c.title, c.first_name, c.middle_name, c.last_name, c.contact_no, d.district AS district_name
          FROM `customer` c
          JOIN `district` d ON c.district = d.id";

$customerResult = mysqli_query($con, $query);

if (isset($_POST['id'])) {
  $customerId = $_POST['id'];
  $customerDeleteQuery = "DELETE FROM `customer` WHERE id = ?";
  $stmt = mysqli_prepare($con, $customerDeleteQuery);
  mysqli_stmt_bind_param($stmt, "i", $customerId);
  $customerDeleteResult = mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  if ($customerDeleteResult) {
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
    
    <h2 class="mt-5">Customer Details</h2>
    <div class="d-flex justify-content-end">
    <button type="button" class="btn btn-primary mt-3 mb-3" onclick="redirectToAddCustomer()">
        Add New Customer
    </button>

    </div>

    

    <table class="table">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">First Name</th>
            <th scope="col">Middle Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Contact No.</th>
            <th scope="col">District</th>
            <th scope="col">Options</th>
            </tr>
            
        </thead>
        <tbody>
        <tr>
            <?php
            while($row = mysqli_fetch_assoc($customerResult)){
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['title']."</td>";
            echo "<td>".$row['first_name']."</td>";
            echo "<td>".$row['middle_name']."</td>";
            echo "<td>".$row['last_name']."</td>";
            echo "<td>".$row['contact_no']."</td>";
            echo "<td>".$row['district_name']."</td>";

            echo "<td>";
            echo "<button class='btn btn-primary btn-sm edit-btn' style='margin-right: 10px;' onclick='openUpdateCustomer(" . $row['id'] . ")'>Edit</button>";
            echo "<button class='btn btn-danger btn-sm delete-btn' data-customer-id='".$row['id']."'>Delete</button>";
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
    function redirectToAddCustomer() {
        window.location.href = 'addCustomer.php';
    }
    </script>
    <script>
    $(document).on('click', '.delete-btn', function() {
        var customerId = $(this).data('customer-id');

        if (confirm('Are you sure you want to delete this customer?')) {
            $.ajax({
                type: 'POST',
                url: 'customer.php',
                data: { id: customerId },
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
    function openUpdateCustomer(customerId) {
        window.location.href = 'updateCustomer.php?id=' + customerId;
    }
</script>


  </body>
</html>