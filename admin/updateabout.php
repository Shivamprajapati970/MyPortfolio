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
    $stmt = $conn->prepare("SELECT * FROM about WHERE sno = ?");
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
    $description = $_POST["description"];
    $title = $_POST["title"];
    $titledesc = $_POST['titledesc'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $freelance = $_POST['freelance'];
    $desc1 = $_POST['desc1'];
    
    
    
    // Retrieve old images from the database
    $stmt = $conn->prepare("SELECT image FROM about WHERE sno = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $oldImages = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    
    // If a new image is uploaded, process the upload and delete the old image
    $uploadedImages = [];
    $imageFields = ['image'];
    $uploadOk = 1;

    foreach ($imageFields as $imageField) {
        if (!empty($_FILES[$imageField]["name"])) {
            // Define target directory and new image name
            $target_dir = "uploads/aboutimage/";
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
    $query = "UPDATE about SET description=?, title=?, titledesc=?, dob=?, age=?, phone=?, city=?, email=?, freelance=?, desc1=?";
    
    foreach ($imageFields as $imageField) {
        if (!empty($uploadedImages[$imageField])) {
            $query .= ", $imageField=?";
        }
    }

    $query .= " WHERE sno=?";
    
    // Bind parameters
    $stmt = $conn->prepare($query);
    $params = [$description, $title, $titledesc, $dob, $age, $phone, $city, $email, $freelance, $desc1];
    
    foreach ($imageFields as $imageField) {
        if (!empty($uploadedImages[$imageField])) {
            $params[] = $uploadedImages[$imageField];
        }
    }
    $params[] = $id;
    
    $stmt->bind_param(str_repeat('s', count($params)), ...$params);

    if ($stmt->execute()) {
        echo "Property updated successfully.";
        header("Location: showabout.php");
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
        <h1 class="mt-5">Update About </h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="description">Description</label>
                <!-- <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($row['description']); ?>" class="form-control" autocomplete="off" required> -->
                <textarea name="description" id="description" cols="149" rows="3" placeholder="<?php echo htmlspecialchars($row['description']); ?>" ><?php echo htmlspecialchars($row['description']); ?></textarea>
            </div>
                <div class="form-group">
                    <label for="image1">Image </label>
                    <!-- Display the current image -->
                    <div>
                        <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Image1" style="max-width: 150px; max-height: 150px;">
                    </div>
                    <label for="image1">Image (Optional)</label>
                    <input type="file" id="image1" name="image" class="form-control" autocomplete="off">
                    <!-- Make the file upload optional for updates -->
                </div>
            
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="titledesc">Title Description</label>
                <input type="text" id="titledesc" name="titledesc" value="<?php echo htmlspecialchars($row['titledesc']); ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="dob">Date-Of-Birth</label>
                <input type="text" id="dob" name="dob" value="<?php echo htmlspecialchars($row['dob']); ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="age">Age</label>
                <input type="text" id="age" name="age" value="<?php echo htmlspecialchars($row['age']); ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($row['city']); ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="price">Email</label>
                <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="freelance">Freelance</label>
                <input type="text" id="freelance" name="freelance" value="<?php echo htmlspecialchars($row['freelance']); ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="desc1">Last Description</label>
                <!-- <input type="text" id="desc1" name="desc1" value="<?php echo htmlspecialchars($row['desc1']); ?>" class="form-control" required> -->
                <textarea name="desc1" id="desc1" cols="149" rows="3"><?php echo htmlspecialchars($row['desc1']); ?></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="showabout.php" class="btn btn-success">Back</a>
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
