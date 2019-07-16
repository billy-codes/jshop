<?php
session_start();

if(!isset($_SESSION['logged_in'])){
    $nav = 'includes/nav.php';
}else{
    $nav = 'includes/navconnected.php';
    $idsess = $_SESSION['id']; // store session ID in a variable
}

require 'includes/header.php';
require $nav;
?>

<div class="container-fluid home" id="top">
    <div class="container search">
        <nav class="animated slideInUp wow">
            <div class="nav-wrapper">
                <form method="GET" action="search.php">
                    <div class="input-field">
                        <input id="search" class="searching" type="search" name="searched" required>
                        <label for="search"><i class="material-icons">search</i></label>
                        <i class="material-icons">close</i>
                    </div>
                    <div class="center-align">
                        <button type="submit" name="search" class="blue waves-light miaw waves-effect btn hide">Search</button>
                    </div>
                </form>
            </div>
        </nav>
    </div>
</div>

<!-- PRODUCT SECTION START -->
<div class="container most">
    <div class="row">
<?php
    $queryfirst = " SELECT
                    product.id as 'id',
                    product.name as 'name',
                    product.price as 'price',
                    product.thumbnail as 'thumbnail',

                    SUM(command.quantity) as 'total',
                    command.statut,
                    command.id_produit

                    FROM product, command
                    WHERE product.id = command.id_produit AND command.statut = 'paid'
                    GROUP BY product.id
                    ORDER BY SUM(command.quantity) 
                    DESC LIMIT 3";

                    $resultfirst = $connection->query($queryfirst);
                    if ($resultfirst->num_rows > 0) {
                    // output data of each row
                        while($rowfirst = $resultfirst->fetch_assoc()) {
                            $product_id = $rowfirst['id'];
                            $product_name = $rowfirst['name'];
                            $product_price = $rowfirst['price'];
                            $product_thumbnail = $rowfirst['thumbnail'];
                            $totalsold = $rowfirst['total'];
?>
        <div class="col s12 m4">    
            <div class="card hoverable animated slideInUp wow">
                <div class="card-image">
                  <a href="product.php?id=<?= $product_id;  ?>"><img src="products/<?= $product_thumbnail; ?>"></a>
                  <span class="card-title red-text"><?= $product_name; ?></span>
                  <a href="product.php?id=<?= $product_id; ?>" class="btn-floating red halfway-fab waves-effect waves-light right"><i class="material-icons">add</i></a>
                </div>
                <div class="card-content">
                    <div class="container">
                      <div class="row">
                        <div class="col s6">
                          <p class="white-text"><i class="left fa fa-dollar"></i> <?= $product_price; ?></p>
                        </div>
                        <div class="col s6">
                          <p class="white-text"><i class="left fa fa-shopping-basket"></i> <?= $totalsold; ?></p>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }} ?>
    </div>
</div>
<!-- PRODUCT SECTION END -->

<!-- CATEGORIES SECTION START -->
<div class="container-fluid center-align categories">
    <a href="#category" class="button-rounded btn-large waves-effect waves-light">
        Categories 
    </a>
    <div class="container" id="category">
        <div class="row">
        <?php
        //get categories
        $querycategory = "SELECT id, name, icon  FROM category";
        $total = $connection->query($querycategory);
        if ($total->num_rows > 0) {
        // output data of each row
        while($rowcategory = $total->fetch_assoc()) {
            $id_category = $rowcategory['id'];
            $name_category = $rowcategory['name'];
            $icon_category = $rowcategory['icon'];
        ?>
            <div class="col s12 m4">
                <div class="card hoverable animated slideInUp wow">
                    <div class="card-image">
                        <a href="category.php?id=<?= $id_category; ?>"><img src="src/img/<?= $icon_category; ?>.png" alt=""></a>
                        <span class="card-title black-text"><?= $name_category; ?></span>
                    </div>
                </div>
            </div>
        <?php }} ?>
        </div>
    </div>
</div>
<!-- CATEGORIES SECTION END -->

<!-- ABOUT SECTION START -->
<div class="container-fluid about" id="about">
    <div class="container">
        <div class="row">
            <div class="col s12 m6">
                <div class="card animated slideInUp wow">
                    <div class="card-image">
                        <img src="src/img/about.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <h3 class="animated slideInUp wow">About Us</h3>
                <div class="divider animated slideInUp wow"></div>
                <p class="animated slideInUp wow">
                    For 25 years jShop has been one of the most trusted names in 
                    jewelry in Malaysia. We are a well-established jewelry store 
                    that has grown with our community from a small store to a multiple 
                    brand jewelry retailer. jShop is committed to make every customer 
                    "feel at home" with our personalized service and our classic to 
                    cutting edge jewelry designs. Our years of experience and services 
                    have built a legacy of integrity and trust with our customers.</p>
            </div>
        </div>
    </div>
</div>
<!-- ABOUT SECTION END -->

<?php
require 'includes/secondfooter.php';
require 'includes/footer.php';
?>