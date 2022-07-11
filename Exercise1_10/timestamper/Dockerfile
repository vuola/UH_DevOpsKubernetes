ARG ALPINE_VERSION=3.16

# Start with build image
FROM alpine:${ALPINE_VERSION} as build

# Install build tools for C++ app
RUN apk add --no-cache \
  build-base \
  cmake \
  fmt-dev

# Executables, copy compile and set rights
WORKDIR /var/www/html
COPY CMakeLists.txt .
COPY main.cpp .
RUN cmake -S . -B ./build
RUN cmake --build build 

# Move to production image
FROM alpine:${ALPINE_VERSION}

# Add libraries
RUN apk add --no-cache \
  fmt-dev

# Setup document root
WORKDIR /var/www/html

# Create directory which will be shared
RUN mkdir file

# Move in compiled app from build image
COPY --from=build /var/www/html/build/logger ./build/logger
RUN chmod a+x ./build/logger

# Scripts, copy and set rights
COPY myscript /var/www/script
RUN chmod a+x /var/www/script/myscript.sh

# Switch to use a non-root user from here on
# USER nobody

ENTRYPOINT /var/www/script/myscript.sh & /var/www/html/build/logger