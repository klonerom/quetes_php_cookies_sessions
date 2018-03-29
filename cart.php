<?php
require 'inc/head.php';

//Sign in ko - redirection to login
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
}

//Cas vider le panier
if (!empty($_GET['clearCart']) && isset($_COOKIE)){
    // Suppression du fichier cookie
    setcookie('items', '', time() - 3600, '/');

    header('Location: cart.php');
}

//Cas suppression une commande
if (!empty($_GET['clearOrder'])){
    $items = unserialize($_COOKIE['items']);

    unset($items[$_GET['clearOrder']]);

    //Affectation du nouveau tableau cookie
    setcookie("items", serialize($items), time() + (0.5*60));

    header('Location: cart.php');
}

?>

<section class="cookies container-fluid">
    <div class="row">
        <a href="?clearCart=1" class="btn btn-info">Vider votre panier</a>
    </div>
    <div class="row">
        <table style="width:100%;margin:30px;">
            <tr>
                <th>id produit</th>
                <th>nom du produit</th>
                <th>Quantité</th>
                <th>Action</th>
            </tr>

<?php
if (isset($_COOKIE['items'])) {
    $items = unserialize($_COOKIE['items']);

    foreach ($items as $item) {
        ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['description'] ?></td>
                <td><?= $item['quantity'] ?></td>
                <td><a href="?clearOrder=<?= $item['id'] ?>" class="btn btn-danger">Supprimer</a></td>
            </tr>
<?php
    }
}
?>

        </table>

    </div>
</section>
<?php require 'inc/foot.php'; ?>
