<?php include("dbconn.php");

if(isset($_POST['upload'])){
    // $name=$_FILES['file'];
    // echo"<pre>";
    // print_r($name);
    $file_name=$_FILES['file']['name'];
    $temp_name=$_FILES['file']['type'];
    $temp_name=$_FILES['file']['tmp_name'];
    $file_size=$_FILES['file']['size'];
    $file_destination=$_FILES="uploads/" .$file_name;

    if(move_uploaded_file($temp_name,$file_destination)){
        $q="INSERT INTO video(video_name) VALUES ($file_name)";

        if(mysqli_query($conn,$Q)){
            $sucess="Video uploaded successfully!";

        }
        else{
            $failed= "Something went wrong";
        }
    }


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Upload</title>
    <link rel="stylesheet" href="uploadstyle.css">
    <style>

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 10px;
}

input, button {
    margin-bottom: 20px;
    padding: 10px;
}

button {
    background-color: #3498db;
    color: #fff;
    cursor: pointer;
    border: none;
    border-radius: 4px;
}

        </style>
</head>
<body>
    <div class="container">
        <h2>Video Upload</h2>
        <form action="video_upload.php" method="post"  enctype="multipart/form-data" >
            <label for="title">Video Title:</label>
            <input type="text" id="title" name="title" required>
            <br>
            <label for="video">Select Video:</label>
            <input type="file" id="video" name="file" accept="video/*" class="form-control" required>
            <br>
            <button type="submit" name="upload" value='Upload'>Upload Video</button>
        </form>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
