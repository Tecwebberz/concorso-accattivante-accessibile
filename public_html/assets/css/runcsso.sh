#! /bin/sh

for file in $(find . -regex "./[a-zA-Z_-]*.css"); do
  csso $file --no-restructure -o "$(basename $file .css).min.css"
done
  echo "Fogli di stile minimizzati!"