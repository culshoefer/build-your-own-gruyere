<?php
/**
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @copyright 2017
 * @license http://opensource.org/licenses/gpl-license.php MIT License
 */
$GLOBALS['page_name'] = 'Home';
include 'includes/header.php';
?>

    <div class="container" id="allSnippets">
        <h2>List of Users</h2>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $.get('/api/overview', function (data) {
                function addChild(username, user_id, last_snippet, homepageurl) {
                    if(null == last_snippet) {
                        last_snippet = "";
                    }
                    if(undefined === homepageurl) {
                        homepageurl = "";
                    }
                    $.get('/api/settings?user_id=' + user_id, function (data) {
                        $('#allSnippets').append('<div class="card"> \
                                            <span class="card-title" style="color:' + data.profilecolour + ' !important;">' + username + '</span>\
                                            <div class="card-content">\
                                                <p>' + last_snippet + '</p>\
                                                <a href="' + homepageurl + '">Homepage</a>\
                                            </div>\
                                          </div>');
                    });
                }

                data.forEach(function (entry) {
                    addChild(entry.username, entry.user_id, entry.last_snippet, entry.homepageurl);
                });
            });
        });
    </script>

<?php
include 'includes/footer.php';
?>