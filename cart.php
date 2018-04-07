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

    unset($_SESSION['nbItemCart']);

    header('Location: cart.php');
}

//Cas suppression une commande
if (!empty($_GET['clearOrder']) && !empty($_COOKIE['items'])){
    $items = unserialize($_COOKIE['items']);

    //on ajuste le nombre d'artivcle dans le panier en fonction de la quantity de l'article supprimé
    $quantityItem = $items[$_GET['clearOrder']]['quantity'];
    if (!empty($quantityItem)) {
        $_SESSION['nbItemCart'] -= $quantityItem;
    }

    unset($items[$_GET['clearOrder']]);

    //Affectation du nouveau tableau cookie
    setcookie("items", serialize($items), time() + (0.5*60));

    header('Location: cart.php');
}


//Init items
if (isset($_COOKIE['items'])) {
$items = unserialize($_COOKIE['items']);
}
?>

<section class="cookies container-fluid">
    <div class="row">
        <?php if (!empty($items)) { ?>
        <a href="?clearCart=1" class="btn btn-info">Vider votre panier</a>
        <?php } else { ?>
        <a href="index.php" class="btn btn-primary">Retour à la boutique</a>
        <?php } ?>
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

if (!empty($items)) {
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
