<?php
session_start();
include("../config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from code-theme.com/html/findhouses/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 29 Jun 2024 11:57:13 GMT -->

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
    <style>
        .container-table-res {
            width: 100%;
            height: 100dvh;
            overflow: scroll !important;
        }
        .img-set{
            margin:25px 0px !important  ;
        }

    </style>
</head>

<body class="maxw1600 m0a dashboard-bd">
    <?php
    include "nav.php";
    include "../config.php";

    // Fetch data from the database
    $sql = "SELECT * FROM about";
    $result = $conn->query($sql);
    ?>
    <main id="main" class="main container-table-res">

        <div class="container-fluid mt-5 ">
            <h1>All Properties - About</h1>
            <table class="table table-striped" border="1" >
                <thead>
                    <tr>
                        
                        <th>Description</th>
                        <!-- <th>Images</th> -->
                        <th>Title</th>
                        <th> Title description </th>
                        <th>Date Of Birth</th>
                        <th>Age</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Email</th>
                        <th>Freelance</th>
                        <th>Image</th>
                        <th>Last Description</th>
                        
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                
                                <td><?php echo htmlspecialchars($row['description']); ?></td>
                                <!-- <td>
                                    <img src="<?php //echo htmlspecialchars($row['image1']); ?>" alt="Right Image img-set" width="30"><br>
                                </td> -->
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo htmlspecialchars($row['titledesc']); ?></td>
                                <td><?php echo htmlspecialchars($row['dob']); ?></td>
                                <td><?php echo htmlspecialchars($row['age']); ?></td>
                                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                <td><?php echo htmlspecialchars($row['city']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['freelance']); ?></td>
                                <td><img src="<?php echo htmlspecialchars($row['image']); ?>" alt="background image"></td>
                                <td><?php echo htmlspecialchars($row['desc1']); ?></td>
                                
                                <td>
                                    <!-- Update Button -->
                                    <a href="updateabout.php?id=<?php echo $row['sno']; ?>" class="btn btn-primary btn-sm">Update</a>
                                </td>
                            </tr>
                    <?php
                            
                        }
                    } else {
                        echo "<p>No Properties found.</p>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    </div>
    </div>
    </div>
    </section>

    <script>
        function toggleDescription(element) {
            var shortDesc = element.previousElementSibling.previousElementSibling;
            var fullDesc = element.previousElementSibling;

            if (fullDesc.style.display === "none") {
                fullDesc.style.display = "inline";
                shortDesc.style.display = "none";
                element.innerHTML = "Read Less";
            } else {
                fullDesc.style.display = "none";
                shortDesc.style.display = "inline";
                element.innerHTML = "Read More";
            }
        }
    </script>
    <!-- END SECTION DASHBOARD -->

    <a data-scroll href="#wrapper" class="go-up"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
    <!-- END FOOTER -->

    <!-- START PRELOADER -->
    <div id="preloader">
        <div id="status">
            <div class="status-mes"></div>
        </div>
    </div>
    <!-- END PRELOADER -->

    <!-- ARCHIVES JS -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/moment.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/mmenu.min.js"></script>
    <script src="js/mmenu.js"></script>
    <script src="js/swiper.min.js"></script>
    <script src="js/swiper.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/slick2.js"></script>
    <script src="js/fitvids.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/smooth-scroll.min.js"></script>
    <script src="js/lightcase.js"></script>
    <script src="js/search.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/ajaxchimp.min.js"></script>
    <script src="js/newsletter.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/searched.js"></script>
    <script src="js/dashbord-mobile-menu.js"></script>
    <script src="js/forms-2.js"></script>
    <script src="js/color-switcher.js"></script>

    <script>
        $(".header-user-name").on("click", function() {
            $(".header-user-menu ul").toggleClass("hu-menu-vis");
            $(this).toggleClass("hu-menu-visdec");
        });
    </script>

    <!-- MAIN JS -->
    <script src="js/script.js"></script>

    </div>
    <!-- Wrapper / End -->
</body>


<!-- Mirrored from code-theme.com/html/findhouses/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 29 Jun 2024 11:57:14 GMT -->

</html>