<?php
if (!isset($GLOBALS['page_name'])) {
    $GLOBALS['page_name'] = 'Untitled Page';
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $GLOBALS['page_name']; ?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
    <link rel="stylesheet" href="/assets/style.css" media="screen" title="no title">

    <script
            src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

</head>
<body>

<nav>
    <div class="nav-wrapper container">
        <a href="" class="brand-logo"><?php echo $GLOBALS['page_name']; ?></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <?php
            if (!\BYOG\Components\Login::loggedIn()):
                ?>
                <li><a href="/">Home</a></li>
                <li><a href="/login">Login</a></li>
                <li><a href="/login">Sign Up</a></li>
                <?php
            else:
                ?>
                <li><a href="/loggedin">New entry</a></li>
                <li><a href="/mySnippets">My Snippets</a></li>
                <li><a href="/settings">Settings</a></li>
                <li><a href="/logout">Sign out</a></li>
                <?php
            endif;
            ?>
        </ul>
    </div>
</nav>