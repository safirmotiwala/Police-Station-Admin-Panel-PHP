<?php
// Initialize the session
ini_set('display_errors', 1);

include('MissingLogic.php');

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

$results = mysqli_query($link, "SELECT SRNO,POLICE_STATION,MONTH,YEAR,RECORD_CREATED_ON,NAME FROM t_missing_person");

if (isset($_GET['del'])) {
  $id = $_GET['del'];
  mysqli_query($link, "DELETE FROM t_missing_person WHERE SRNO=$id");
  $_SESSION['message'] = "Address deleted!"; 
  header('location: add_missing.php');
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
          <li class="nav-item active">
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
                  <h4 class="card-title">Add Missing Person</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body">
                  <form style="text-align: center;" method="post" action="add_missing_person.php" enctype="multipart/form-data">
            <div class="row border rounded container-fluid mx-0 pb-1">


              <div class="col-md-6 px-1 pt-1">
                


                <div class="row">
                  <div class="col-md-12">
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
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label>Select Month</label>
                    <select name="month" class="form-control">
                       <option value="0">Select</option>
                      <option value="January">January</option>
                      <option value="february">february</option>
                      <option value="March">March</option>
                      <option value="April">April</option>
                      <option value="May">May</option>
                      <option value="June">June</option>
                      <option value="July">July</option>
                      <option value="August">August</option>
                      <option value="September">September</option>
                      <option value="Octomber">Octomber</option>
                      <option value="November">November</option>
                      <option value="December">December</option>
                    </select> 
                  </div>
                </div>

                

                  <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Select Year</label>
                      <select name="year" class="form-control">
                      <option value="0">Select</option>
                      <option value="2008">2008</option>
                      <option value="2009">2009</option>
                      <option value="2010">2010</option>
                      <option value="2011">2011</option>
                      <option value="2012">2012</option>
                      <option value="2013">2013</option>
                      <option value="2014">2014</option>
                      <option value="2015">2015</option>
                      <option value="2016">2016</option>
                      <option value="2017">2017</option>
                      <option value="2018">2018</option>
                      <option value="2019">2019</option>
                 </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <label>Pdf Upload</label>
                      <input type="file" name="file" class="form-control" accept="application/pdf" onchange="ValidatepdfInput(this);"/>
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
            <th>MONTH</th>
            <th>YEAR</th>
            <th>FILE NAME</th>
            <th>CREATED DATE</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>
  
  <?php while ($row = mysqli_fetch_array($results)) { ?>
    <tr>
      <td><?php echo $row['SRNO']; ?></td>
      <td><?php echo $row['POLICE_STATION']; ?></td>
            <td><?php echo $row['MONTH']; ?></td>
            <td><?php echo $row['YEAR']; ?></td>
            <td><?php echo $row['NAME']; ?></td>
            <td><?php echo $row['RECORD_CREATED_ON']; ?></td>   
      <td>
        <a href="add_missing_person.php?del=<?php echo $row['SRNO']; ?>" class="del_btn">Delete</a>
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