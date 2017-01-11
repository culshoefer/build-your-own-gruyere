#!/bin/bash

for snippet_id in "1" "2" "3" "4" "5" "6" "7" "8" "9" "10" "11" "12" "13" "14" "15" "16" "17"
do
    urlforsnippetremoval="http://46.101.91.7/api/snippets?snippet_id="$snippet_id
    curl -X DELETE $urlforsnippetremoval
done
