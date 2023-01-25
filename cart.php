<?php
session_start();
include('config.php');

if(isset($_SESSION['u_id'])){
    $userID = $_SESSION['u_id'];
}else{
    $userID = null;
}

if($userID == null){
    echo '<script>alert("Login to access this page"); window.location.href = "index.php";</script>';
}else{


    include('includes/head.php')

?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <title>Cart</title>
</head>
<body>

<?php
    include('includes/main-nav.php');
  ?>


    <div class="container mt-5 mb-5">


<table id="myTable" class="table table-striped table-bordered w-100">
    <thead>
        <tr>
            <th>Item Name</th>
            <th>Item Qty</th>
            <th>Item Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
     
    <?php
    
    $checkUserCart = "SELECT * FROM cart WHERE c_u_id=?";
    $checkUserEx = $conn->prepare($checkUserCart);
    $checkUserEx->execute(array($userID));
    $checkUserRow = $checkUserEx->rowCount();
    
    while($checkUserFetch = $checkUserEx->fetch()){

        $itemID = $checkUserFetch['c_p_id'];
        $itemQty = $checkUserFetch['c_quantity'];

        $checkItem = "SELECT * FROM product WHERE p_id =?";
        $checkItemEx = $conn->prepare($checkItem);
        $checkItemEx->execute(array($itemID));

        while($checkItemFetch = $checkItemEx->fetch()){



   ?>

    <tr>
            <td style="width: 90px">
          <?php echo $checkItemFetch['p_name'] ?>
            </td>
            <td style="width: 90px">
            <?php echo $itemQty ?>
            </td>
            <td style="width: 90px">
            Rs.<?php echo $checkItemFetch['p_price'] ?>
            </td>
            <td style="width: 90px"> 
           <button class="btn btn-danger">Delete</button>
            </td>

        </tr>


        <?php
}
            
}
        ?>

  
    </tbody>
</table>
<!-- Close Pending Order Table -->


    <div class="container">
        <div class="row">
        <div class="col-md-4">

</div>
<div class="col-md-4">
    <h3 class="text-center">Total Price : Rs. 
 
    ?></h3>
    <div class="text-center">
        <button class="btn btn-success">Buy Now</button>
    </div>
</div>
<div class="col-md-4"></div>
        </div>
    </div>


</div>


<script>
    $(document).ready( function () {
    $('#myTable').DataTable({
        "pageLength": 25,
        "language": {
            "lengthMenu": "Display _MENU_ Entries",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "decimal": ",",
            "thousands": "."
        },
        "order": [[ 0, "desc" ]],
        "oLanguage": {
            "sSearch": "Keywords : "
        },
        /* "scrollY": 340,
        "scrollX": true, */
        "initComplete": function (settings, json) {  
$("#myTable").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
},
        
    });
} );
</script>



<?php
    include('includes/footer.php');

    ?>

<?php
}

?>