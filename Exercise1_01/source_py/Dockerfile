# Start from the python image
FROM python:3.9-slim-bullseye

# Define working directory inside container
WORKDIR /usr/src/app

# Copy dependency file
# COPY ./requirements.txt ./

# Install dependencies
# RUN pip install -r requirements.txt

# Source copy
COPY *.py .

# start the python interpreter
# ENTRYPOINT python

# run the application
CMD ["python", "logoutput.py"]