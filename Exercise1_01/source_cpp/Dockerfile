# Start from the ubuntu image
FROM ubuntu:latest

RUN apt update
RUN apt-get -y upgrade
RUN apt -y install build-essential 
RUN apt -y install cmake

# Define working directory inside container
WORKDIR /usr/src/app

# Copy dependency file
# COPY ./requirements.txt ./

# Install dependencies
RUN apt-get install -y libfmt-dev

# Source copy
COPY . .

# build
RUN cmake -S . -B ./build
RUN cmake --build build

# run the application
CMD build/logger