#! /bin/dash

user=aferrari
rsync -e "ssh -p 8022 " -avrP ./public_html/ $user@localhost:public_html/
