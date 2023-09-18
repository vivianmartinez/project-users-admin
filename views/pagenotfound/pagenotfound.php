<div class="d-block text-center h-auto content">
    <div class="mb-4">
        <h1>404</h1>
        <p>Página no encontrada</p>
    </div>
    <?php if(isset($_SESSION['user_logged'])): ?>
        <a href="<?=url_base?>user/profile&id=<?=$_SESSION['user_logged']->id?>" class="btn btn-warning">Back</a>
    <?php endif; ?>
</div>