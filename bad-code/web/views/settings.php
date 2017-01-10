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

    <link rel="stylesheet" href="../assets/style.css" media="screen" title="no title">

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
      <li><a href="logout">Sign out</a></li>
    </ul>
  </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <span class="card-title">Edit your profile</span>
                <div class="card-content">
                    <form id="settings">
                        <div class="input-field">
                            <input id="username" type="text" placeholder="User name" class="validate">
                        </div>
                        <div class="input-field">
                            <input id="password" type="password" placeholder="OLD password" class="validate">
                        </div>
                        <div class="input-field">
                            <input id="avatarurl" type="text" placeholder="Icon" class="validate">
                        </div>
                        <div class="input-field">
                            <input id="homepageurl" type="text" placeholder="Homepage" class="validate">
                        </div>
                        <div class="input-field">
                            <input id="profilecolour" type="text" placeholder="Profile colour" class="validate">
                        </div>
                        <div class="input-field">
                            <textarea id="privatesnippet" class="materialize-textarea" placeholder="Private snippet"></textarea>
                        </div>
                        <input type="submit" class="btn" name="name" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

  $(document).ready(function(){

    $.ajax({
      url: "/api/settings",
      type: "get",
      data: {username: getCookie("username")},
      success: function(data) {
        $('#password').val(data.password);
        $('#username').val(data.username);
        $('#avatarurl').val(data.avatarurl);
        $('#privatesnippet').val(data.privatesnippet);
        $('homepageurl').val(data.homepageurl);
        $('profilecolour').val(data.profilecolour);
      },
      error: function(xhr) {
        location.reload();
      }
    });

    $('#settings').submit(function(e){
      e.preventDefault();
      
      var data = {
        "password": $('#password').val(),
        "username": $('#username').val(),
        "avatarurl": $('#avatarurl').val(),
        "privatesnippet": $('#privatesnippet').val(),
        "homepageurl": $('#homepageurl').val(),
        "profilecolour": $('#profilecolour').val()
      };

      $.ajax({
        type: "POST",
        url: '/api/settings',
        data: data,
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
