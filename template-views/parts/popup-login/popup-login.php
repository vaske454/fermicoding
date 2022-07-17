<?php
//start session

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
        <span>Niste uneli username.</span>
        <?php
        array_push($errors, "Please enter a valid username");
    } elseif (empty($password)) { ?>
        <span>Niste uneli password.</span>
        <?php
        array_push($errors, "Please enter a valid password.");
    } else {
        // Check if the user may be logged in
        if (!$user->login($username, $password)) { ?>
            <span>Pogresan username i/ili password.</span><?php
            array_push($errors, "Incorrect log-in credentials.");
        }
    }
}
if (isset($_GET['logout']) && ($_GET['logout'] == 'true')) {
    $user->log_out();
    $user->redirect('index.php');
}
if ($user->is_logged_in()):
?>
<p>Hello, <?php echo $username . '!'; ?></p>
<?php endif; ?>
<a style="display: <?= ($user->is_logged_in() ) ? 'none' : 'block'; ?>" href="javascript:;" class="js-open-login-popup">
    <span class="login-text">Login</span>
</a>
<div style="display: none;" class="js-popup-login modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <form action="<?= $url; ?>" method="POST" class="login__form">
        <div class="d-flex flex-column align-items-center justify-content-center">

            <h1 class="pb-3">Sign In</h1>
            <button class="js-close-popup" type="button">Close</button>
            <label for="username"></label>
            <input type="text" name="username" class="login__form__input" id="username" placeholder="Enter username">

            <label for="password"></label>
            <input type="password" name="password" class="login__form__input" id="password" placeholder="Password">

            <input type="submit" class="login-btn mt-3" name="log_in" value="Sign in">
        </div>
    </form>
</div><!-- .js-popup-login -->
    <a style="display: <?= (!$user->is_logged_in() ) ? 'none' : 'block'; ?>" class="site-header__icon" href="?logout=true">
        <span class="site-header__icon-text"><?php echo 'Log Out'; ?></span>
    </a>


<?php
date_default_timezone_set('Europe/Belgrade');
$apiKey = '42edc93da664412ca69569d0d6894312';
$cityId = '3194360';
$url = "https://api.openweathermap.org/data/2.5/weather?id=" .$cityId.'&lang=en&units=metric&APPID='.$apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTemperature = isset($data->main->temp) ? $data->main->temp : '';
?>

<?php if ($currentTemperature && $user->is_logged_in()): ?>
    <div class="weather-block">
        <p>Current temperature: <?php echo $currentTemperature . '&#176;C'; ?></p>
    </div><!-- .weather-block -->
<?php endif; ?>