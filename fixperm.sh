#!/bin/sh

APPDIRS="coop"
WRDIRS="coop/assets coop/protected/runtime coop/protected/data"

for dir in $APPDIRS; do
  chgrp -R www-data $dir
  find $dir -type d -exec chmod g+s \{\} \;
  chmod -R go-w $dir
done

for dir in $WRDIRS; do
  chmod -R g+w $dir
done

