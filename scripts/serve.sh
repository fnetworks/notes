#!/bin/bash

dirname=$(basename $PWD)
if [ $dirname == "scripts" ]; then cd ..; fi

function show_help() {
	echo "Serve script"
	echo "Serves the content of src/"
	echo
	echo "Parameters:"
	echo "  -h    hostname"
	echo "  -p    port"
}

host="localhost"
port="8080"

while [[ $# -gt 0 ]]
do
key="$1"

case $key in
    -s|--host)
    host="$2"
    shift; shift
    ;;
    -p|--port)
    port="$2"
    shift; shift
    ;;
    -h|--help)
    show_help
	exit 0
    ;;
    *)    # unknown option
    echo "Invalid argument $key"
	exit 1
    ;;
esac
done

php -S "$host:$port" -t src/