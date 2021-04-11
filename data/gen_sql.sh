#!/bin/sh

echo "INSERT INTO \"quotes\" (quote) VALUES"

./filter | awk '{ printf "('\''"; printf $1; printf "'\''),\n"; }' | sed '$s/,/;/'
