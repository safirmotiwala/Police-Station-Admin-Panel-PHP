
<?php

ini_set('display_errors', 1);
// Initialize the session

include('filesLogic.php');

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
// Check if the user is logged in, if not then redirect him to login page
//if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//    header("location: Login.php");
//    exit;
//}

error_reporting(0);



$results = mysqli_query($link, "SELECT SrNo,PS,DATE,NAME,FIRNO,REMARK FROM t_accident_compensation");

if (isset($_GET['del'])) {
  $id = $_GET['del'];
  mysqli_query($link, "DELETE FROM t_accident_compensation WHERE SrNo=$id");
  $_SESSION['message'] = "Address deleted!"; 
  header('location: Admin_Panel.php');
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
          <li class="nav-item active" >
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

          <li class="nav-item ">
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
                  <h4 class="card-title">Add UIDB</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body">
                  <form style="text-align: center;" method="post" action="Admin_Panel.php" enctype="multipart/form-data">
            <div class="row border rounded container-fluid mx-0 pb-1">


              <div class="col-md-6 px-1 pt-1">
                <div class="form-group">
                  <label>FIR NO.</label>
                  <input type="text" name="firno" class="form-control" id="check">
                </div>


                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Police Station</label>
                      <select name="ddlps" class="form-control">
                        <option value="0">Select</option>
                      <option value="Chikhaltahan">Chikhaltahan</option>
                      <option value="Paithan">Paithan</option>
                      <option value="MIDC Paithan">MIDC Paithan</option>
                      <option value="Pachod">Pachod</option>
                        <option value="Bidkin">Bidkin</option>
                        <option value="Gangapur">Gangapur</option>
                        <option value="Shillegaon">Shillegaon</option>
                        <option value="Devgaon Rangari">Devgaon Rangari</option>
                        <option value="Kannad City">Kannad City</option>
                        <option value="Kannad Rural">Kannad Rural</option>
                        <option value="Khultabad">Khultabad</option>
                        <option value="Pishor">Pishor</option>
                        <option value="Sillod City">Sillod City</option>
                        <option value="Sillod Rural">Sillod Rural</option>
                        <option value="Ajintha">Ajintha</option>
                        <option value="Fardapur">Fardapur</option>
                        <option value="Soigaon">Soigaon</option>
                        <option value="Vaijapur">Vaijapur</option>
                        <option value="Shivoor">Shivoor</option>
                        <option value="Virgaon">Virgaon</option>
                    </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label>Select Date</label>
                    <input type="date" name="firdate" class="form-control">
                  </div>
                </div>

                

                  <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Remark</label>
                      <textarea rows="4" cols="50" name="remark" class="form-control" id="check1"></textarea>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <label>Pdf Upload</label>
                      <input type="file" name="file" class="form-control" accept="application/pdf" onchange="ValidatepdfInput(this);" />
                  </div>

                <div class="row">
                  <div class="col-md-6 ml-auto mr-auto">
                    
                    <input type="hidden" name="MAX_FILE_SIZE" value="900000"/>           
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
      <th>POLICE STATION</th>
            <th>DATE</th>
            <th>FILE NAME</th>
            <th>FIR NO.</th>
            <th>REMARK</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>
  
  <?php while ($row = mysqli_fetch_array($results)) { ?>
    <tr>
      <td><?php echo $row['SrNo']; ?></td>
      <td><?php echo $row['PS']; ?></td>
            <td><?php echo $row['DATE']; ?></td>
            <td><?php echo $row['NAME']; ?></td>
            <td><?php echo $row['FIRNO']; ?></td>
            <td><?php echo $row['REMARK']; ?></td>    
      <td>
        <a href="Admin_Panel.php?del=<?php echo $row['SrNo']; ?>" class="del_btn">Delete</a>
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