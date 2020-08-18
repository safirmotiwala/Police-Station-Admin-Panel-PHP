<?php


date_default_timezone_set('Asia/Calcutta');
// Initialize the session
ini_set('display_errors', 1);

include('config.php');


$results = mysqli_query($link, "SELECT SRNO,OFFICER_NAME,DESIGNATION,ADDRESS,MOBILE_NO,RECORD_CREATED_ON FROM t_officer_list");

if (isset($_GET['del'])) {
  $id = $_GET['del'];
  mysqli_query($link, "DELETE FROM t_officer_list WHERE SRNO=$id");
  $_SESSION['message'] = "Record deleted!"; 
  header('location: add_senior.php');
}

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


if (count($_FILES) > 0) {
    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
        require_once "config.php";
        $imgData = addslashes(file_get_contents($_FILES['file']['tmp_name']));
        $imageProperties = getimageSize($_FILES['file']['tmp_name']);

        $officername = mysqli_real_escape_string($link, $_POST['officername']);
        $designation = mysqli_real_escape_string($link, $_POST['designation']);
        $Address = mysqli_real_escape_string($link, $_POST['address']);
        $mobileno = mysqli_real_escape_string($link, $_POST['mobileno']);        
        $email = mysqli_real_escape_string($link, $_POST['email']);    
        $date = date('Y-m-d H:i:s');

        
        $sql = "INSERT INTO t_officer_list(OFFICER_NAME,DESIGNATION,ADDRESS,MOBILE_NO,EMAIL_ID,OFFICER_PHOTO,RECORD_STATUS,RECORD_CREATED_ON)
  VALUES('{$officername}', '{$designation}', '{$Address}' ,'{$mobileno}', '{$email}', '{$imgData}' ,'C','{$date}')";
        $current_id = mysqli_query($link, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));

        echo "<script type='text/javascript'>alert('Senior Officer Details addedd successully..!')</script>";


    }
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
          <li class="nav-item active">
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
                  <h4 class="card-title">Add Senior</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body">
                  <form style="text-align: center;" method="post" action="add_senior.php" enctype="multipart/form-data">
            <div class="row border rounded container-fluid mx-0 pb-1">


              <div class="col-md-6 px-1 pt-1">
                <div class="row">
                  <div class="col-md-12">
                <div class="form-group">
                  <label>Officer Name</label>
                  <input type="text" name="officername" width="250px" id="check" class="form-control">
                </div>
              </div>
            </div>


                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Designation</label>
                      <select name="designation" class="form-control">
                      <option value="0">Select</option>
                      <option value="Superintendent Of Police">Superintendent Of Police</option>
                      <option value="Additional Superintendent Of Police">Additional Superintendent Of Police</option>
                      <option value="Sub Divisional Police Officer">Sub Divisional Police Officer</option>
                      <option value="Deputy Superintendent Of Police (H.Q.)">Deputy Superintendent Of Police (H.Q.)</option>
                      <option value="Senior Police Inspector">Senior Police Inspector</option>
                      <option value="PI">PI</option>
                      <option value="API">API</option>
                      <option value="Asst.PI">Asst.PI</option>
                      <option value="PSI">PSI</option>                      
                 </select>
                    </div>
                  </div>
                </div>

                  <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Address</label>
                      <textarea rows="4" cols="50" name="address" class="form-control" id="check1"></textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Mobile No</label>
                      <input type="text" name="mobileno" width="250px" class="form-control" id="check2">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Email Id</label>
                      <input type="email" name="email" width="250px" class="form-control" id="check3">
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                  <label>Officer Photo</label>
                      <input type="file" name="file" class="form-control" accept="image/*" onchange="ValidateimageInput(this);" />
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 ml-auto mr-auto">
                    
                            
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
      <th>OFFICER NAME</th>
            <th>DESIGNATION</th>
            <th>ADDRESS</th>
            <th>MOBILE NO.</th>            
            <th>CREATED DATE</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>
  
  <?php while ($row = mysqli_fetch_array($results)) { ?>
    <tr>
      <td><?php echo $row['SRNO']; ?></td>
      <td><?php echo $row['OFFICER_NAME']; ?></td>
            <td><?php echo $row['DESIGNATION']; ?></td>
            <td><?php echo $row['ADDRESS']; ?></td>
            <td><?php echo $row['MOBILE_NO']; ?></td>
            <td><?php echo $row['RECORD_CREATED_ON']; ?></td> 
      <td>
        <a href="add_senior.php?del=<?php echo $row['SRNO']; ?>" class="del_btn">Delete</a>
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