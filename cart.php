<?php 
session_start();

$grandTotal = 0;
if(isset($_SESSION['cart']) &&  count($_SESSION['cart']) > 0){
    foreach($_SESSION['cart'] as $item){
        $itemTotal = $item['producttotal']; 
        $grandTotal += $itemTotal;
    } 
} 


?>

<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/pages/icon.png" type="image/png">
    <title>Clover Cart</title>
    <link rel="stylesheet" href="vender/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vender/icofont/icofont.min.css">
    <link rel="stylesheet" href="vender/aos/dist/aos.css">
    <link rel="stylesheet" href="vender/remixicon/remixicon.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/common.css">
</head>

<body data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0">



    <?php include('loader.php')?>
    <div class="bg-menu">

        <?php include('header.php') ?>

        <div class="container py-5 my-5">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="text-center text-white">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb d-flex align-items-center justify-content-center gap-1"
                                data-aos="fade-up" data-aos-duration="600">
                                <li class="breadcrumb-item text-white small"><a href="#" class="link-light">HOME
                                    </a></li>
                                <li><i class="ri-arrow-right-s-line"></i></li>
                                <li class="breadcrumb-item text-white small active" aria-current="page">MY CART </li>
                            </ol>
                        </nav>
                        <h1 class="display-1" data-aos="fade-up" data-aos-duration="600">MY CART </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row">

            <div class="col-md-6">
                <h2>
                    <p>My Cart</p>
                </h2>
            </div>
            <div class="col-md-6">
                <a href="clear-cart.php" class="btn btn-light btn-lg rounded-0 float-end">Clear Cart </a>
            </div>
          
        </div>
    </div>



        <div class="container pb-5">
            <div class="row g-5">
            <div class="col-lg-8 col-12 pe-lg-5">
    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <th class="pb-3 px-0" scope="col">Product</th>
                    <th class="pb-3 px-3" scope="col">Quantity</th>
                    <th class="pb-3 px-4 text-end" scope="col">Subtotal</th>
                    <th class="pb-3 px-0 text-end" scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $grandTotal = 0;
                foreach($_SESSION['cart'] as $item): 
                    $itemTotal = $item['producttotal']; 
                    $grandTotal += $itemTotal;
                ?>
                <tr>
                    <td class="py-3 align-middle">
                        <h6><b><?php echo htmlspecialchars($item['productname']); ?></b></h6>
                        <p class="m-0"><?php echo htmlspecialchars($item['productprice']); ?></p>
                        <p>Addons: <?php echo htmlspecialchars($item['modifiername']); ?> $<?php echo htmlspecialchars(number_format($item['modifierprice'], 2)); ?></p>
                    </td>
                    <td class="py-3 px-3 align-middle product-row">
                        <div class="input-group d-flex align-items-center justify-content-between quantity-osahan">
                            <a href="itemqty.php?action=remove&productID=<?php echo $item['productid']; ?>">
                                <button class="btn btn-outline-secondary" id="decrement-item-btn" type="button">-</button>
                            </a>
                            <input type="text" class="form-control quantity-input" value="<?php echo htmlspecialchars($item['productqty']); ?>" readonly>
                            <a href="itemqty.php?action=add&productID=<?php echo $item['productid']; ?>">
                                <button class="btn btn-outline-secondary" id="increment-item-btn" type="button">+</button>
                            </a>
                        </div>
                    </td>
                    <td class="py-3 px-4 text-end align-middle">
                        $<?php echo htmlspecialchars(number_format($itemTotal, 2)); ?>
                    </td>
                    <td class="py-3 px-0 text-end align-middle">
                        <a href="remove-item.php?productID=<?php echo $item['productid']; ?>"><i class="ri-delete-bin-fill text-danger"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Show Apply Coupon form only if the cart has items -->
        <div class="d-md-flex align-items-center justify-content-between">
            <form class="d-flex gap-2 mb-2 mb-lg-0" role="search">
                <input class="form-control" type="search" placeholder="Coupon Code" aria-label="Search">
                <button class="btn btn-dark" type="submit">Apply</button>
            </form>
        </div>

    <?php else: ?>
        <!-- Show this only if the cart is empty -->
        <div class="row">
            <div class="col-md-3 mx-auto text-center">
                <img src="img/nodata-icons/empty-cart.png" class="w-100">
                <p class="mt-3">Your Cart is Empty.</p>
                <a href="menu.php" class="btn btn-success btn-lg rounded-0" data-aos="fade-up" data-aos-duration="600">
                    Shop Now
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>


                <div class="col-lg-4 col-12">
                    <div class="border p-4 rounded-4">
                        <h6 class="fw-bold pb-3">Cart total </h6>
                        <div class="d-flex align-items-center justify-content-between border-bottom py-3">
                            <h6 class="mb-0">Subtotal </h6>
                            <p class="mb-0">$<?php echo $grandTotal ?> </p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between py-3 fw-bold mb-4">
                            <h5 class="mb-0 fw-bold">Total </h5>
                            <p class="mb-0 h5 fw-bold">$<?php echo $grandTotal ?></p>
                        </div>
                        <a href="checkout.php" class="btn btn-purple px-3 py-3 w-100">Proceed to checkout </a>
                    </div>
                </div>
            </div>
        </div>


    <?php include('footer.php') ?>
    <?php include('sidenav.php') ?>

    <script src="vender/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vender/jquery/jquery-3.6.4.min.js"></script>
    <script src="vender/aos/dist/aos.js"></script>
    <script src="js/script.js"></script>
    <button id="back-to-top" title="Go to top" style="display: none;">Top</button>


</body>

</html>