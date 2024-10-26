<style media="screen">
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

body {
    min-height: 100vh;
    background: white;
    color: white;
    background-size: cover;
    background-position: center;
}

.side-bar {
    background: #1b1a1b;
    backdrop-filter: blur(15px);
    width: 250px;
    height: 100%;
    position: fixed;
    top: 0;
    left: -250px;
    overflow-y: auto;
    transition: 0.6s ease;
    transition-property: left;
}

.side-bar::-webkit-scrollbar {
    width: 0px;
}



.side-bar.active {
    left: 0;
}

h1 {

    text-align: center;
    font-weight: 500;
    font-size: 25px;
    padding-bottom: 13px;
    font-family: sans-serif;
    letter-spacing: 2px;
}

.side-bar .menu {
    width: 100%;
    margin-top: 30px;
}

.side-bar .menu .item {
    position: relative;
    cursor: pointer;
}

.side-bar .menu .item a {
    color: #fff;
    font-size: 16px;
    text-decoration: none;
    display: block;
    padding: 5px 30px;
    line-height: 60px;
}

.side-bar .menu .item a:hover {
    background: #33363a;
    transition: 0.3s ease;
}

.side-bar .menu .item i {
    margin-right: 15px;
}

.side-bar .menu .item a .dropdown {
    position: absolute;
    right: 0;
    margin: 20px;
    transition: 0.3s ease;
}

.side-bar .menu .item .sub-menu {
    background: #262627;
    display: none;
}

.side-bar .menu .item .sub-menu a {
   text-wrap: nowrap;
}

.rotate {
    transform: rotate(90deg);
}

.close-btn {
    position: absolute;
    color: #fff;

    font-size: 23px;
    right: 0px;
    margin: 15px;
    cursor: pointer;
}

.menu-btn {
    position: absolute;
    color: rgb(0, 0, 0);
    font-size: 35px;
    margin: 25px 25px 25px 10px;
    cursor: pointer;
}
.main h1 {
    color: black;
    font-size: 60px;
    text-align: center;
    line-height: 80px;
}

@media (max-width: 900px) {
    .main h1 {
        font-size: 40px;
        line-height: 60px;
    }
}

.image-149 {
    width: 100px;
    margin: 15px;
    border-radius: 50%;
    margin-left: 70px;
    border: 3px solid #b4b8b9;
}

header {
    background: #33363a;
}
.container-table-res {
            width: 100%;
            height: 100dvh;
            overflow: scroll !important;
        }


</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<div class="menu-btn">
    <i class="fas fa-bars"></i>
</div>


<div class="side-bar">

    <header>
        <div class="close-btn">

            <i class="fas fa-times"></i>
        </div>
        <img src="../user/images/logo.png"
           class="image-149" alt="">
        <h1>My Portfolio</h1>
    </header>
    <div class="menu">

        <div class="item">
            <a class="sub-btn"><i class="fas fa-table"></i>User Description<i class="fas fa-angle-right dropdown"></i></a>
            <div class="sub-menu">
                
                <a href="showdescription.php" class="sub-item">Show Description</a>

            </div>
        </div>
        <div class="item">
            <a class="sub-btn"><i class="fas fa-table"></i>About<i class="fas fa-angle-right dropdown"></i></a>
            <div class="sub-menu">
                <a href="showabout.php" class="sub-item">Show About </a>
                <!-- <a href="showlocation.php" class="sub-item">Show Location</a>
                <a href="addtype.php" class="sub-item">Add Type</a>
                <a href="showtype.php" class="sub-item">Show Type</a> -->
            </div>
        </div>
        <div class="item">
            <a class="sub-btn"><i class="fas fa-table"></i>Facts<i class="fas fa-angle-right dropdown"></i></a>
            <div class="sub-menu">
                <a href="addprimelocation.php" class="sub-item">Show Deatils</a>
                <!-- <a href="showprimelocation.php" class="sub-item">Show All Prime Locations</a> -->
            </div>
        </div>

        <div class="item">
            <a class="sub-btn"><i class="fas fa-table"></i>Skills<i class="fas fa-angle-right dropdown"></i></a>
            <div class="sub-menu">
                <a href="addagent.php" class="sub-item">Add skills</a>
                <a href="showagent.php" class="sub-item">Show All skills</a>
            </div>
        </div>
        <div class="item">
            <a class="sub-btn"><i class="fas fa-table"></i>Blog<i class="fas fa-angle-right dropdown"></i></a>
            <div class="sub-menu">
                <a href="addblog.php" class="sub-item">Add Blog</a>
                <a href="showblog.php" class="sub-item">Show All Blog</a>
            </div>
        </div>
        <div class="item">
            <a class="sub-btn"><i class="fas fa-table"></i>Testimonials<i class="fas fa-angle-right dropdown"></i></a>
            <div class="sub-menu">
                <a href="addtestimonials.php" class="sub-item">Add Testimonial</a>
                <a href="showtestimonials.php" class="sub-item">Show All Testimonial</a>
            </div>
        </div>
        <div class="item">
            <a class="sub-btn"><i class="fas fa-table"></i>Our Team<i class="fas fa-angle-right dropdown"></i></a>
            <div class="sub-menu">
                <a href="addourteam.php" class="sub-item">Add Our Team</a>
                <a href="showourteam.php" class="sub-item">Show Our Team</a>
            </div>
        </div>
        <div class="item"><a href="showcontact.php"><i class="fas fa-th"></i>Contact Details</a></div>
        <div class="item"><a href="shownewsletter.php"><i class="fas fa-th"></i>Newsletter</a></div>
        <div class="item"><a href="logout.php"><i class="fas fa-th"></i>Logout</a></div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    //jquery for toggle sub menus
    $('.sub-btn').click(function() {
        $(this).next('.sub-menu').slideToggle();
        $(this).find('.dropdown').toggleClass('rotate');
    });

    //jquery for expand and collapse the sidebar
    $('.menu-btn').click(function() {
        $('.side-bar').addClass('active');
        $('.menu-btn').css("visibility", "hidden");
    });

    $('.close-btn').click(function() {
        $('.side-bar').removeClass('active');
        $('.menu-btn').css("visibility", "visible");
    });
});
</script>