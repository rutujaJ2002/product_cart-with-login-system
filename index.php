<?php

include "./controller/conn.php";
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}

if(isset($_GET['logout'])){
    unset($user_id);
    session_destroy();
    header('location:login.php');
}

if(isset($_POST['add'])){
    $pro_name = $_POST['pro_name'];
    $pro_image = $_POST['pro_image'];
    $pro_price = $_POST['pro_price'];
    $pro_quantity = $_POST['quantity'];

    $select_cart = mysqli_query($conn, " SELECT * FROM `cart` WHERE name = '$pro_name' AND user_id = '$user_id' ");

    if(mysqli_num_rows($select_cart) > 0){
        $msg = 'Product is already added to cart';
        echo ("<script LANGUAGE='JavaScript'>
            window.alert('$msg');
            </script>");
    }
    else{
        mysqli_query($conn, " INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES
        ('$user_id', '$pro_name', '$pro_price', '$pro_quantity' ,'$pro_image')");

        $msg = 'Product added to cart';
        echo ("<script LANGUAGE='JavaScript'>
            window.alert('$msg');
            </script>");
    }
}

//to update item quantity
if(isset($_POST['update'])){
    $uq = $_POST['cart_quantity'];
    $ui = $_POST['cart_id'];
    mysqli_query($conn, " UPDATE `cart` SET quantity = '$uq' WHERE id = '$ui' ");
    $msg = 'Item numbers updated';
        echo ("<script LANGUAGE='JavaScript'>
            window.alert('$msg');
            </script>");
}

//to remove items from cart
if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($conn, " DELETE FROM `cart` WHERE id= '$remove_id' ");
}

//to dlt a;; cart items
if(isset($_GET['delete_all'])){
    mysqli_query($conn, " DELETE FROM `cart` WHERE user_id= '$user_id' ");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products-page</title>

    <!--custom style link-->
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

    <div class="container">

        <h1 class="heading">Mobile Shoppe</h1>
        <div class="user-profile">
            <?php
                $su = " SELECT * FROM `login` WHERE id = '$user_id' ";
                $select_user = mysqli_query($conn, $su) or die("query failed!");

                if(mysqli_num_rows($select_user)>0){
                    $fetch_user = mysqli_fetch_assoc($select_user);
                }
            ?>

            <p>Username: <span><?php echo $fetch_user['username'];?></span></p>
            <p>Email: <span><?php echo $fetch_user['email'];?></span></p>
            <div class="flex">
                <a href="#products" class="btn">Products</a>
                <a href="#shopping-cart" class="cart-btn">shopping-Cart</a>
                <a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('Are you sure?');" class="log-btn">Logout</a>
            </div>
        </div>


        <div class="products" id="products">

        <h1 class="heading">Latest Products</h1>
            <div class="box-container">
                <?php
                    $sp = " SELECT * FROM `products` ";
                    $spq = mysqli_query($conn, $sp);
                    while($result = mysqli_fetch_array($spq))
                    {
                ?>

                <form action="#" class="box" method="post">
                    <img src="./images/<?php echo $result['image'];?>" alt="">
                    <div class="name"><?php echo $result['name'];?></div>
                    <div class="price">$<span><?php echo $result['price'];?></span></div>
                    <input type="number" name="quantity" min="1" value="1">
                    <input type="hidden" name="pro_name" value="<?php echo $result['name'];?>">
                    <input type="hidden" name="pro_image" value="<?php echo $result['image'];?>">
                    <input type="hidden" name="pro_price" value="<?php echo $result['price'];?>">
                    <input type="submit" value="Add to cart" name="add" class="btn">
                </form>

                <?php                            
                    }
                ?>
            </div>
        </div>
    

        <!--shopping cart-->
        <div class="shopping-cart" id="shopping-cart">
            <div class="heading">Shopping cart</div>

            <table>
                <thead>
                    <th>image</th>
                    <th>name</th>
                    <th>price</th>
                    <th>quantity</th>
                    <th>total price</th>
                    <th>action</th>
                </thead>

                <tbody>
                <?php

                    $grand_total=0;

                    $cp = " SELECT * FROM `cart` WHERE user_id = '$user_id' ";
                    $cpq = mysqli_query($conn, $cp);
                    while($result = mysqli_fetch_array($cpq))
                    {
                ?>

                    <tr>
                        <td><img src="./images/<?php echo $result['image'];?>"  height="100px"></td>
                        <td><?php echo $result['name']; ?></td>
                        <td><?php echo $result['price']; ?></td>
                        <td>
                            <form action="#" method="POST">
                                <input type="hidden" name="cart_id" value="<?php echo $result['id'];?>">
                                <input type="number" name="cart_quantity" min="1" value="<?php echo $result['quantity'];?>" >
                                <input type="submit" value="update" name="update" class="cart-btn">
                            </form>
                        </td>
                        <td>$<?php echo $sub_total= number_format($result['price']* $result['quantity']);?></td>
                        <td><a href="index.php?remove=<?php echo $result['id'];?>" class="log-btn"
                        onclick="return confirm('remove item from cart?');">Remove</a></td>
                    </tr>

                <?php
                    $grand_total += $sub_total;
                    }
                ?>

                <tr class="table-bottom">
                    <td colspan="4">Grand total: </td>
                    <td>$<?php echo $grand_total;?></td>
                    <td><a href="index.php?delete_all" onclick="return confirm('reutrn all items from cart?');" class="log-btn">Delete All</a></td>
                </tr>
                </tbody>
            </table>

            <div class="cart-btn">
                <a href="#" class="btn <?php echo ($grand_total >1)?'':'disabled';?>">Proceed To Checkout</a>
            </div>
        </div>

    </div>
</body>
</html>