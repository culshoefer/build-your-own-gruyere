<?php
/**
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @copyright 2017
 * @license http://opensource.org/licenses/gpl-license.php MIT License
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
    <link rel="stylesheet" href="../assets/style.css" media="screen" title="no title">

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

<div class="container" id="allSnippets">
    <h2>List of Users</h2>
    <div class="card">
        <span class="card-title">Username</span>
        <div class="card-content">
            <p>
                Snippet
                Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
            </p>
            <a href="#">Link for each user</a>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $.get('/api/overview' function(data) {
            function addChild(username, last_snippet) {
                $('#allSnippets').append('<div class="card"> \
                                            <span class="card-title">' + username + '</span>\
                                            <div class="card-content">\
                                                <p>' + last_snippet + '</p>\
                                                <a href="snippets?uid=' + username + '">All snippets</a>\
                                            </div>\
                                          </div>');
            }

            data.forEach(function(entry) {
                addChild(entry.username, entry.last_snippet);
            });
        });
    }
</script>

</body>
</html>