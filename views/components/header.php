<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"/>
    <link rel="stylesheet" href="/views/assets/style.css"/>
    <!-- PWA -->
    <link rel="manifest" crossorigin="use-credentials" href="manifest.json"/>
    <link rel="apple-touch-icon" href="/views/assets/PWA_icons/NternshipIcon-96px.png"/>
    <meta name="theme-color" content="black"/>
    <title>Nternship | Internships</title>
</head>

<body>
    <!-- Header -->
    <header>
        <!-- Flex container -->
        <div class="menu-bar">
            <!-- Logo -->
            <div>
                <a href="/"><img src="/views/assets/logo.png" alt="logo" id="logo"></a>
            </div>
            <!-- Navbar -->
            <div class="navbar">
                <ul class="nav nav-pills justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" href="/InternshipOffer">Internships</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/company/index">Companies</a>
                    </li>
                </ul>
            </div>
            <!-- Account dropdown menu -->
            <div>
                <img src="/views/assets/img_243887.png" alt="account" class="btn dropdown-toggle float-end" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                <?php include('views/components/menu.php') ?>
            </div>
        </div>
    </header>