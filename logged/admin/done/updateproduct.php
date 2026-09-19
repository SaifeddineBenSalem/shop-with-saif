<?php
session_start();
if (!(isset($_SESSION["login"])))
        header("Location: ../../login.php");
include '../../actions/user.php';
include '../../actions/database.php';
$database = new Database();
$db = $database->connect();
$user = new User($db,null,null,$_SESSION["login"],null,null,null,null,null);
$role = $user->getRole();
if ($role != "admin")
    header("Location: ../index.php");
include 'actions/categories.php';
$category = new Categories ($db,null,null);
$categories_names = $category->getAllCategories();
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
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

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
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
                    <div class="col-md-6 text-center">
                         <h2 class="form-header">Add a New product</h2>
                         <br>
                <form action="actions/add_product.php" method="POST">
                     <div class="form-group">
                        <select name="categoryName" required class="form-select" id="floatingSelect">
                            <option value=""> Select a category </option>
                            <?php foreach($categories_names as $category_name) {?>
                                <option value="<?php echo $category_name->getName(); ?>"><?php echo $category_name->getName(); ?></option>
                            <?php }?>
                        </select>
                        <br>
                     </div>
                    <div class="form-group">
                        <input type="text" id="productName" name="productName" class="form-control" placeholder="Enter product name" required>
                    </div><br>
                    <div class="form-group">
                        <textarea id="productDescription" name="productDescription" class="form-control" placeholder="Enter product description" required></textarea>

                    </div><br>
                     <div class="form-group">
                        <input type="number" min="1" id="productPrice" name="productPrice" class="form-control" placeholder="Enter product price" required>
                    </div><br>
                     <div class="form-group">
                        <input type="number" min="1" id="productPromo" name="productPromo" class="form-control" placeholder="Enter product promo">
                    </div><br>
                    <div class="form-group" id="shoesinput">
                        Shoes sizes :<br>
                       <input type="checkbox" class="form-check-input" name="shoesSizes[]" value="36"/> 36
                       <input type="checkbox" class="form-check-input" name="shoesSizes[]" value="37"/> 37
                        <input type="checkbox" class="form-check-input" name="shoesSizes[]" value="38"/> 38
                       <input type="checkbox" class="form-check-input" name="shoesSizes[]" value="39"/> 39
                        <input type="checkbox" class="form-check-input" name="shoesSizes[]" value="40"/> 40
                       <input type="checkbox" class="form-check-input" name="shoesSizes[]" value="41"/> 41
                        <input type="checkbox" class="form-check-input" name="shoesSizes[]" value="42"/> 42
                       <input type="checkbox" class="form-check-input" name="shoesSizes[]" value="43"/> 43
                        <input type="checkbox" class="form-check-input" name="shoesSizes[]" value="44"/> 44
                       <input type="checkbox" class="form-check-input" name="shoesSizes[]" value="45"/> 45
                    </div><br>
                    <div class="form-group" id="shoesinput">
                        Colors :<br>
                       <input type="checkbox" class="form-check-input" name="colors[]" value="Black"/> Black
                       <input type="checkbox" class="form-check-input" name="colors[]" value="White"/> White
                        <input type="checkbox" class="form-check-input" name="colors[]" value="Grey"/> Grey
                       <input type="checkbox" class="form-check-input" name="colors[]" value="Red"/> Red
                        <input type="checkbox" class="form-check-input" name="colors[]" value="Purple"/> Purple
                       <input type="checkbox" class="form-check-input" name="colors[]" value="Green"/> Green
                        <input type="checkbox" class="form-check-input" name="colors[]" value="Blue"/> Blue<br>
                       <input type="checkbox" class="form-check-input" name="colors[]" value="Yellow"/> Yellow
                        <input type="checkbox" class="form-check-input" name="colors[]" value="Brown"/> Brown
                       <input type="checkbox" class="form-check-input" name="colors[]" value="Orange"/> Orange
                    </div><br>
                    <button type="submit" class="btn btn-primary w-100">Add Category</button>
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
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>