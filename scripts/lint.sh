#!/bin/bash
if [ $(basename $PWD) == "scripts" ]; then cd ..; fi

function show_help() {
	echo "Lint script"
	echo "Checks the content of src/ for syntax errors"
	echo
	echo "Parameters:"
	echo "  -h --help    show this help message"
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

for source in $(scripts/find_sources.sh -a php); do
	php -l $source
done