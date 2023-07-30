<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP System</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid d-flex justify-content-center">
        <h1 class="text-white " >ERP System</h1>  
      </div>
    </nav>
    <div class="container-fluid" >
      <div class="row">

        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar" style="height: 100vh">
          <div class="mt-5">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link text-white" href="?section=customers">Customers</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="?section=items">Items</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link  text-white">Reports</a>
                <ul class="nav flex-column" style="padding-left:20px;" >
                  <li><a class="nav-link  text-white" href="?section=invoiceReport">Invoice Report</a></li>
                  <li><a class="nav-link  text-white" href="?section=invoiceItemReport">Invoice Item Report</a></li>
                  <li><a class="nav-link  text-white" href="?section=itemReport">Item Report</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>

        <!-- Main Content Area -->
        <main class="col-md-9 ms-sm-auto col-lg-10 bg-light" style="height: 100vh">

          <?php
          
          $defaultSection = isset($_GET['section']) ? $_GET['section'] : 'customers';

          
          if ($defaultSection === 'customers') {
            include 'customer.php';
          } elseif ($defaultSection === 'items') {
            include 'items.php';
          } elseif ($defaultSection === 'invoiceReport') {
            include 'invoiceReports.php';
          } elseif ($defaultSection === 'invoiceItemReport') {
            include 'invoiceItemReports.php';
          } elseif ($defaultSection === 'itemReport') {
            include 'itemReports.php';
          } else {
            
            include 'customer.php';
            
          }
          ?>
        </main>

      </div>
    </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>