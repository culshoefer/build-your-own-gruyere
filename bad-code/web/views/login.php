<?php
/**
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @copyright 2017
 * @license http://opensource.org/licenses/gpl-license.php MIT License
 * Diplays login depending on session (e.g. we need to display errors on trying to register)
 */

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Log In</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

    <link rel="stylesheet" href="style.css" media="screen" title="no title">

    <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>

</head>
<body>

<nav>
    <div class="nav-wrapper container">
        <a href="homepage" class="brand-logo">Home</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="login">Login</a></li>
            <li><a href="login">Sign Up</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="card">
        <span class="card-title">Login</span>
        <div class="card-content">
            <form class="" method="post">
                <div class="input-field">
                    <input type="text" placeholder="username" class="validate">
                </div>
                <div class="input-field">
                    <input type="password" placeholder="password" class="validate">
                </div>
                <button class="btn">Login</button>
                <button class="btn">Register</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
