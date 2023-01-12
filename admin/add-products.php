<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Add Products</title>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Add New Products</h2>
        <form action="functions.php" method="post" enctype="multipart/form-data">
            <div class="form-group col-md-12 mt-2">
                <label for="inputEmail4">Product Name</label>
                <input type="text" name="p_name" class="form-control" id="inputEmail4" required>
            </div>
            <div class="row">
                <div class="form-group col-md-6 mt-2">
                    <label>Pruduct Quantity</label>
                    <input type="number" name="p_qty" class="form-control" required>
                </div>
                <div class="form-group col-md-6 mt-2">
                    <label for="inputPassword4">Product Price</label>
                    <input type="number" step="any" name="p_price" class="form-control" id="inputPassword4" required>
                </div>
            </div>

            <div class="form-group col-md-12 mt-2">

                <select name="p_type" id="" class="form-control form-control-user" required>
                    <option type="" id="" disabled selected>Choose Cloth Category</option>
                    <option type="" id="">Men's</option>
                    <option type="" id="">Women's</option>
                    <option type="" id="">Kid's</option>
                </select>

            </div>

            <div class="row mt-2">
                <div class="form-group col-md-6">
                    <label for="img1">Image 1</label>
                    <input class="form-control" type="file" id="" name="p_img[]" id="">
                </div>
                <div class="form-group col-md-6">
                <label for="img1">Image 2</label>
                    <input class="form-control" type="file" id="" name="p_img[]" id="">
                </div>
            </div>

            <div class="text-center mt-3">
                <input type="submit" name="add-product" value="Save" class="btn btn-danger" style="width: 200px;">
            </div>

        </form>
    </div>

</body>

</html>