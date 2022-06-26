# Define a timestamp function
STR=`$RANDOM | md5sum | head -c 20`
while :
do
    DATE=$(date --utc +%FT%T.%3NZ)
    echo "${DATE}\t${STR}"
    sleep 5
done