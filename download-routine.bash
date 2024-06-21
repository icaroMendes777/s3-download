#!/bin/bash

# Path to the log file

# Check if the .env file exists
if [ -f .env ]; then
  # Export the LOG_FILE variable from the .env file
  export $(grep -E '^LOG_FILE=' .env | xargs)
  export $(grep -E '^DESKTOP_ROOT_FILE=' .env | xargs)
fi

# Check if LOG_FILE is set and print it
if [ -z "$LOG_FILE" ]; then
  echo "LOG_FILE is not set."
else
  echo "LOG_FILE is set to: $LOG_FILE"
fi

# Get today's date
TODAY=$(date +%Y-%m-%d)
CURRENT_TIME=$(date +%H:%M)

# Check if the log file exists
if [ -f "$LOG_FILE" ]; then
    # Check if the log file contains today's date
    if grep -q "^$TODAY" "$LOG_FILE"; then
        echo "Downloads called today already"
        exit 0
    fi
fi

# If the download wasn't done today, run the download script
echo "Downloading bucket..."

php /home/icaro/projects/s3-connection/download-bkp.php

# Log today's date to the log file
echo "$TODAY Task completed at: $CURRENT_TIME" >> "$LOG_FILE"

exit 0