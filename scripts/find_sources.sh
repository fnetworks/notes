#!/bin/bash

dirname=$(basename $PWD)
if [ $dirname == "scripts" ]; then cd ..; fi

allowed_types="html|css|js|php"
excluded_entries="saved_notes"

find src/ -type f | egrep "\.($allowed_types)$" | egrep -v "($excluded_entries)"