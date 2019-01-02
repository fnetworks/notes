#!/bin/bash
if [ $(basename $PWD) == "scripts" ]; then cd ..; fi

allowed_types="html|css|js|php"
excluded_entries="saved_notes"

function show_help() {
	echo "Utility script to list all source files in src/"
	echo
	echo "Parameters:"
	echo "  -a --allowed-ext  Specifies allowed extensions (default: html,css,js,php)"
	echo "  -e --exclude      Specifies entries to exclude (default: saved_notes)"
	echo "  -h --help         show this help message"
}

while [[ $# -gt 0 ]]; do
	key="$1"
	value="$2"

	case $key in
		-a|--allowed-ext)
		allowed_types="$(echo $value | tr ',' '|')"
		shift; shift
		;;
		-e|--exclude)
		excluded_entries="$(echo $value | tr ',' '|')"
		shift; shift
		;;
		-h|--help)
		show_help
		exit 0
		;;
		*)    # unknown option
		echo "Invalid argument $key"
		show_help
		exit 1
		;;
	esac
done

find src/ -type f | egrep "\.($allowed_types)$" | egrep -v "($excluded_entries)" | perl -pe 'chomp if eof' | tr '\n' ' '
echo