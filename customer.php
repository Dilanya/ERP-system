<?php

require_once('config/db.php');
$query = "SELECT c.id, c.title, c.first_name, c.middle_name, c.last_name, c.contact_no, d.district AS district_name
          FROM `customer` c
          JOIN `district` d ON c.district = d.id";

$customerResult = mysqli_query($con, $query);
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
    <button type="button" class="btn btn-primary mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#customerModal">
        Create New Customer
    </button>
    </div>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customerModalLabel">Add New Customer Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="customerFormContent"></div> 
                </div>
            </div>
        </div>
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
            echo "<button class='btn btn-primary btn-sm edit-btn' style='margin-right: 10px;' data-customer-id='".$row['id']."'>Edit</button>";
            echo "<button class='btn btn-danger btn-sm delete-btn ' data-customer-id='".$row['id']."'>Delete</button>";
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
  <script>
    function loadCustomerForm() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("customerFormContent").innerHTML = xhr.responseText;
            }
        };
        xhr.open("GET", "addCustomer.php", true);
        xhr.send();
    }

    document.getElementById("customerModal").addEventListener("show.bs.modal", loadCustomerForm);
  </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>