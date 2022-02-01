#! /bin/sh

for file in $(find . -regex "./[a-zA-Z_-]*.js"); do
  terser --compress --mangle -- $file > "$(basename $file .js).min.js"
done
echo "Script mimizzati!"