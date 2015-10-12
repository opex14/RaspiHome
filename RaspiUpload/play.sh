#!/bin/bash
killall mplayer
rm /tmp/mplayer-fifo
mkfifo /tmp/mplayer-fifo
mplayer -really-quiet -noconsolecontrols -fs -slave -input file=/tmp/mplayer-fifo "$1" </dev/null >/dev/null 2>&1 &
echo "Playing!"
