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
        $.get('/api/overview', function(data) {
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
    });
</script>

<?php
include 'includes/footer.php';
?>