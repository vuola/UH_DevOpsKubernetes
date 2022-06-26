# Start from the python image
FROM ubuntu:20.04

# Define working directory inside container
WORKDIR /usr/src/app

# Copy dependency file
# COPY ./requirements.txt ./

# Install dependencies
# RUN pip install -r requirements.txt

# Source copy
COPY logoutput.sh .
RUN chmod u+x ./logoutput.sh

# start the python interpreter
# ENTRYPOINT ["python"]

# run the application
CMD ./logoutput.sh