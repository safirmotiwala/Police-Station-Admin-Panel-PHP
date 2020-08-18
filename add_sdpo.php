<?php
date_default_timezone_set('Asia/Calcutta');
ini_set('display_errors', 1);
// Initialize the session

session_start();

include('config.php');


$results = mysqli_query($link, "SELECT * FROM t_sdpo_divisions");

if (isset($_GET['del'])) {
  $id = $_GET['del'];
  mysqli_query($link, "DELETE FROM t_sdpo_divisions WHERE ID=$id");
  $_SESSION['message'] = "Record deleted!"; 
  header('location: add_sdpo.php');
}


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
    if (is_uploaded_file($_FILES['fileofficer']['tmp_name'])) {
        require_once "config.php";
        $imgData = addslashes(file_get_contents($_FILES['fileofficer']['tmp_name']));
        $imageProperties = getimageSize($_FILES['fileofficer']['tmp_name']);

        $sdponame = mysqli_real_escape_string($link, $_POST['sdpo']);
        $officername = mysqli_real_escape_string($link, $_POST['sdpoofficername']);
        $psnames = mysqli_real_escape_string($link, $_POST['psnames']);
        $address = mysqli_real_escape_string($link, $_POST['address']);
        $telephone = mysqli_real_escape_string($link, $_POST['telephone']);
        $email = mysqli_real_escape_string($link, $_POST['email']);
        $imgbuilding =  addslashes(file_get_contents($_FILES['filebuilding']['tmp_name']));
        $date = date('Y-m-d H:i:s');
        
        $sql = "INSERT INTO t_sdpo_divisions(SDPO,BUILDING_PHOTO,SDPO_PHOTO,SDPO_NAME,ADDRESS,POLICE_STATIONS,TELEPHONE_NO,EMAIL_ID,RECORD_CREATED_ON)
  VALUES('{$sdponame}', '{$imgbuilding}', '{$imgData}' ,'{$officername}', '{$address}', '{$psnames}' ,'{$telephone}','{$email}','{$date}')";
        $current_id = mysqli_query($link, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));

        echo "<script type='text/javascript'>alert('SDPO Details addedd successully..!')</script>";

        //if (isset($current_id)) {
        //    header("Location: listImages.php");
        //}
    }
}

// Check if the user is logged in, if not then redirect him to login page
//if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//    header("location: Login.php");
//    exit;
//}

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
          <li class="nav-item active">
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
                  <h4 class="card-title">Add SDPO</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body">
                  <form style="text-align: center;" method="post" action="add_sdpo.php" enctype="multipart/form-data">
            <div class="row border rounded container-fluid mx-0 pb-1">


              <div class="col-md-6 px-1 pt-1">
                
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>SDPO Office Name</label>
                      <select name="sdpo" class="form-control">
                      <option value="0">Select</option>
                      <option value="SDPO AURANGABAD RURAL">SDPO AURANGABAD RURAL</option>
                      <option value="SDPO GANGAPUR">SDPO GANGAPUR</option>
                      <option value="SDPO KANNAD">SDPO KANNAD</option>
                      <option value="SDPO PAITHAN">SDPO PAITHAN</option>
                      <option value="SDPO SILLOD">SDPO SILLOD</option>
                      <option value="SDPO VAIJAPUR">SDPO VAIJAPUR</option>                                        
                 </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                <div class="form-group">
                  <label>SDPO Officer Name</label>
                  <input type="text" name="sdpoofficername" width="250px" class="form-control" id = "check">
                </div>
              </div>
            </div>

            <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Police Stations under SDPO</label>
                      <textarea rows="4" cols="50" name="psnames" class="form-control" id = "check1"></textarea>
                    </div>
                  </div>
                </div>

                  <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Address</label>
                      <textarea rows="4" cols="50" name="address" class="form-control" id = "check2"></textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Telephone No.</label>
                      <input type="text" name="telephone" width="250px" class="form-control" id = "check3">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Email Id</label>
                      <input type="email" name="email" width="250px" class="form-control" id = "check4">
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                  <label>Officer Photo</label>
                      <input type="file" name="fileofficer" class="form-control" accept="image/*" onchange="ValidateimageInput(this);" />
                  </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                  <label>Building Photo</label>
                      <input type="file" name="filebuilding" class="form-control" accept="image/*" onchange="ValidateimageInput(this);" />
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
      <th>SDPO</th>
            <th>SDPO NAME</th>
            <th>POLICE STATIONS</th>
            <th>ADDRESS</th>
            <th>MOBILE NO.</th>            
            <th>CREATED DATE</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>
  
  <?php while ($row = mysqli_fetch_array($results)) { ?>
    <tr>
      <td><?php echo $row['ID']; ?></td>
      <td><?php echo $row['SDPO']; ?></td>
            <td><?php echo $row['SDPO_NAME']; ?></td>
            <td><?php echo $row['POLICE_STATIONS']; ?></td>
            <td><?php echo $row['ADDRESS']; ?></td>            
            <td><?php echo $row['TELEPHONE_NO']; ?></td>
            <td><?php echo $row['RECORD_CREATED_ON']; ?></td>
            
      <td>
        <a href="add_sdpo.php?del=<?php echo $row['ID']; ?>" class="del_btn">Delete</a>
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