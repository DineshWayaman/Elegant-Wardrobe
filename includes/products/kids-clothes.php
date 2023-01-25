<div class="row mt-3">
            <h2>Kid's Clothes</h2>

            <?php

        
    $getLatestP = "SELECT * FROM product WHERE p_cat='Kids' ORDER BY p_id DESC";
    $getLatestP = $conn->prepare($getLatestP);
    $getLatestP->execute();
    $latestrows = $getLatestP->rowCount();
    if ($latestrows > 0) {
        while ($fetchLatestP = $getLatestP->fetch()) {

            $p_id = $fetchLatestP['p_id'];

            $getProdImg = "SELECT * FROM pimage WHERE img_p_id=? ORDER BY img_id DESC LIMIT 1";
            $getProdImg = $conn->prepare($getProdImg);
            $getProdImg->execute(array($p_id));
            $fetchPImg = $getProdImg->fetch();

    ?>

        <div class="col-md-3">
                <div class="card">
                <img src="http://localhost/Clothes/img/products/<?php echo $fetchPImg['img_img'] ?>" class="product-image card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title"><?php echo $fetchLatestP['p_name'] ?></h5>
                        <p class="card-text mb-0">Rs. <?php echo $fetchLatestP['p_price'] ?></p>
                        <p class="card-text">Available Qty : <?php echo $fetchLatestP['p_qty'] ?></p>
                        <?php
                        if ($userID == null || empty($userID)) {

                        ?>
                            <div class="text-center"><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logModel" type="button">Login For Order</button></div>

                        <?php
                        } else {


                        ?>
                             <div class="text-center"><a href="add_to_cart.php?p_id=<?php echo $p_id ?>&u_id=<?php echo $userID ?>" class="btn btn-primary">Add To Cart</a></div>
                        <?php
                        }
                        ?>
                        </div>
                </div>
            </div>


                <?php


        }
    }

    ?>



        </div>