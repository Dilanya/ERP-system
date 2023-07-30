<?php

require_once('config/db.php');



$district_query = "SELECT id, district FROM `district`";
$districtResult = mysqli_query($con, $district_query);

if (isset($_GET['id'])) {
    $itemId = $_GET['id'];
    $itemQuery = "SELECT * FROM `item` WHERE id = ?";
    $stmt = mysqli_prepare($con, $itemQuery);
    mysqli_stmt_bind_param($stmt, 'i', $itemId);
    mysqli_stmt_execute($stmt);
    $itemResult = mysqli_stmt_get_result($stmt);
    $itemData = mysqli_fetch_assoc($itemResult);

    $itemCode = $itemData['item_code'];
    $itemCategory = $itemData['item_category'];
    $itemSubcategory = $itemData['item_subcategory'];
    $itemName = $itemData['item_name'];
    $quantity = $itemData['quantity'];
    $unitPrice = $itemData['unit_price'];
}

if (isset($_POST['submit'])) {
    $itemCode = $_POST['item_code'];
    $itemCategory = $_POST['item_category'];
    $itemSubcategory = $_POST['item_subcategory'];
    $itemName = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $unitPrice = $_POST['unit_price'];

    $updateQuery = "UPDATE `item` SET item_code = ?, item_category = ?, item_subcategory = ?, item_name = ?, quantity = ?, unit_price = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $updateQuery);
    mysqli_stmt_bind_param($stmt, 'ssssidi', $itemCode, $itemCategory, $itemSubcategory, $itemName, $quantity, $unitPrice, $itemId);
    $updateResult = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($updateResult) {
        echo "<script>alert('Item updated successfully!');</script>";
        echo "<script>window.location.href = 'index.php?section=items';</script>";
    } else {
        echo "<script>alert('Item update failed!');</script>";
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
    
    <div class="container-fluid bg-dark d-flex align-items-center justify-content-center" style="height: 100vh;">  
        <div class="card col-lg-4 bg-light mt-5 mb-5">
        <div class="bg-secondary text-center  text-white">
            <h1>Edit Item Details</h1>
        </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                    <form method="POST">
                <div class="row">
                <div class="mb-2 col-lg-6 col-12">
                    <label for="item_code" class="form-label">Item Code</label>
                    <input type="text" class="form-control" name="item_code" id="item_code" value="<?php echo $itemCode; ?>" placeholder="Item Code" required>
                </div>
                <div class="mb-2 col-lg-6 col-12">
                    <label for="item_name" class="form-label">Item Name</label>
                    <input type="text" class="form-control" name="item_name" id="item_name" value="<?php echo $itemName; ?> " placeholder="Item Name" required>
                </div>
                </div>
                <div class="row">
                <div class="mb-2 col-lg-6 col-12">
                    <label for="item_category" class="form-label">Item Category</label>
                    <select class="form-select" name="item_category" id="item_category">
                        
                        <?php
                        $category_query = "SELECT id, category FROM `item_category`";
                        $categoryResult = mysqli_query($con, $category_query);
                        while ($row = mysqli_fetch_assoc($categoryResult)) {
                            $categoryId = $row['id'];
                            $categoryName = $row['category'];
                            echo "<option value='$categoryId'";
                            if ($itemCategory == $categoryId) echo ' selected';
                            echo ">$categoryName</option>";
                        }
                        ?>
                    </select>

                    
                    
                </div>
                <div class="mb-2 col-lg-6 col-12">
                    <label for="item_subcategory" class="form-label">Item Subcategory</label>
                    <select class="form-select" name="item_subcategory" id="item_subcategory" required>
                        
                        <?php
                        $subcategory_query = "SELECT id, sub_category FROM `item_subcategory`";
                        $subcategoryResult = mysqli_query($con, $subcategory_query);
                        while ($row = mysqli_fetch_assoc($subcategoryResult)) {
                            $subcategoryId = $row['id'];
                            $subcategoryName = $row['sub_category'];
                            echo "<option value='$subcategoryId'";
                            if ($itemSubcategory == $subcategoryId) echo ' selected';
                            echo ">$subcategoryName</option>";
                        }
                        ?>
                    </select>
                </div>
                    </div>
                <div class="row">
                <div class="mb-3 col-lg-6 col-12">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="text" class="form-control" name="quantity" id="quantity" value="<?php echo $quantity; ?> " required>
                </div>
                <div class="mb-3 col-lg-6 col-12">
                    <label for="unit_price" class="form-label">Unit Price</label>
                    <input type="text" class="form-control" name="unit_price" id="unit_price" value="<?php echo $unitPrice; ?> "  required>
                </div>
                </div>
                <button type="submit" class="btn btn-primary col-12 mb-3" name="submit">Add Item</button>
                <button type="button" class="btn btn-secondary col-12 mb-3" onclick="confirmCancel()">Cancel</button>
                    
            </form>
        </div>
    </div>
</div>
</div>
</div>
    <script>
            function confirmCancel() {
                if (confirm("Are you sure you want to cancel?")) {
                    window.history.back(); 
                }
            }
    </script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </body>
</html>