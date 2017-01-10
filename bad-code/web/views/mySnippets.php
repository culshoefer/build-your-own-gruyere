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
    <link rel="stylesheet" href="../assets/style.css" media="screen" title="no title">

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
          <li><a href="logout">Sign out</a></li>
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
      function displaySnippets(snippet) {
        $('#mySnippets').append('<div class="card">\
                                    <p>' + snippet.content + '</p>\
                                    <button class="btn" name="button">Delete</button>\
                                  </div>');
      }

      function getCookieWithName(name) {
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
      }

      $(document).ready(function(){
        var username = getCookieWithName('username');

        displaySnippets({"content":"yo yo yo", "snippet_id":"123"});

        $.get('/api/snippets', {
          'username': username
        }, function(data, status) {
          //display stuff here
          data.forEach(function(snippet) {
            displaySnippets(snippet);
          })

        });
      })


    </script>

  </body>
</html>
