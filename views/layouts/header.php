<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Administrator</title>
    <link href="<?=url_base?>views/assets/css/styles.css" rel="stylesheet" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Latest compiled JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

	<!--Latest compiled Fontawesome	-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>

	<!--jquery -->
	<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
</head>
<body>
    <?php 
        $isLogged = false;
    if(isset($_SESSION['user_logged'])):
        $isLogged = true;
    endif;    
    ?>
    <nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top pt-3 d-flex">
        <div class="container-fluid justify-content-center " >
            <div><i class="fa-solid fa-house-user"></i></div>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=url_base?>user/management">Home</a>
                    </li>
                </ul>
                <ul class="navbar-nav d-flex">
                    <?php if(!$isLogged):?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=url_base?>login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=url_base?>user/register">Register</a>
                    </li>
                    <?php endif; ?>
                    <?php if($isLogged):?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=url_base?>login/signout">Logout</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

