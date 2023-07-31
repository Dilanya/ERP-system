
<?php
require_once('config/db.php');

if (isset($_POST['search'])) {
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];

  
  $query = "SELECT i.id, i.date, i.invoice_no, c.first_name, c.last_name, d.district, i.item_count, i.amount
            FROM invoice i
            JOIN customer c ON i.customer = c.id
            JOIN district d ON c.district = d.id
            WHERE i.date BETWEEN '$start_date' AND '$end_date'";
  $result = mysqli_query($con, $query);
} else {
    
    $query = "SELECT i.id, i.date, i.invoice_no, c.first_name, c.last_name, d.district, i.item_count, i.amount
              FROM invoice i
              JOIN customer c ON i.customer = c.id
              JOIN district d ON c.district = d.id";
    $result = mysqli_query($con, $query);
}
?>



<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Invoice Report</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h2 class="mt-5 mb-5">Invoice Report</h2>
    
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
          <th>Date</th>
          <th>Customer</th>
          <th>Customer District</th>
          <th>Item Count</th>
          <th>Invoice Amount</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
          <tr>
            <td><?php echo $row['invoice_no']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
            <td><?php echo $row['district']; ?></td>
            <td><?php echo $row['item_count']; ?></td>
            <td><?php echo $row['amount']; ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
