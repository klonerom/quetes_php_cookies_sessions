<?php
require 'inc/head.php';

//Sign in ko - redirection to login
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
}

if (isset($_COOKIE["id_product"])) {
    $idProduct = (int) $_COOKIE["id_product"];

    switch ($idProduct) {
        case 32 :
            $nameProduct = "M&M's© cookies";
            break;
        case 36 :
            $nameProduct = "Chocolate chips";
            break;
        case 46 :
            $nameProduct = "Pecan nuts";
            break;
        case 58 :
            $nameProduct = "Chocolate cookie";
            break;
    }
}


?>
<section class="cookies container-fluid">
    <div class="row">
        TODO : Display shopping cart items from $_COOKIES here.

        <table style="width:100%;margin:30px;">
            <tr>
                <th>id produit</th>
                <th>nom du produit</th>
                <th>tarif</th>
            </tr>
            <tr>
                <td><?= $idProduct ?></td>
                <td><?= $nameProduct ?></td>
                <td></td>
            </tr>
        </table>

    </div>
</section>
<?php require 'inc/foot.php'; ?>
