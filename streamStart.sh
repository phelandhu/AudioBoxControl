#!/bin/bash
name=`basename $0`
streamOne="Queen - Innuendo"
streamTwo="Queen - It's a Kind of Magic"
portOne="8000"
portTwo="8002"

if [ $# -eq 0 ]
  then
    echo "[1;31mTell me which stream you wish to start"
    echo "Usage: [1;32m$name <streamId>[0m"
    echo "Currently setup streams are:[1;33m"
    echo "One"
    echo "Two[0m"
#    echo "1.1.0"
#    echo "1.2.0"
#    echo "2.0.0"
#    echo "[0m"
	exit
fi
case "$1" in

"One")
	echo "Now playing: $streamOne on port $portOne"
	pid=`sudo ices0 -c /etc/ices0-1.conf`
	short=${pid:7:4}
	echo $short > /tmp/ices0-1.pid
    ;;
"Two")
	echo "Now playing: $streamTwo on port $portTwo"
	pid=`sudo ices0 -c /etc/ices0-2.conf`
	short=${pid:7:4}
	echo $short > /tmp/ices0-2.pid
    ;;
*) echo "Stream $1 is not present"
   ;;
esac



