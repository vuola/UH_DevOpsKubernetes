FROM nginx:alpine

COPY static-html-directory /usr/share/nginx/html
COPY myscript ./myscript

RUN apk update
RUN apk add build-base 
RUN apk add cmake

# Install dependencies
RUN apk add --upgrade fmt-dev

# Define working directory inside container
# WORKDIR /usr/share/nginx/

# Source copy
COPY CMakeLists.txt .
COPY main.cpp .

# build
RUN cmake -S . -B ./build
RUN cmake --build build 
RUN chmod a+x ./build/logger

ARG _PORT_=8080
ENV PORT=${_PORT_}
ARG _NGINX_PORT_=80
ENV NGINX_PORT=${_NGINX_PORT_}
ENTRYPOINT ./build/logger & ./myscript/myscript.sh && nginx -g 'daemon off;'


