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
    <title>Your home</title>
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
          <li id="usn"></li>
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
          <form enctype="multipart/form-data" action="/upload" method="post">
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
      function getCookieWithName(name) {
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
      }

      $(document).ready(function(){
        var username = getCookieWithName('username');
        $('#usn').text(username);

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

        $('addSnippet').submit(function(e){
          e.preventDefault();

          $.ajax({
            type: "POST",
            url: '/api/settings',
            data: {
              'username': getCookie(username),
              'content': $('#snippetText').val()
            },
            success: function(){
              location.reload();
            },
          });
        })

      })


      function getCookie(c_name)
      {
          if (document.cookie.length > 0)
          {
              c_start = document.cookie.indexOf(c_name + "=");
              if (c_start != -1)
              {
                  c_start = c_start + c_name.length + 1;
                  c_end = document.cookie.indexOf(";", c_start);
                  if (c_end == -1) c_end = document.cookie.length;
                  return unescape(document.cookie.substring(c_start,c_end));
              }
          }
          return "";
       }

    </script>

  </body>
</html>
