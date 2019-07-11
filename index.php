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

<div class="container most">
    <div class="row">

<?php
// establish database connection


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

       $id_best = $rowfirst['id'];
       $name_best = $rowfirst['name'];
       $price_best = $rowfirst['price'];
       $thumbnail_best = $rowfirst['thumbnail'];
       $totalsold = $rowfirst['total'];

?>
        <div class="col s12 m4">    
            <div class="card hoverable animated slideInUp wow">
                <div class="card-image">
                  <a href="product.php?id=<?= $id_best;  ?>"><img src="products/<?= $thumbnail_best; ?>"></a>
                  <span class="card-title red-text"><?= $name_best; ?></span>
                  <a href="product.php?id=<?= $id_best; ?>" class="btn-floating red halfway-fab waves-effect waves-light right"><i class="material-icons">add</i></a>
                </div>
                <div class="card-content">
                    <div class="container">
                      <div class="row">
                        <div class="col s6">
                          <p class="white-text"><i class="left fa fa-dollar"></i> <?= $price_best; ?></p>
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