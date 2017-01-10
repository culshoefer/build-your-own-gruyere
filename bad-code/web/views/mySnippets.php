<?php
/**
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @copyright 2017
 * @license http://opensource.org/licenses/gpl-license.php MIT License
 * Page displaying all snippets of one user. User can delete his snippets here.
 */
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>My Snippets</title>
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
        <a href="#" class="brand-logo">My Snippets</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="loggedin">Home</a></li>
          <li><a href="mySnippets">My Snippets</a></li>
          <li><a href="settings">Settings</a></li>
          <li><a href="homepage">Sign out</a></li>
        </ul>
      </div>
    </nav>

    <div class="container" id="mySnippets">
      <h2>My Snippets</h2>
      <div class="card">
        <p>
          Snippet text
        </p>
        <button class="btn" name="button">Delete</button>
      </div>
    </div>


    <script type="text/javascript">


      $(document).ready(function(){

      })


    </script>

  </body>
</html>
