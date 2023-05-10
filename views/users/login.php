<title>Nternship | Users</title>
<?php include('views/components/header.php') ?>
<link rel="stylesheet" href="/views/assets/signin.css">




<div class="login-page">
    <div class="form">
        <form method="POST" class="login-form" action="/users/login" id="UsersLoginForm">
            <input type="email" placeholder="E-Mail" name="email" id="email" />
            <input type="password" placeholder="Password" name="password" id="password" />
            <button type="Submit">login</button>
        </form>
    </div>
</div>

<?php include('views/components/footer.php') ?>