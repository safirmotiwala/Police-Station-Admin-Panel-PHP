<?php
date_default_timezone_set('Asia/Calcutta');
ini_set('display_errors', 1);
// connect to the database
include('config.php');
//$conn = mysqli_connect('localhost', 'root', '', 'file-management');

$sql = "SELECT * FROM t_missing_person";
$result = mysqli_query($link, $sql);

//$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Uploads files
if (isset($_POST['submit'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['file']['name'];
    $psname = mysqli_real_escape_string($link, $_POST['ddlps']);
    $month = mysqli_real_escape_string($link, $_POST['month']);
    $year = mysqli_real_escape_string($link, $_POST['year']);
    $date = date('Y-m-d H:i:s');

    // destination of the file on the server
    $destination = 'MissingPDF/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $allowed =  array('pdf');

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];

    if (!in_array($extension, $allowed))
    {
        //echo "You file extension must be .zip, .pdf or .docx";
        echo "<script type='text/javascript'>alert('Please uplaod only 1MB pdf file only ')</script>";

    } elseif ($_FILES['file']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO t_missing_person (POLICE_STATION,MONTH,YEAR,RECORD_STATUS,RECORD_CREATED_ON,NAME,SIZE,DOWNLOADS) VALUES ('$psname', '$month', '$year', 'C', '$date', '$filename', $size,0)";
            //$sql = "INSERT INTO t_missing_person (NAME,SIZE,DOWNLOADS) VALUES ('$filename', $size,0)";
            if (mysqli_query($link, $sql)) {
                //echo "File uploaded successfully";
                echo "<script type='text/javascript'>alert('Missing details submitted successfully..!')</script>";
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
    $sql = "SELECT * FROM t_missing_person WHERE SRNO=$id";
    $result = mysqli_query($link, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'MissingPDF/' . $file['name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('MissingPDF/' . $file['name']));
        readfile('MissingPDF/' . $file['name']);

        // Now update downloads count
        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE t_accident_compensation SET downloads=$newCount WHERE id=$id";
        mysqli_query($link, $updateQuery);
        exit;
    }

}

?>