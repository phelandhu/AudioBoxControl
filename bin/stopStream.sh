#!/bin/bash
#set -xv
file="/tmp/ices.pid"
PID=$(cat -v $file)
echo $PID
kill $PID
