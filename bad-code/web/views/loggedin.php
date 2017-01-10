<?php
/**
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @copyright 2017
 * @license http://opensource.org/licenses/gpl-license.php MIT License
 * Shows one person's single
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
        <a href="#" class="brand-logo">Logged In page</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="loggedin">Home</a></li>
          <li><a href="mySnippets">My Snippets</a></li>
          <li><a href="settings">Settings</a></li>
          <li><a href="logout">Sign out</a></li>
        </ul>
      </div>
    </nav>

    <div class="container">

      <div class="card">
        <span class="card-title">Add Snippet</span>
        <div class="card-content">
          <form id="addSnippet">
            <textarea placeholder="Limited HTML is now supported in snippets (e.g., <b>, <i>, etc.)!"
              id="snippetText" class="materialize-textarea"></textarea>
            <input class="btn" type="submit" name="name" value="Add snippet">
          </form>
        </div>
      </div>

      <div class="card">
        <span class="card-title">Upload File</span>
        <div class="card-content">
          <form enctype="multipart/form-data" action="/upload/image" method="post">
              <input id="image-file" type="file" />
              <input class="btn" type="submit" value="Upload File"> <!-- This would then direct to an upload successful page -->
          </form>
        </div>
      </div>

    </div>

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

      $(document).ready(function(){

        $.get('/allsnippets', function(data){

          function addChild(userId, lastSnippet, userUrl){
            $('#allSnippets').append('<div class="card"><span class="card-title">'+ userId +
              '</span> <div class="card-content"> <p>' + lastSnippet
              +'</p> <a href="#">' + userUrl + '</a></div></div>')
          }

          // data.forEach(function(){
          //   addChild()
          // })

        })



      })

    </script>

  </body>
</html>
