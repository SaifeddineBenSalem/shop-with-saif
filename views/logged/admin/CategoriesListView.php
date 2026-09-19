<?php
session_start();
if (!(isset($_SESSION["login"])))
        header("Location: ../../login.php");
require_once '../../controlers/logged/CategoriesControler.php';
require_once '../../controlers/logged/UserControler.php';

$categoriesControler = new CategoriesControler();
$userControler = new UserControler();
$user=$userControler->getCurrentUser($_SESSION["login"]);


$categories = $categoriesControler->getAllCategories();

$role = $user["role"];
if ($role != "admin")
    header("Location: ../index.php");
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
        <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">

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
    <style>
    .btn-primary {
        background-color: #4CAF50; /* Green background */
        color: white; /* White text */
        border: none; /* Remove border */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Soft shadow */
        transition: all 0.3s ease-in-out; /* Smooth transition */
    }
    .btn-primary:hover {
        background-color: #45a049; /* Slightly darker green on hover */
        transform: scale(1.05); /* Slight zoom effect */
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2); /* Stronger shadow on hover */
    }
    .btn-primary:focus {
        outline: none; /* Remove focus outline */
        box-shadow: 0 0 8px rgba(0, 150, 0, 0.5); /* Focus glow */
    }
</style>

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
                <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Responsive Table</h6>
                               <a href="index.php?action=addcategory" class="btn btn-primary btn-lg px-4 py-2">
                                    <i class="fa fa-plus me-2"></i>Add Category
                                </a>
                                <br><br>
                            <div class="table-responsive">
                                <table class="table"  id="example">
                                    <thead>
                                        <tr>
                                            <th scope="col">id</th>
                                            <th scope="col">Category name</th>
                                            <th scope="col">Posting date</th>
                                            <th scope="col">Poster</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            <?php foreach($categories as $category) {?>
                                                <tr>
                                            <th scope="row"><?php echo $category["id"];?></th>
                                            <td><?php echo $category["name"];?></td>
                                            <td><?php echo $category["posting_date"];?></td>
                                            <td><?php echo $category["poster"];?></td>
                                             <td><?php echo $category["status"];?></td>
                                            <td><a href="index.php?action=viewcategory&id=<?php echo $category["id"];?>">View Category </a></td>
                                                </tr>
                                            <?php }?>
                                          
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "paging": true, // Enables pagination
                "lengthMenu": [5, 10, 25, 50], // Options for number of rows
                "pageLength": 5 // Default number of rows per page
            });
        });
    </script>

    <!-- Template Javascript -->
    <script src="../../inc/logged/admin/js/main.js"></script>
</body>

</html>