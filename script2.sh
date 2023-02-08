#!/bin/sh
# assign 755 permission to all directories and 644 permission to all files.
find /home -type d -exec chmod 0755 {} \;
find /home -type f -exec chmod 0644 {} \;
