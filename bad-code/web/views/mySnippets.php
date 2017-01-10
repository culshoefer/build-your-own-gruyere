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

      $(document).ready(function(){

        function getSnippetIdFromElement(elem) {
          return elem.attr('snippet_id');
        }

        function getCookieWithName(name) {
          var value = "; " + document.cookie;
          var parts = value.split("; " + name + "=");
          if (parts.length == 2) return parts.pop().split(";").shift();
        }

        function deleteSnippet(snippet_id) {
          $.ajax({
            type: "DELETE",
            url: "/api/snippets",
            data: JSON.stringify({"snippet_id": snippet_id}),
            success: function(data) {
              window.location.reload();
            }
          });
        }

        function onclickremovesnippet(e) {
          var snippet_id = getSnippetIdFromElement($(this));
          deleteSnippet(snippet_id);
        }

        function displaySnippet(snippet) {
          var div = $('<div class="card">\
                                    <p>' + snippet.content + '</p>\
                                  </div>');
          var btn = $('<button class="btn snippet-remove" name="button"\
                                    snippet_id="' + snippet.snippet_id + '">Delete</button>');
          btn.click(onclickremovesnippet);
          div.append(btn);
          $('#mySnippets').append(div);
        }

        var user_id = getCookieWithName('user_id');

        displaySnippet({"content":"yo yo yo", "snippet_id":"123"});

        $.get('/api/snippets', {
          'user_id': user_id
        }, function(data, status) {
          //display stuff here
          data.forEach(function(snippet) {
            displaySnippet(snippet);
          })

        });
      });
    </script>

  </body>
</html>
