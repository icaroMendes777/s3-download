#!/bin/bash

# Path to the log file

# Check if the .env file exists
if [ -f .env ]; then
  # Export the LOG_FILE variable from the .env file
  export $(grep -E '^LOG_FILE=' .env | xargs)
  export $(grep -E '^DESKTOP_ROOT_FILE=' .env | xargs)
else
  echo "No .env file set, please provide a .env file "
  exit 1
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

php "$DESKTOP_ROOT_FILE/download-bkp.php"

exit_status=$?
if [ $exit_status -eq 0 ]; then
    # Log today's date to the log file
    echo "$TODAY Task completed at: $CURRENT_TIME" >> "$LOG_FILE"
    echo "Task ended successfully"
    exit 0
else
    echo "Something went wrong! PHP script failed to run with exit status $exit_status."
    exit 1
fi

