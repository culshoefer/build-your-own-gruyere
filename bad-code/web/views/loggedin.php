<?php
/**
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @copyright 2017
 * @license http://opensource.org/licenses/gpl-license.php MIT License
 * Shows one person's single
 */
$GLOBALS['page_name'] = 'Logged-in Page';
include 'includes/header.php';
?>

<div class="container">

    <div class="card">
        <span class="card-title">Add Snippet</span>
        <div class="card-content">
            <form id="addSnippet">
            <textarea placeholder="Limited HTML is now supported in snippets (e.g., <b>, <i>, etc.)!"
                      id="snippetText" class="materialize-textarea"></textarea>
                <input class="btn" type="submit" name="name" value="Add Snippet" id="snippet-button">
            </form>
        </div>
    </div>

    <div class="card">
        <span class="card-title">Upload File</span>
        <div class="card-content">
            <form enctype="multipart/form-data" action="/upload" method="post">
                <input id="image-file" type="file" name="file-to-upload"/>
                <input class="btn" type="submit" value="Upload File" name="submit-file-upload">
                <!-- This would then direct to an upload successful page -->
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

    $(document).ready(function () {
        var username = getCookieWithName('username');
        $('#usn').text(username);

        $.get('/api/overview', function (data) {
            function addChild(username, last_snippet) {
                $('#allSnippets').append('<div class="card"> \
                                            <span class="card-title">' + username + '</span>\
                                            <div class="card-content">\
                                                <p>' + last_snippet + '</p>\
                                                <a href="snippets?user_id=' + username + '">All snippets</a>\
                                            </div>\
                                          </div>');
            }

            data.forEach(function (entry) {
                addChild(entry.username, entry.last_snippet);
            });
        });

        $('addSnippet').submit(function (e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: '/api/settings?user_id=' + encodeURIComponent(getCookie('user_id'))
                + '&content=' + encodeURIComponent($('#snippetText').val()),
                // data: {
                //   'username': getCookie(username),
                //   'content': $('#snippetText').val()
                // },
                success: function () {
                    location.reload();
                }
            });

        })
    });


    function getCookie(c_name) {
        if (document.cookie.length > 0) {
            c_start = document.cookie.indexOf(c_name + "=");
            if (c_start != -1) {
                c_start = c_start + c_name.length + 1;
                c_end = document.cookie.indexOf(";", c_start);
                if (c_end == -1) c_end = document.cookie.length;
                return unescape(document.cookie.substring(c_start, c_end));
            }
        }
        return "";
    }

</script>

<?php
include 'includes/footer.php';
?>