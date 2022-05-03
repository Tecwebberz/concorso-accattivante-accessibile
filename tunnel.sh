#! /bin/bash

user=elpasqua
ssh paolotti.studenti.math.unipd.it -l $user \
    -L8080:caa:80 -L8443:caa:443 -L8022:caa:22
