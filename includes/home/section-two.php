<div class="row mt-3">


    <?php
    $getLatestP = "SELECT * FROM product ORDER BY p_id DESC LIMIT 4";
    $getLatestP = $conn->prepare($getLatestP);
    $getLatestP->execute();
    $latestrows = $getLatestP->rowCount();
    if ($latestrows > 0) {
        while ($fetchLatestP = $getLatestP->fetch()) {

    ?>

            <div class="col-md-3">
                <div class="card">
                    <img src="img/1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $fetchLatestP['p_name'] ?></h5>
                        <p class="card-text mb-0">Rs. <?php echo $fetchLatestP['p_price'] ?></p>
                        <p class="card-text">Available Qty : <?php echo $fetchLatestP['p_qty'] ?></p>
                        <div class="text-center"><a href="add_to_cart.php?" class="btn btn-primary">Add To Cart</a></div>
                    </div>
                </div>
            </div>


    <?php


        }
    }

    ?>

</div>