<?php
session_start();

include('config.php');

if(isset($_SESSION['u_id'])){
    $userID = $_SESSION['u_id'];
}else{
    $userID = null;
}


include('includes/head.php')
?>

    <title>Products</title>
</head>
<body>

    <?php
        include('includes/main-nav.php');
    ?>



    <div class="container mt-3">

       <?php include('includes/products/mens-clothes.php') ?>


       <?php include('includes/products/womens-clothes.php') ?>


       <?php include('includes/products/kids-clothes.php') ?>


    </div>



<?php
    include('includes/footer.php');
    include('includes/home/reg-model.php');
    include('includes/home/log-model.php');
?>