<?php
    session_start();
include 'conn.php';
include 'author_header.php';
if(isset($_SESSION['id']))
{
    $user_id = $_SESSION['id'];
    echo $user_id;
}


?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<div class="main_div" style="margin-top: -25px;">

<?php


if(isset($_POST['editors']))
{
    $editor = $_POST['editors'];
}

$date = date("Y-m-d");
//echo $date;
//echo "<br>$editor";
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["doc"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//echo $imageFileType;
// Check if image file is a actual image or fake image
if(isset($_POST["upload"])) {
   
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "<h2 class='error'>Sorry, file already exists.</h2>";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["doc"]["size"] > 500000) {
    echo "<h2 class='errror'>Sorry, your file is too large.</h2>";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "docx") {
    echo "<h2 class='error'>Invalid File Format</h2>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<h2 class='error'>Sorry, your file was not uploaded.</h2>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["doc"]["tmp_name"], $target_file)) {
        $file_path_sql = "INSERT INTO `published_docs` (`published_by`,`published_at`,`link`,`status`) VALUES ('$user_id','$date','$target_file',0)";
        $result = mysqli_query($conn,$file_path_sql);
        if($result)
        {
            echo "Done";
        }
        $last_id = "SELECT * FROM `published_docs` ORDER BY `id` DESC LIMIT 1";
        $last_id_result = mysqli_query($conn,$last_id);
        $row = mysqli_fetch_assoc($last_id_result);
        $last_doc_id = $row['id'];



        $editor_sql = "SELECT * FROM `editors` WHERE `user_name`='$editor'";
        $editor_result = mysqli_query($conn,$editor_sql);
        $row = mysqli_fetch_assoc($editor_result);
        $id = $row['id'];
        $req_sql = "INSERT INTO `req`(`req_to`, `req_by`,`req_for`,`status`) VALUES ('$id','$user_id','$last_doc_id',0)";
        $req_result = mysqli_query($conn,$req_sql);
        //else echo mysqli_error($conn);
    ?>
    <div>
        <h2 class="success">Congratulation!!! Your File Has Been Successfullly Uploaded. Please Wait Until your requested editor to publish it</h2>
    </div>

    <?php    
    } else {
        echo "<h2 class='error'>Sorry, there was an error uploading your file.</h2>";
    }
}
?>


    
</div>

</body>
</html>
