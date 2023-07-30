<?php
require_once('config/db.php');


if (isset($_POST['submit'])) {
    $itemCode = $_POST['item_code'];
    $itemCategoryId = $_POST['item_category'];
    $itemSubcategoryId = $_POST['item_subcategory'];
    $itemName = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $unitPrice = $_POST['unit_price'];

   
    $query = "INSERT INTO `item` (item_code, item_category, item_subcategory, item_name, quantity, unit_price) VALUES ('$itemCode', ?, ?, '$itemName', '$quantity', '$unitPrice')";

    $stmt = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($stmt, 'ii', $itemCategoryId, $itemSubcategoryId);

    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "<script>alert('Item added successfully!');</script>";
        echo "<script>window.location.href = 'index.php?section=items';</script>";
    } else {
        echo "<script>alert('Failed to add item!');</script>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>

<div class="container-fluid bg-dark d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card col-lg-6 bg-light mt-5 mb-5">
        <div class="bg-secondary text-center text-white">
            <h1>Add Item</h1>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="row">
                <div class="mb-2 col-lg-6 col-12">
                    <label for="item_code" class="form-label">Item Code</label>
                    <input type="text" class="form-control" name="item_code" id="item_code" placeholder="Item Code" required>
                </div>
                <div class="mb-2 col-lg-6 col-12">
                    <label for="item_name" class="form-label">Item Name</label>
                    <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Item Name" required>
                </div>
                </div>
                <div class="row">
                <div class="mb-2 col-lg-6 col-12">
                    <label for="item_category" class="form-label">Item Category</label>
                    <select class="form-select" name="item_category" id="item_category">
                        <option value="">Select Category</option>
                        <?php
                        $category_query = "SELECT id, category FROM `item_category`";
                        $categoryResult = mysqli_query($con, $category_query);
                        while ($row = mysqli_fetch_assoc($categoryResult)) {
                            $itemCategoryId = $row['id'];
                            $itemCategoryName = $row['category'];
                            echo "<option value='$itemCategoryId'>$itemCategoryName</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-2 col-lg-6 col-12">
                    <label for="item_subcategory" class="form-label">Item Subcategory</label>
                    <select class="form-select" name="item_subcategory" id="item_subcategory" required>
                        <option value="">Select Subcategory</option>
                        <?php
                        $subcategory_query = "SELECT id, sub_category FROM `item_subcategory`";
                        $subcategoryResult = mysqli_query($con, $subcategory_query);
                        while ($row = mysqli_fetch_assoc($subcategoryResult)) {
                            $subcategoryId = $row['id'];
                            $subcategoryName = $row['sub_category'];
                            echo "<option value='$subcategoryId'>$subcategoryName</option>";
                        }
                        ?>
                    </select>
                </div>
                    </div>
                <div class="row">
                <div class="mb-3 col-lg-6 col-12">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" name="quantity" id="quantity" required>
                </div>
                <div class="mb-3 col-lg-6 col-12">
                    <label for="unit_price" class="form-label">Unit Price</label>
                    <input type="text" class="form-control" name="unit_price" id="unit_price" required>
                </div>
                </div>
                <button type="submit" class="btn btn-primary col-12 mb-3" name="submit">Add Item</button>
                <button type="button" class="btn btn-secondary col-12 mb-3" onclick="confirmCancel()">Cancel</button>
                    
            </form>
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
