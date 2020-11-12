<?php

require __DIR__ . '/vendor/autoload.php';

session_start();

// ######## please do not alter the following code ########
$products = [
    [ "name" => "Sledgehammer", "price" => 125.75 ],
    [ "name" => "Axe",
        "price" => 190.50 ],
    [ "name" => "Bandsaw",
        "price" => 562.131 ],
    [ "name" => "Chisel",
        "price" => 12.9
    ],
    [ "name" => "Hacksaw",
        "price" => 18.45 ],
];
// ########################################################


Products::getInstance()->setProducts($products);

$cartModel = new Cart();

if (isset($_GET['action'])) {
    switch (trim($_GET['action'])) {
        case 'add':
            $product = $_GET['product'];
            $cartModel->addProduct($product);

            break;
        case 'delete':
            $product = $_GET['product'];
            $cartModel->deleteProduct($product);

            break;
    }
}

?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PHP App</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Product List</h2>
                <div class="row">

                    <?php
                    foreach (Products::getInstance()->getProducts() as $product) {
                        ?>
                        <div class="col-md-6">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <h4 class="title"><?= $product['name']; ?></h4>
                                    <div class="price-new"><?= Products::priceNormalize($product['price']); ?></div>
                                    <a href="?action=add&product=<?= $product['name']; ?>" class="btn btn-sm btn-primary float-right">Add to cart</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
            <div class="col-md-6">
                <h2>My Cart</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    foreach ($cartModel->getCart() as $item) {
                        ?>
                        <tr>
                            <td><strong><?= $item['product']['name'] ;?></strong></td>
                            <td><?= Products::priceNormalize($item['product']['price']); ?></td>
                            <td title="Quantity"><?= $item['quantity'] ;?></td>
                            <td><?= Products::priceNormalize($item['product']['price'] * $item['quantity']); ?></td>
                            <td class="text-center"><a href="?action=delete&product=<?= $item['product']['name']; ?>" class="btn btn-xs btn-danger my-product-remove">X</a></td>
                        </tr>
                        <?php
                    }
                    ?>

                    </tbody>
                    <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-right"><strong>Total:</strong></td>
                        <td><strong><?= Products::priceNormalize($cartModel->getTotal()) ;?></strong></td>
                        <td></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</body>
</html>