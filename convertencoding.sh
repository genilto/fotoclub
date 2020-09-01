#!/bin/bash
FROM_ENCODING="ISO-8859-1"
TO_ENCODING="UTF-8"
#convert
CONVERT="iconv -f $FROM_ENCODING -t $TO_ENCODING"
#loop to convert multiple files 
for file in ./fotos/*; do
#     $CONVERT "$file" > "$file"2 && mv "$file"2 "$file"
     $CONVERT "$file" > "$file"2 && mv "$file"2 "$file"
done
exit 0