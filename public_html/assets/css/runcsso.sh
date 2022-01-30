#! /bin/sh

for file in $(find . -regex "./[a-zA-Z_-]*.css"); do
  csso $file -o "$(basename $file .css).min.css"
done
