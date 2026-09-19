<?php
session_start();
if (!(isset($_SESSION["login"])))
        header("Location: ../../login.php");
if (!isset($_GET["id"]) || trim($_GET["id"]) === '') 
        header("Location: products.php");
   $id = $_GET["id"];
require_once '../../controlers/logged/UserControler.php';
require_once '../../controlers/logged/SponsorsControler.php';

$sponsorsControler = new SponsorsControler();

$userControler = new UserControler();
$user=$userControler->getCurrentUser($_SESSION["login"]);
$role = $user["role"];
if ($role != "admin")
    header("Location: ../index.php");

$product = $sponsorsControler->getSponsorById($id);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sponsorsControler->updateSponsor($id,$_POST["productName"]);
    header("Location: index.php?action=viewsponsor&id=".$id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../../inc/logged/admin/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../../inc/logged/admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../inc/logged/admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../../inc/logged/admin/css/style.css" rel="stylesheet">

</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php include 'sidebar.php'?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include 'navbar.php'?>   

            <!-- Navbar End -->


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
                    <div class="col-md-6 text-center">
                         <h2 class="form-header">Modify sponsor</h2>
                         <br>
                <form method="POST">

                    <div class="form-group">
                        <input type="text" id="productName" name="productName" class="form-control" placeholder="Enter product name" value="<?php echo $product["name"];?>" required>
                    </div><br>


                      

                    <button type="submit" class="btn btn-primary w-100">Modify sponsor</button>
                </form>
                    </div>
                </div>
            </div>
            <!-- Blank End -->


            <!-- Footer Start -->
            
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../inc/logged/admin/lib/chart/chart.min.js"></script>
    <script src="../../inc/logged/admin/lib/easing/easing.min.js"></script>
    <script src="../../inc/logged/admin/lib/waypoints/waypoints.min.js"></script>
    <script src="../../inc/logged/admin/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../../inc/logged/admin/lib/tempusdominus/js/moment.min.js"></script>
    <script src="../../inc/logged/admin/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../../inc/logged/admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../../inc/logged/admin/js/main.js"></script>
</body>

</html>