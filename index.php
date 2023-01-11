<?php
session_start();

include('includes/head.php')

?>

<title>Elegant Wardrobe : Home</title>
</head>

<body>

<?php
            if (isset($_SESSION['error'])) {
            ?>
            <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error'] ?></div>
            <?php
            unset($_SESSION['error']);
            }
            if (isset($_SESSION['success_msg'])) {
                ?>
                <div class="alert alert-success" role="alert"><?php echo $_SESSION['success_msg'] ?></div>
                <?php
                unset($_SESSION['success_msg']);
                # code...
            }
        ?>


    <?php
    include('includes/main-nav.php');

    include('includes/slider.php');

    ?>


    <div class="container mt-3">

    <!-- Section 1,2 after slider -->

    <?php include('includes/home/section-one.php');
        include('includes/home/section-two.php')
    ?>

    <!--Close Section 1,2 after slider -->


  


        <div class="row mt-3">

            <div class="col-md-6">
                <h4>Elegant Wardrobe</h4>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>

            </div>

            <div class="col-md-6">
                <img src="img/1.jpg" class="img-fluid" alt="...">
            </div>

        </div>


        <div class="card text-center mt-3">
            <div class="card-header">
                What is Lorem Ipsum?
            </div>
            <div class="card-body">
                <h5 class="card-title">Elegant Wardrobe</h5>
                <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            <div class="card-footer text-muted">
                Elegant Wardrobe
            </div>
        </div>



        <!-- Featurd items -->
       
        <?php include('includes/home/featured-items.php');
               
        ?>

        <!-- Close Featured items -->


    </div>



    <?php
    include('includes/footer.php');
    include('includes/home/reg-model.php');
    include('includes/home/log-model.php');
    ?>