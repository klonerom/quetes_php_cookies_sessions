<?php
require 'inc/head.php';

//Sign in ko - redirection to login
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
}

?>
<section class="cookies container-fluid">
    <div class="row">
      TODO : Display shopping cart items from $_COOKIES here.
    </div>
</section>
<?php require 'inc/foot.php'; ?>
