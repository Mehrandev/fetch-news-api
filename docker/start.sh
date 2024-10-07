#!/bin/bash

# Start the cron service in the background
service cron start
# Start the Laravel built-in server
php artisan serve --host=0.0.0.0 --port=8000
