#! /bin/dash

user=elpasqua
rsync -e "ssh -p 8022 " -avrP ./public_html/ $user@localhost:public_html/
