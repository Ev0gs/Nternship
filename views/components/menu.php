<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">

    <?php if (isset($_SESSION['role']) && !in_array($_SESSION['role'], ['Admin', 'Pilot'])) : ?>
        <li><a class="dropdown-item" href="/Wishlist" id="WishlistBtn">My Wishlist</a></li>
        <li><a class="dropdown-item" href="/candidacy/index">My Candidacies</a></li>
        <li><a class="dropdown-item" href="/Users/LogOut" id="LogOutBtn">Log Out</a></li>
    <?php elseif (isset($_SESSION['role']) && in_array($_SESSION['role'], ['Admin', 'Pilot'])) : ?>
        <li><a class="dropdown-item" href="/Users/Index" id="ListUsersBtn">Users</a></li>
        <li><a class="dropdown-item" href="/Candidacy/pilotcandidacies" id="ListUsersOfferBtn">Users Candidacies</a></li>
        <li><a class="dropdown-item" href="/InternshipOffer/Index" id="ListInternshipOfferBtn">Internship Offers</a></li>
        <li><a class="dropdown-item" href="/Company/Index" id="ListCompanyOfferBtn">Companies</a></li>
        <li><a class="dropdown-item" href="/Users/LogOut" id="LogOutBtn">Log Out</a></li>
    <?php else : ?>
        <li><a class="dropdown-item" href="/internshipOffer/index">Internships</a></li>
        <li><a class="dropdown-item" href="/Company/Index" id="ListCompanyOfferBtn">Companies</a></li>
        <li><a class="dropdown-item" href="/Users/login" id="LogInBtn">Log In</a></li>
    <?php endif ?>
</ul>