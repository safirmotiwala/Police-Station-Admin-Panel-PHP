<?php

date_default_timezone_set('Asia/Calcutta');
ini_set('display_errors', 1);
// connect to the database
include('config.php');
//$conn = mysqli_connect('localhost', 'root', '', 'file-management');

$sql = "SELECT * FROM t_martyrs";
$result = mysqli_query($link, $sql);
//$files = mysqli_fetch_all($result, MYSQLI_ASSOC);
//mysqli_free_result($result);


// Uploads files
if (isset($_POST['submit'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['file']['name'];
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $rank = mysqli_real_escape_string($link, $_POST['rank']);
    $martydt = mysqli_real_escape_string($link, $_POST['martyrdomdate']);
    $date = date('Y-m-d H:i:s');

    // destination of the file on the server
    $destination = 'MartyrsPDF/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $allowed =  array('pdf');

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];

    if (!in_array($extension, $allowed))

    //if(!in_array($extension,['.pdf']))
    {
        echo "<script type='text/javascript'>alert('Please uplaod only 1MB pdf file only ')</script>";
    }
    elseif ($_FILES['file']['size'] > 1000000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else
    {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO t_martyrs (NAME,RANK,MARTYRDOM_DATE,FILE_NAME,SIZE,RECORD_STATUS,RECORD_CREATED_ON) VALUES ('$name','$rank','$martydt','$filename', $size,'C','$date')";
            if (mysqli_query($link, $sql)) {
                //echo "File uploaded successfully";
                echo "<script type='text/javascript'>alert('Martyrs details submitted successfully...!')</script>";
            }
        } else {
            echo "Failed to upload file.";
        }
    }
}

// Downloads files
if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM t_martyrs WHERE SRNo=$id";
    $result = mysqli_query($link, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'MartyrsPDF/' . $file['name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('MartyrsPDF/' . $file['name']));
        readfile('MartyrsPDF/' . $file['name']);

        //// Now update downloads count
        //$newCount = $file['downloads'] + 1;
        //$updateQuery = "UPDATE t_right_to_act SET downloads=$newCount WHERE id=$id";
        //mysqli_query($link, $updateQuery);
        exit;
    }

}

?>