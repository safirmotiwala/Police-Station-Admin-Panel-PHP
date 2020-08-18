<?php
// Initialize the session

ini_set('display_errors', 1);

include('MartyrsLogic.php');

session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
$results = mysqli_query($link, "SELECT SRNO,NAME,RANK,MARTYRDOM_DATE,FILE_NAME,SIZE,RECORD_STATUS,RECORD_CREATED_ON FROM t_martyrs");

if (isset($_GET['del'])) {
  $id = $_GET['del'];
  mysqli_query($link, "DELETE FROM t_martyrs WHERE SRNO=$id");
  $_SESSION['message'] = "Address deleted!";
  header('location: add_martyrs.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  
  <title>
   Police Station
  </title>
  <?php include'external_links.php' ?>
  <?php include'table_css.php' ?>
  <?php include'file_upload_validation.php' ?>

</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo"><a href="#" class="simple-text logo-normal">
        <img src="assets/img/logo.jpg">
          Maharashtra
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item " >
            <a class="nav-link" href="Admin_Panel.php">
              <i class="material-icons">account_circle</i>
              <p>UIDB</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="add_missing_person.php">
              <i class="material-icons">face</i>
              <p>Missing Person</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="add_women_special.php">
              <i class="material-icons">card_membership </i>
              <p>Women Special</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="add_traffic_edu.php">
              <i class="material-icons">how_to_reg</i>
              <p>Traffic Education</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="add_info.php">
              <i class="material-icons">check_circle</i>
              <p>Right To Information</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="add_sp.php">
              <i class="material-icons">calendar_today</i>
              <p>SP Details</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="add_senior.php">
              <i class="material-icons">stars</i>
              <p>Senior Officers</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="add_sdpo.php">
              <i class="material-icons">account_box</i>
              <p>SDPO Details</p>
            </a>
          </li>


          <li class="nav-item ">
            <a class="nav-link" href="add_branch.php">
              <i class="material-icons">account_balance</i>
              <p>Branch Details</p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="add_gallery.php">
              <i class="material-icons">photo_album</i>
              <p>Gallery Photos</p>
            </a>
          </li>

          <li class="nav-item active">
            <a class="nav-link" href="add_martyrs.php">
              <i class="material-icons">accessibility</i>
              <p>Martyrs Details</p>
            </a>
          </li>

        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <?php include 'admin_nav.php' ?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add Branch Details</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body">
                  <form style="text-align: center;" method="post" action="add_martyrs.php" enctype="multipart/form-data">
            <div class="row border rounded container-fluid mx-0 pb-1">


              <div class="col-md-6 px-1 pt-1">
                
                <div class="row">
                  <div class="col-md-12">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" width="250px" id="check" class="form-control" />
                </div>
              </div>
            </div>

                <div class="row">
                  <div class="col-md-12">
                <div class="form-group">
                  <label>Rank</label>
                  <input type="text" name="rank" width="250px" id="check1" class="form-control" />
                </div>
              </div>
            </div>

            <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Martyrdom Date</label>
                      <input type="date" name="martyrdomdate" id="check2" class="form-control" />
                    </div>
                  </div>
                </div>

                  
                <div class="row">
                <div class="col-md-12">
                  <label>Pdf File</label>
                      <input type="file" name="file" class="form-control" accept="application/pdf" onchange="ValidatepdfInput(this);" />
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-6 ml-auto mr-auto">
                    
                            <input type="hidden" name="MAX_FILE_SIZE" value="900000" />
                    <button type="submit" value="submit" name="submit" class="btn btn-primary btn-round btn-block">Submit</button>
                  </div>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-12">
                <a class="btn btn-primary btn-round btn-block" href="reset-password.php">Reset Password</button></a>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                <a class="btn btn-primary btn-round btn-block" href="logout.php">Logout</button></a>
                </div>
              </div>
            </div>
          <div class="row" style="overflow-x: auto;">
            <div class="col-md-12">

            <table class="data-table">
                <thead>
                    <tr>
                        <th>SR.NO</th>
                        <th>NAME</th>
                        <th>RANK</th>
                        <th>MARTYRDOM DATE</th>
                        <th>FILE NAME</th>
                        <th>CREATED DATE</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>

                <?php while ($row = mysqli_fetch_array($results)) { ?>
                <tr>
                    <td>
                        <?php echo $row['SRNO']; ?>
                    </td>
                    <td>
                        <?php echo $row['NAME']; ?>
                    </td>
                    <td>
                        <?php echo $row['RANK']; ?>
                    </td>
                    <td>
                        <?php echo $row['MARTYRDOM_DATE']; ?>
                    </td>
                    <td>
                        <?php echo $row['FILE_NAME']; ?>
                    </td>
                    <td>
                        <?php echo $row['RECORD_CREATED_ON']; ?>
                    </td>

                    <td>
                        <a href="add_martyrs.php?del=<?php echo $row['SRNO']; ?>" class="del_btn">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
            </div>
            </div>
            </div>
          </form>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>

    </div>
  </div>
  </div>
  <?php include'stored_xss.php' ?>
  <?php include'external_scripts.php' ?>
</body>

</html>