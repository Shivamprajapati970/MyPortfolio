<?php 
   session_start();
   include("../config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: login.php");
   }
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="html 5 template">
    <meta name="author" content="">
    <title>MyPortfolio-Admin</title>
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i%7CMontserrat:600,800" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- ARCHIVES CSS -->
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/dashbord-mobile-menu.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/swiper.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/lightcase.css">
    <link rel="stylesheet" href="css/owl-carousel.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" id="color" href="css/default.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="maxw1600 m0a dashboard-bd">

<?php
include "../config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM userdesc WHERE sno = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        echo "No Property found with this ID.";
        exit();
    }

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $designation = $_POST["designation"];
    $twitter = $_POST['twitter'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $googleplus = $_POST['googleplus'];
    $linkedin = $_POST['linkedin'];
    // $status = $_POST['status1'];
    // $description = $_POST['description'];
    // $type = $_POST['type'];
    // $trending = $_POST['trending'];
    
    // Retrieve old images from the database
    $stmt = $conn->prepare("SELECT backimage FROM userdesc WHERE sno = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $oldImages = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    
    // If a new image is uploaded, process the upload and delete the old image
    $uploadedImages = [];
    $imageFields = ['backimage'];
    $uploadOk = 1;

    foreach ($imageFields as $imageField) {
        if (!empty($_FILES[$imageField]["name"])) {
            // Define target directory and new image name
            $target_dir = "uploads/backimage/";
            $unique_name = uniqid() . "_" . time() . "." . strtolower(pathinfo($_FILES[$imageField]["name"], PATHINFO_EXTENSION));
            $target_file = $target_dir . $unique_name;

            // Validate the uploaded image
            $check = getimagesize($_FILES[$imageField]["tmp_name"]);
            if ($check === false) {
                echo "File $imageField is not an image.";
                $uploadOk = 0;
            }

            if ($_FILES[$imageField]["size"] > 5000000) {
                echo "File $imageField is too large.";
                $uploadOk = 0;
            }

            // Move new image and delete the old one
            if ($uploadOk && move_uploaded_file($_FILES[$imageField]["tmp_name"], $target_file)) {
                $uploadedImages[$imageField] = $target_file;

                // Delete the old image if it exists
                if (!empty($oldImages[$imageField]) && file_exists($oldImages[$imageField])) {
                    unlink($oldImages[$imageField]);
                }
            } else {
                echo "Error uploading $imageField.";
            }
        }
    }

    // Prepare the update query, updating images only if new ones are uploaded
    $query = "UPDATE userdesc SET name=?, designation=?, twitter=?, facebook=?, instagram=?, `google-plus`=? ,linkedin=?";
    
    foreach ($imageFields as $imageField) {
        if (!empty($uploadedImages[$imageField])) {
            $query .= ", $imageField=?";
        }
    }

    $query .= " WHERE sno=?";
    
    // Bind parameters
    $stmt = $conn->prepare($query);
    $params = [$name, $designation, $twitter, $facebook, $instagram, $googleplus, $linkedin];
    
    foreach ($imageFields as $imageField) {
        if (!empty($uploadedImages[$imageField])) {
            $params[] = $uploadedImages[$imageField];
        }
    }
    $params[] = $id;
    
    $stmt->bind_param(str_repeat('s', count($params)), ...$params);

    if ($stmt->execute()) {
        echo "Property updated successfully.";
        header("Location: showdescription.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close the connection
$conn->close();
?>


<?php include "nav.php" ?>
<main id="main" class="main">
    <div class="container">
        <h1 class="mt-5">Update User Description</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" class="form-control" autocomplete="off" required>
            </div>
                <div class="form-group">
                    <label for="image1">Background Image </label>
                    <!-- Display the current image -->
                    <div>
                        <img src="<?php echo htmlspecialchars($row['backimage']); ?>" alt="Image1" style="max-width: 150px; max-height: 150px;">
                    </div>
                    <label for="image1">Upload Background Image (Optional)</label>
                    <input type="file" id="image1" name="backimage" class="form-control" autocomplete="off">
                    <!-- Make the file upload optional for updates -->
                </div>
            
            <div class="form-group">
                <label for="location">Designation</label>
                <input type="text" id="location" name="designation" value="<?php echo htmlspecialchars($row['designation']); ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="bedroom">Twitter link</label>
                <input type="text" id="bedroom" name="twitter" value="<?php echo htmlspecialchars($row['twitter']); ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="bathroom">Facebook link</label>
                <input type="text" id="bathroom" name="facebook" value="<?php echo htmlspecialchars($row['facebook']); ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="area">Instagram link</label>
                <input type="text" id="area" name="instagram" value="<?php echo htmlspecialchars($row['instagram']); ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="garage">Google-plus</label>
                <input type="text" id="garage" name="googleplus" value="<?php echo htmlspecialchars($row['google-plus']); ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="price">Linkendin</label>
                <input type="text" id="price" name="linkedin" value="<?php echo htmlspecialchars($row['linkedin']); ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="showdescription.php" class="btn btn-success">Back</a>
            </div>
        </form>
    </div>
</main>

<!-- MAIN JS -->
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
