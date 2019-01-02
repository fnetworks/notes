#!/bin/bash
if [ $(basename $PWD) == "scripts" ]; then cd ..; fi

function show_help() {
	echo "Packages the content of src/ into a zip file"
	echo
	echo "Parameters:"
	echo "  -h --help         show this help message"
}

while [[ $# -gt 0 ]]; do
	key="$1"
	value="$2"

	case $key in
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

mkdir -p dist/
sources=$(scripts/find_sources.sh | sed s/src\\///g) 
cd src/
zip ../dist/note.zip $sources