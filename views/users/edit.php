<?php

if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['Admin', 'Pilot'])) {
    header('Location: /');
    die();
}

?>
<title>Nternship | Users</title>
<?php include('views/components/header.php') ?>

<link rel="stylesheet" href="/views/assets/signup.css">



<div class="container rounded bg-white mt-5 mb-5">
    <form method="POST" action="/users/edit/<?= $users['id_user'] ?>" id="UsersUpdateForm">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">CESI</span><span class="text-black-50">xxxxxxx@viacesi.fr</span><span> </span></div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">First Name</label><input type="text" class="form-control" placeholder="First name" value="<?= $users['first_name'] ?>" name="firstname" id="firstname" required></div>
                        <div class="col-md-6"><label class="labels">Last name</label><input type="text" class="form-control" value="<?= $users['name'] ?>" placeholder="Last name" name="name" id="name" required></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Email</label><input type="email" class="form-control" placeholder="name@example.com" value="<?= $users['Email'] ?>" name="email" id="email" required></div>
                        <div class="col-md-12"><label class="labels">Password</label><input type="password" class="form-control" placeholder="Enter new password" name="password" id="password"></div>
                        <div class="col-md-12"><label class="labels">Phone number</label><input type="tel" class="form-control" placeholder="0123456789" value="<?= $users['phone_number'] ?>" name="phonenumber" id="phonenumber" required></div>
                        <div class="col-md-12"><label class="labels">Birthdate</label><input type="date" class="form-control" placeholder="Enter birthdate" value="<?= $users['birthdate'] ?>" name="birthdate" id="birthdate" required></div>
                        <!-- <div class="col-md-12"><label class="labels">Gender</label><input type="text" class="form-control" placeholder="Enter gender" value="" name="gender" id="gender"></div> -->
                        <div class="col-md-12">
                            <label class="labels">Gender</label>
                            <select class="form-control" value="" name="gender" id="gender" required>
                                <option value="<?= $users['gender'] ?>" selected hidden><?= $users['gender'] ?></option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Autre</option>
                            </select>

                            <label class="labels">Promotion</label>
                            <select class="form-control" value="" name="InputIdPromotion" id="InputIdPromotion">
                                <?php foreach ($promotions as $promotion) : ?>
                                    <option value="<?= $promotion['id_promotion'] ?>" <?= ($users['id_promotion'] === $promotion['id_promotion']) ? "selected" : "" ?>>
                                        <?= $promotion['name_promotion'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Update</button></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Informations</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Address</label><input type="text" class="form-control" placeholder="Enter address" value="<?= $users['postal_address'] ?>" name="postaladdress" id="postaladdress" required></div>
                        <div class="col-md-12"><label class="labels">Additional</label><input type="text" class="form-control" placeholder="Enter additional informations" value="<?= $users['additional'] ?>" name="additional" id="additional"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">City</label><input type="text" class="form-control" placeholder="Enter city" value="<?= $users['city'] ?>" name="city" id="city" required></div>
                        <div class="col-md-12"><label class="labels">Zipcode</label><input type="text" class="form-control" placeholder="Enter postalcode" value="<?= $users['postal_code'] ?>" name="postalcode" id="postalcode" required></div>
                        <div class="col-md-12"><label class="labels">Campus</label><input type="text" class="form-control" placeholder="Enter campus" value="<?= $users['campus'] ?>" name="campus" id="campus" required></div>
                        <div class="col-md-12"><label class="labels">Country</label><input type="text" class="form-control" placeholder="Enter Country" value="France" name="country" id="country"></div>
                    </div>
                    <!-- <div class="col-md-12"><label class="labels">Role</label><input type="text" class="form-control" placeholder="Enter role" value="" name="Inputrole" id="Inputrole"></div> -->
                    <div class="col-md-12">
                        <label class="labels">Role</label>
                        <select class="form-control" name="role" id="role" required>
                            <option value="<?= $users['role'] ?>" selected hidden><?= $users['role'] ?></option>
                            <option>Student</option>
                            <option>Delegate</option>
                            <option>Pilot</option>
                            <option>Admin</option>
                        </select>
                    </div>

                    <br>
                </div>
            </div>

        </div>
    </form>

</div>
<?php include('views/components/footer.php') ?>