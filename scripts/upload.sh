#!/bin/bash
if [ $(basename $PWD) == "upload" ]; then cd ..; fi

if [ ! -f scripts/.upload_conf.sh ]; then
	echo "Upload config script (scripts/.upload_conf) not present!"
	exit 1
fi

. scripts/.upload_conf.sh

$sources=$(scripts/find_sources.sh | tr ' ' ',')
curl -T "{$sources}" $host --user $user:$secret