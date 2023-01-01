#!/bin/bash
USER=$MARIADB_USER
PASS=$MARIADB_PASSWORD
PORT=3306
HOST=$MARIADB_HOST
DBASE=$MARIADB_DATABASE
WIKI_URL=$(curl -i -s https://en.wikipedia.org/wiki/Special:Random | grep "location:" | cut -d' ' -f2 | tr -cd '\11\12\15\40-\176')
curl -d {'description':'Read $WIKI_URL', 'owner':'Markus', 'status':'NOT_STARTED', 'created':'$(date +'%Y-%m-%d')'} taskproject-svc:8081/api/create.php