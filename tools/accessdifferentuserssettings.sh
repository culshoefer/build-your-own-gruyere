#!/bin/bash

cookies="username=admin; user_id=1"

urlforsettings="http://127.0.0.1:25543/api/settings?user_id="


# This is actually valid
curl $urlforsettings"1" --cookie $cookies
# ^ returns JSON for settings

# This should be prevented
curl $urlforsettings"2" --cookie $cookies
