#!/bin/bash
if [ $# -eq 0 ]
  then
    sudo ices0 -c /etc/ices0-1.conf
	exit
fi
sudo ices0 -c /etc/ices0-1.conf  -F $1