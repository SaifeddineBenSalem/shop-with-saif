<?php
session_start();
if (!(isset($_SESSION["login"])))
        header("Location: ../index.php?action=login");
require_once "../controlers/logged/HomePageControler.php";
require_once "../controlers/logged/CategoriesControler.php";
require_once "../controlers/logged/ProductsControler.php";

$homePageControler = new HomePageControler();
$user = $homePageControler->getCurrentUser($_SESSION["login"]);
$categoriesControler = new CategoriesControler();
$categories_names = $categoriesControler->getAllCategories();
$productsControler = new ProductsControler();

$allProducts = $productsControler->getAllProducts();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EShopper - Bootstrap Shop Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="../inc/logged/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../inc/logged/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../inc/logged/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <?php include 'header.php'; ?>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
        <?php include 'shopsidebar.php'; ?>

            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="#" class="nav-item nav-link active">‎ ‎ </a>
                            
                        </div>
                        <div class="navbar-nav ml-auto py-0">
                            <?php
                            $role = $user["role"];
                            if ($role === "admin") {
                            ?>
                            <a href="admin/index.php" class="btn border">
                    <i class="fas fa-window-close-o text-primary"></i>
                    <span class="badge">Admin Dashboard</span>
                </a>
            <?php } ?>
                        </div>
                    </div>
                </nav>
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="height: 410px;">
                            <img class="img-fluid" src="../inc/logged/img/carousel-1.jpg" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">Fashionable Dress</h3>
                                    <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" style="height: 410px;">
                            <img class="img-fluid" src="../inc/logged/img/carousel-2.jpg" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3>
                                    <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->


    <!-- Categories Start -->
     <?php shuffle($categories_names); 
     shuffle($allProducts);
     $displayCategories = array_slice($categories_names, 0, 6);
     
     ?>
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <?php foreach($displayCategories as $categoryX) {
                $productTemp = null;
                $i=0;
                foreach($allProducts as $productX) {
                    if ($productX["category"] === $categoryX["id"]){
                        $i = $i+1;
                        if ($productTemp === null)
                            $productTemp= $productX;
                    }
                }
                if ($i > 0) { 
                ?>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <p class="text-right"><?php echo $i; ?> Products</p>
                    <a href="index.php?action=products&id=<?php echo $categoryX["id"]?>" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="../inc/logged/img/products/<?php echo $productTemp["photo"]?>" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0"><?php echo $categoryX["name"]; ?></h5>
                </div>
            </div>
            <?php }
            }?>
        </div>
    </div>
    <!-- Categories End -->



    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <?php
                    require_once "../controlers/logged/SponsorsControler.php";
                    $sponsorsControler = new SponsorsControler();
                    $sponsors = $sponsorsControler->getAllSponsorsActive();

                    foreach ($sponsors as $sponsor) {
                    ?>
                    <div class="vendor-item border p-4">
                        <img src="../inc/logged/img/sponsors/<?php echo $sponsor["photo"] ?>" alt="">
                       <p style="text-align:center;"> <?php echo $sponsor["name"]; ?> </p>
                    </div>
                <?php }?>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->


    <!-- Footer Start -->
    <?php include 'footer.php';?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="../inc/logged/lib/easing/easing.min.js"></script>
    <script src="../inc/logged/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="../inc/logged/mail/jqBootstrapValidation.min.js"></script>
    <script src="../inc/logged/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="../inc/logged/js/main.js"></script>
</body>

</html>