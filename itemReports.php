<?php

require_once('config/db.php');

$query = "SELECT 
            MIN(i.id) as id,
            i.item_code,
            ic.category AS item_category,
            isc.sub_category AS item_subcategory,
            i.item_name,
            SUM(i.quantity) as quantity,
            AVG(i.unit_price) as unit_price
          FROM `item` i
          JOIN `item_category` ic ON i.item_category = ic.id
          JOIN `item_subcategory` isc ON i.item_subcategory = isc.id
          GROUP BY i.item_name, i.item_code, ic.category, isc.sub_category";


$itemResult = mysqli_query($con, $query);


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
    
    <h2 class="mt-5 mb-5">Items Report</h2>
    <div class="d-flex justify-content-end">
    

    </div>

    

    <table class="table">
        <thead>
            <tr>
            
            <th scope="col">Item Name</th>
            <th scope="col">Item Category</th>
            <th scope="col">Item Subcategory</th>
            <th scope="col">Quantity</th>
            
            </tr>
            
        </thead>
        <tbody>
        <tr>
        <?php
        while ($row = mysqli_fetch_assoc($itemResult)) {
            echo "<tr>";
            echo "<td>".$row['item_name']."</td>";
            echo "<td>".$row['item_category']."</td>";
            echo "<td>".$row['item_subcategory']."</td>";
            echo "<td>".$row['quantity']."</td>";
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

  </body>
</html>