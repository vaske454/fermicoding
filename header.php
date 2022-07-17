<?php
require "template-views/parts/popup-login/popup-login.php";
?>
<a style="display: <?= (!$user->is_logged_in() ) ? 'none' : 'block'; ?>" class="btn-logout site-header__icon" href="?logout=true">
    <span class="site-header__icon-text"><?php echo 'Izloguj se'; ?></span>
</a>
<?php
if ($user->is_logged_in()):
    $username = trim($_POST['username']);
    ?>
    <p class="login-text">Zdravo, <?php echo $username . '!'; ?></p>
<?php endif; ?>

