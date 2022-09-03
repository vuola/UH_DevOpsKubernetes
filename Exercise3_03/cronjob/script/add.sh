#!/bin/bash
USER=$MARIADB_USER
PASS=$MARIADB_PASSWORD
PORT=3306
HOST=$MARIADB_HOST
DBASE=$MARIADB_DATABASE
TABLE=$MARIADB_TABLE
WIKI_URL=$(curl -i -s https://en.wikipedia.org/wiki/Special:Random | grep "location:" | cut -d' ' -f2 | tr -cd '\11\12\15\40-\176')
mysql -u$USER -p$PASS -P$PORT -h$HOST -D$DBASE --vertical <<EOF
USE $DBASE;
INSERT INTO $TABLE (description, owner, status, created) VALUES ('Read $WIKI_URL', 'Markus', 'NOT_STARTED', '$(date +'%Y-%m-%d')');
SELECT * FROM $TABLE;
EOF