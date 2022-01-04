#! /bin/dash

user=aferrari
rsync -e "ssh -p 8022 " -avrP $user@localhost:public_html/ ./public_html/
