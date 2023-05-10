<?php

if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['Admin', 'Pilot'])) {
    header('Location: /');
    die();
}

?>
<title>Nternship | Users</title>
<?php include('views/components/header.php') ?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Banner -->
<div class="banner text-center">
    <h1>Users</h1>
    <p>On our website you'll find your internship</p>
</div>
<!-- Search internship -->
<div class="search-box text-center">
    <form method="POST" action="/Users/Search">
        <div>
            <i class="fa-solid fa-magnifying-glass"></i><input type="text" class="form-control" name="InputSearchName" placeholder="Name" id="WhoSearchName" />
        </div>
        <div>
            <i class="fa-solid fa-magnifying-glass"></i><input type="text" class="form-control" name="InputSearchFirst" placeholder="First Name" id="WhoSearchFirst" />
        </div>
        <input type="submit" class="btn btn-primary" value="Search user">
    </form>
</div>

<!-- Internship container-->
<div class="content-container" id="internship-container">
    <!-- Buttons -->
    <div class="button-container">
        <div class="btn-group" role="group">
            <a href="/users/index" class="btn btn-filter active" id="All">All</a>
            <a href="/users/student" class="btn btn-filter" id="Student">Student</a>
            <a href="/users/delegate" class="btn btn-filter" id="Delegate">Delegate</a>
            <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['Admin'])) :?>
                <a href="/users/pilot" class="btn btn-filter" id="Pilot">Pilot</a>
            <?php endif; ?>
        </div>
        <!-- Create a new offer button -->
        <div class="add-button-container">
            <a class="btn" href="/users/create" id="add-button"><i class="fa-solid fa-square-plus"></i>Add User</a>
        </div>
    </div>
    <!-- Internship brief container -->
    <div class="content-brief-container" id="internship-brief-container">
        <!-- Cards generation from BDD -->
        <?php foreach ($users as $users) : ?>
            <a href="/users/read/<?= $users['id_user'] ?>">
                <div class="card" id="card">
                    <div class="card-header">
                        <h3><?= $users['first_name'] ?> <?= $users['name'] ?></h4>
                            <h5><?= $users['Email'] ?></h5>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Birthdate <?= $users['birthdate'] ?></li>
                            <li>Gender : <?= $users['gender'] ?></li>
                            <li>Phone Number : <?= $users['phone_number'] ?></li>
                            <li>Statut : <?= $users['role'] ?></li>
                            <li>Campus : <?= $users['campus'] ?></li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <div class="button">
                            <a href="/users/Edit/<?= $users['id_user'] ?>" class="btn"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            <a href="/users/Delete/<?= $users['id_user'] ?>" class="btn btn-delete"><i class="fa-solid fa-xmark"></i> Delete</a>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<?php include('views/components/footer.php') ?>