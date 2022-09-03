FROM alpine
RUN apk add --no-cache \
mysql-client \
curl \
nano
COPY ./script/add.sh /tmp/script/add.sh
WORKDIR /tmp/script
RUN chmod a+x add.sh
