#! /bin/bash

user=aferrari
ssh paolotti.studenti.math.unipd.it -l $user \
    -L8080:tecweb:80 -L8443:tecweb:443 -L8022:tecweb:22
