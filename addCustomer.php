<?php

require_once('config/db.php');



$district_query = "SELECT id, district FROM `district`";
$districtResult = mysqli_query($con, $district_query);

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $firstName = $_POST['first_name'];
    $middleName = $_POST['middle_name'];
    $lastName = $_POST['last_name'];
    $contactNo = $_POST['contact_no'];
    $district = $_POST['district'];

    $query = "INSERT INTO `customer` (title, first_name, middle_name, last_name, contact_no, district) VALUES ('$title', '$firstName', '$middleName', '$lastName', '$contactNo', '$district')";

    $result = mysqli_query($con, $query);
    
    if ($result) {
        echo "<script>alert('Customer added successfully!');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Customer added failed!');</script>";
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
            <h1>Add New Customer</h1>
        </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                    <form  method="POST" class="needs-validation" >
                    <div class="mb-2 col-12">
                        <label for="title" class="form-label">Title</label>
                        <select class="form-select" name="title" id="title">
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Miss">Miss</option>
                            <option value="Dr">Dr</option>
                        </select>
                    </div>
                    <div class='row'>
                    <div class="mb-2 col-lg-6">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control " name="first_name" id="first_name" placeholder="First Name" required>
                        
                    </div>
                    <div class="mb-2 col-lg-6">
                        <label for="middle_name" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder="Middle Name" required>
                    </div>
                    </div>
                    <div class='row'>
                    <div class="mb-2 col-lg-6">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" required>
                    </div>
                    <div class="mb-2 col-lg-6">
                    <label for="contact_no" class="form-label">Contact No</label>
                    <input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="Contact No" pattern="[0-9]{10}" required>
                    <div class="invalid-feedback">
                        Contact number must be exactly 10 digits.
                    </div>
                    </div>

                    </div>
                    <div class="mb-3 col-12">
                        <label for="district" class="form-label">District</label>
                        <select class="form-select" name="district" id="district" required>
                            <?php
                            while ($row = mysqli_fetch_assoc($districtResult)) {
                                $districtId = $row['id'];
                                $districtName = $row['district'];
                                echo "<option value='$districtId'>$districtName</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary col-12 mb-3" name="submit">Submit</button>
                    <button type="cancel" class="btn btn-secondary col-12 mb-3" name="cancel" onclick="confirmCancel()">Cancel</button>
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