<?php include('views/components/header.php') ?>
<!-- Banner -->
<div class="banner text-center">
    <h1>INTERNSHIP FOR YOU</h1>
    <p>On our website you'll find your internship</p>
    <?php if (!isset($_SESSION['role'])) : ?>
        <p><a href="/Users/Login/" class=""> Log In</a> to find your internship</p>
    <?php else : ?>
        <p>You are connected as <?= $_SESSION['role'] ?></p>
    <?php endif; ?>
</div>
<?php include('views/components/footer.php') ?>