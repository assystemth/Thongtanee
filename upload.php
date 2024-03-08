<?php
    // // ไฟล์นี้สามารถอัพโหลดรูปได้หลายไฟล์รูป http://192.168.1.108/Mukdahan/upload.php
    // $db = mysqli_connect('localhost', 'root', '', 'db_mukdahan');

    // if (!$db) {
    //     die('Database connection failed: ' . mysqli_connect_error());
    // }

    // $images = $_FILES['image']['name'];
    // $tmpFiles = $_FILES['image']['tmp_name'];

    // foreach ($images as $key => $value) {
    //     $tmpfileValue = $tmpFiles[$key];
    //     $imagePath = "img/" . $value;
        
    //     if (move_uploaded_file($tmpfileValue, $imagePath)) {
    //         // Use prepared statements to insert data
    //         $stmt = $db->prepare("INSERT INTO tbl_activity_img(activity_img_img) VALUES(?)");
    //         $stmt->bind_param("s", $value);
            
    //         if ($stmt->execute()) {
    //             echo json_encode(array("message" => "Success"));
    //         } else {
    //             echo json_encode(array("message" => "Error: " . $stmt->error));
    //         }
            
    //         $stmt->close();
    //     } else {
    //         echo json_encode(array("message" => "Error moving file"));
    //     }
    // }

    // $db->close();


    // ไฟล์นี้สามารถอัพโหลดรูปได้ไฟล์เดียว http://192.168.1.108/Mukdahan/upload.php
    $db = mysqli_connect('localhost', 'root', '', 'db_mukdahan');

    if (!$db) {
        die('Database connection failed: ' . mysqli_connect_error());
    }

    if(isset($_POST["refID"])) {
        $id = $_POST["refID"];
    } else {
        echo json_encode(array("Success" => "false", "message" => "Ref id is missing"));
        exit;
    }

    if(isset($_POST["imageData"])) {
        $imageData = $_POST["imageData"];
    } else {
        echo json_encode(array("Success" => "false", "message" => "Data is missing"));
        exit;
    }

    if(isset($_POST["imageName"])) {
        $imgName = $_POST["imageName"];
    } else {
        echo json_encode(array("Success" => "false", "message" => "image name is missing"));
        exit;
    }

    if(isset($_POST["imgSQL"])) {
        $imgsql = $_POST["imgSQL"];
    } else {
        echo json_encode(array("Success" => "false", "message" => "Image sql is missing"));
        exit;
    }

    $path = "docs/img/$imgName";
    //echo $path;

    file_put_contents($path, base64_decode($imageData));
    $sql = "UPDATE tbl_complain 
    SET tbl_complain.".$imgsql."='$imgName' 
    WHERE tbl_complain.complain_id=$id;";

    // echo $sql;

    $exe = mysqli_query($db, $sql);

    if($exe) {
        echo json_encode(array("Success" => "true", "message" => "Image uploaded successfully"));
    } else {
        echo json_encode(array("Success" => "false", "message" => "Error uploading image"));
    }

    $db->close();
?>
