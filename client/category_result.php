<?php
include('../myfunctions.php');

if (isset($_GET['product_cat_id'])) {
    $category_id = $_GET['product_cat_id'];

    $products = getProductsByCategory($category_id);

    if ($products !== false && mysqli_num_rows($products) > 0) {
        $productHtml = '';
        while ($product = mysqli_fetch_assoc($products)) {
            $productHtml .= '
                <section class="row">
                    <div class="card">
                        <div class="card-img">
                            <img src="../uploads/' . $product['product_image'] . '" alt="product_image" width="100">
                        </div>
                        <div class="card-title">' . $product['product_name'] . '</div>
                        <div class="card-subtitle">' . $product['product_desc'] . '</div>
                        <hr class="card-divider">
                        <div class="card-footer">
                            <div class="card-price"><span>₱</span>' . $product['product_price'] . '</div>
                            <form action="process_add_to_cart.php" method="get">
                                <div class="quantity">
                                    <input type="hidden" name="product_id" value="' . $product['product_id'] . '">
                                    <input type="number" name="qty" value="1" min="1" class="quantity-input" style="width: 40px;">
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="24" height="24">
                                        <path d="m397.78 316h-205.13a15 15 0 0 1 -14.65-11.67l-34.54-150.48a15 15 0 0 1 14.62-18.36h274.27a15 15 0 0 1 14.65 18.36l-34.6 150.48a15 15 0 0 1 -14.62 11.67zm-193.19-30h181.25l27.67-120.48h-236.6z"></path>
                                        <path d="m222 450a57.48 57.48 0 1 1 57.48-57.48 57.54 57.54 0 0 1 -57.48 57.48zm0-84.95a27.48 27.48 0 1 0 27.48 27.47 27.5 27.5 0 0 0 -27.48-27.47z"></path>
                                        <path d="m368.42 450a57.48 57.48 0 1 1 57.48-57.48 57.54 57.54 0 0 1 -57.48 57.48zm0-84.95a27.48 27.48 0 1 0 27.48 27.47 27.5 27.5 0 0 0 -27.48-27.47z"></path>
                                        <path d="m158.08 165.49a15 15 0 0 1 -14.23-10.26l-25.71-77.23h-47.44a15 15 0 1 1 0-30h58.3a15 15 0 0 1 14.23 10.26l29.13 87.49a15 15 0 0 1 -14.23 19.74z"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </section>
            ';
        }
        echo json_encode(array('html' => $productHtml));
    } else {
        echo json_encode(array('error' => 'No products found or error fetching products'));
    }
} else {
    echo json_encode(array('error' => 'Category ID not provided'));
}
?>
