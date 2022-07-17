<?php
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
// Append the host(domain name, ip) to the URL.
$url.= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL
$url.= $_SERVER['REQUEST_URI'];

// Check if log-in form is submitted
if (isset($_POST['log_in'])) {
    // Retrieve form input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    // Check for empty and invalid inputs
    if (empty($username)) { ?>
        <span class="js-login-error-message">Niste uneli username.</span>
        <?php
        array_push($errors, "Please enter a valid username");
    } elseif (empty($password)) { ?>
        <span class="js-login-error-message">Niste uneli password.</span>
        <?php
        array_push($errors, "Please enter a valid password.");
    } else {
        // Check if the user may be logged in
        if (!$user->login($username, $password)) { ?>
            <span class="js-login-error-message">Pogresan username i/ili password.</span><?php
            array_push($errors, "Incorrect log-in credentials.");
        }
    }
}
if (isset($_GET['logout']) && ($_GET['logout'] == 'true')) {
    $user->log_out();
    $user->redirect('index.php');
}
?>
<div class="login-nav">
    <a style="display: <?= ($user->is_logged_in() ) ? 'none' : 'block'; ?>" href="javascript:;" class="login-button js-open-login-popup">
        <span class="login-text">Uloguj se</span>
    </a>
</div>
<div style="display: none;" class="js-popup-login modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <form action="<?= $url; ?>" method="POST" class="login__form">
        <div class="d-flex flex-column align-items-center justify-content-center">

            <h1 class="pb-3">Sign In</h1>
            <button class="btn-close js-close-popup" type="button">Close</button>
            <label for="username"></label>
            <input type="text" name="username" class="login__form__input" id="username" placeholder="Enter username">

            <label for="password"></label>
            <input type="password" name="password" class="login__form__input" id="password" placeholder="Password">

            <input type="submit" class="btn login-btn mt-3" name="log_in" value="Sign in">
        </div>
    </form>
</div><!-- .js-popup-login -->
