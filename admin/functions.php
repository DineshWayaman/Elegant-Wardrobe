<?php

include('../config.php');

if(isset($_POST['add-product'])){
    $p_name = $_POST['p_name'];
    $p_qty = $_POST['p_qty'];
    $p_price = $_POST['p_price'];
    $p_type = $_POST['p_type'];
    $p_admin_id = 1;


    // insert product first

    $insertProduct = "INSERT INTO product(p_name, p_qty, p_price, p_cat, p_c_admin_id) VALUES (?,?,?,?,?)";
    $inQEx = $conn->prepare($insertProduct);
    $inQEx->execute(array($p_name, $p_qty, $p_price, $p_type, $p_admin_id));

    if($inQEx){

        $selectLastAdded = "SELECT * FROM product ORDER BY p_id desc LIMIT 1";
        $inSelQ = $conn->prepare($selectLastAdded);
        $inSelQ->execute();
        $inSelRow = $inSelQ->rowCount();
        $inSelFetch = $inSelQ->fetch();
        
        if($inSelRow == 1){

            $finalID = $inSelFetch['p_id'];



            $extension = array('jpeg','jpg','png','gif');
            foreach($_FILES['p_img']['tmp_name'] as $key => $value){
                $filename = $_FILES['p_img']['name'][$key];
                $filename_temp = $_FILES['p_img']['tmp_name'][$key];
                $ext = pathinfo($filename,PATHINFO_EXTENSION);
                $fileimg='';
                if(in_array($ext, $extension)){
                    if(!file_exists('../img/products/'.$filename)){
                    move_uploaded_file($filename_temp, '../img/products/'.$filename);
                   $fileimg = $filename;
                }else{
                        $filename = str_replace('.','-',basename($filename,$ext));
                        $newfilename = $filename.time().".".$ext;
                        move_uploaded_file($filename_temp, '../img/products/'.$newfilename);
                        $fileimg = $newfilename;
                    }


                    $insertImg = "INSERT INTO pimage(img_p_id, img_img) VALUES (?,?)";
                    $inIEx = $conn->prepare($insertImg);
                    $inIEx->execute(array($finalID, $fileimg));

                   header('Location: add-products.php');

                
                }else{
                    echo "File Upload Error Occurd";
                }
            }



        }else{
            echo "Error while proccessing more than 1 row or no row";
        }

    }else{
        echo "Error while proccessing";
    }
    

}

