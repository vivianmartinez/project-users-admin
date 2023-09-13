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
    <script type="text/javascript" src="<?=url_base?>views/assets/js/scripts.js"></script>
</head>
<body>
    <header class="mb-5">
    <?php 
        $isLogged = false;
    if(isset($_SESSION['user_logged'])):
        $isLogged = true;
    endif;    
    ?>
    <nav class="navbar navbar-expand-md navbar-expand-sm navbar-light fixed-top bg-light py-3 px-5">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item d-flex">
                <i class="fa-solid fa-house-user mt-2"></i>
                <a class="nav-link" href="<?=url_base?>user/management">Home</a>
            </li>
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
        <!--
        <div class="container-fluid" >
            <div class="d-flex justify-content-around">
              
                
                <ul class="navbar-nav">
                    <?php if(!$isLogged):?>
                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="<?=url_base?>login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="<?=url_base?>user/register">Register</a>
                    </li>
                    <?php endif; ?>
                    <?php if($isLogged):?>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="<?=url_base?>login/signout">Logout</a>
                        </li>
                    <?php endif; ?>
                </ul>
                
            </div>
        </div>
                    -->
    </nav>
    </header>
    <main class="container-fluid pb-5 pt-5">
    

    
