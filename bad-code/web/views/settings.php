<?php
/**
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @copyright 2017
 * @license http://opensource.org/licenses/gpl-license.php MIT License
 * Renders settings, depending on the type of session (e.g. we need to display username, etc...)
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Profile Settings</title>
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
    <a href="#" class="brand-logo">Settings</a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li><a href="loggedin">Home</a></li>
      <li><a href="mySnippets">My Snippets</a></li>
      <li><a href="settings">Settings</a></li>
      <li><a href="homepage">Sign out</a></li>
    </ul>
  </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <span class="card-title">Edit your profile</span>
                <div class="card-content">
                    <form class="" method="post">
                        <div class="input-field">
                            <input type="text" placeholder="User name" class="validate">
                        </div>
                        <div class="input-field">
                            <input type="password" placeholder="OLD password" class="validate">
                        </div>
                        <div class="input-field">
                            <input type="password" placeholder="NEW password" class="validate">
                        </div>
                        <div class="input-field">
                            <input type="text" placeholder="Icon" class="validate">
                        </div>
                        <div class="input-field">
                            <input type="text" placeholder="Homepage" class="validate">
                        </div>
                        <div class="input-field">
                            <input type="text" placeholder="Profile colour" class="validate">
                        </div>
                        <div class="input-field">
                            <textarea id="textarea1" class="materialize-textarea" placeholder="Private snippet"></textarea>
                        </div>
                        <input type="submit" class="btn" name="name" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

