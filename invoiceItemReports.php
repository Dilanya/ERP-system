
<?php
require_once('config/db.php');

if (isset($_POST['search'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
  
    
    $query = "SELECT i.invoice_no AS invoiced_no,
    i.date AS invoiced_date,
    c.first_name ,
    c.last_name ,
    it.item_code,
    it.item_name,
    ic.category,
    im.unit_price
    FROM invoice i
    JOIN invoice_master im ON i.invoice_no = im.invoice_no
    JOIN customer c ON i.customer = c.id
    JOIN item it ON im.item_id = it.id
    JOIN item_category ic  ON it.item_category = ic.id
    WHERE i.date BETWEEN '$start_date' AND '$end_date';";
      $result = mysqli_query($con, $query);
  } else {
    
    $query =  "SELECT i.invoice_no AS invoiced_no,
    i.date AS invoiced_date,
    c.first_name ,
    c.last_name ,
    it.item_code,
    it.item_name,
    ic.category,
    im.unit_price
    FROM invoice i
    JOIN invoice_master im ON i.invoice_no = im.invoice_no
    JOIN customer c ON i.customer = c.id
    JOIN item it ON im.item_id = it.id
    JOIN item_category ic  ON it.item_category = ic.id";
    $result = mysqli_query($con, $query);
}
  ?>



<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    </head>
<body>
  <div class="container">
    <h2 class="mt-5 mb-5">Invoice Item Report</h2>
    
    <form class=" mb-5" method="POST">
    <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" id="start_date" required>

    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" id="end_date" required>

    <button type="submit" class='btn btn-primary' name="search">Search</button>
    </form>

    <table class="table">
      <thead>
        <tr>
            <th>Invoice Number</th>
            <th>Invoiced Date</th>
            <th>Customer Name</th>
            <th>Item Name</th>
            <th>Item Code</th>
            <th>Item Category</th>
            <th>Item Unit Price</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?php echo $row['invoiced_no']; ?></td>
            <td><?php echo $row['invoiced_date']; ?></td>
            <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
            <td><?php echo $row['item_name']; ?></td>
            <td><?php echo $row['item_code']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['unit_price']; ?></td>
       
        <?php endwhile; ?>
      </tbody>
    </table>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>