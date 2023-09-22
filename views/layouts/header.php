<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users admin</title>
    <link href="<?=url_base?>views/assets/css/styles.css" rel="stylesheet" >
    <!--Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<!--Bootstrap JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
	<!--Fontawesome	-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>

</head>
<body>
<header class="py-4 border-bottom bg-light fixed-top">
    <!--<header class="mb-5">-->
    <?php 
        $isLogged = false;
    if(isset($_SESSION['user_logged'])):
        $isLogged = true;
    endif;    
    ?>
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start ">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <?php if($isLogged):?>
            <li class="d-flex">
                <i class="fa-solid fa-house-user mt-2"></i>
                <a href="<?=url_base?>user/management" class="nav-link px-2">Users</a>
            </li>
          <?php endif; ?>
          <?php if(!$isLogged):?>
            <li><a href="<?=url_base?>login" class="nav-link px-2">Login</a></li>
            <li><a href="<?=url_base?>user/register" class="nav-link px-2">Sign up</a></li>
          <?php endif; ?>
        </ul>
        <?php if($isLogged):?>
            <form id="form-search" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" action="<?=url_base?>user/search" method="POST">
                <input id="search-user" type="search" class="form-control" placeholder="Search user..." aria-label="Search" name="search_user">
            </form>
            <div class="dropdown text-end">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?=url_base?>storage/images/<?=$_SESSION['user_logged']->image?>" alt="mdo" width="40" height="40" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                    <li><div class="dropdown-item fw-bold"><?=$_SESSION['user_logged']->user_name?></div></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="<?=url_base?>user/profile&id=<?=$_SESSION['user_logged']->id?>">Profile</a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="<?=url_base?>login/signout">Sign out</a></li>
                </ul>
            </div>
        <?php endif; ?>
      </div>
    </div>
</header>
<main class="container-fluid py-5 mt-5">
    

    
