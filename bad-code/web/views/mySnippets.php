<?php
/**
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @copyright 2017
 * @license http://opensource.org/licenses/gpl-license.php MIT License
 * Page displaying all snippets of one user. User can delete his snippets here.
 */
$GLOBALS['page_name'] = 'My Snippets';
include 'includes/header.php';
?>

    <div class="container" id="mySnippets">
        <h2>My Snippets</h2>
    </div>


    <script type="text/javascript">

        $(document).ready(function () {

            function getSnippetIdFromElement(elem) {
                return elem.attr('data-snippet-id');
            }

            function getCookieWithName(name) {
                var value = "; " + document.cookie;
                var parts = value.split("; " + name + "=");
                if (parts.length == 2) return parts.pop().split(";").shift();
            }

            function deleteSnippet(snippet_id) {
                $.ajax({
                    type: "GET",
                    url: "/api/snippets?snippet_id=" + snippet_id,
                    success: function (data) {
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
                                    data-snippet-id="' + snippet.id + '">Delete</button>');
                btn.click(onclickremovesnippet);
                div.append(btn);
                $('#mySnippets').append(div);
            }

            var user_id = getCookieWithName('user_id');

            $.get('/api/snippets?user_id=' + encodeURIComponent(user_id), function (data, status) {
                //display stuff here
                data.forEach(function (snippet) {
                    displaySnippet(snippet);
                })

            });
        });
    </script>

<?php
include 'includes/footer.php';
?>