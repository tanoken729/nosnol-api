# nosnol

image or gif

## Overview
A service for sharing audio files.

## Requirement
- Laravel Framework 6.20.27
- docker 19.03.13

## Usage
```bash
# Starting the Docker daemon
$ systemctl start docker

# Activate automatically
$ systemctl enable docker

# Generate a docker image
$ docker-compose build

# Start the docker container
$ docker-compose up

# Enter the qpp container
$ docker-compose exec app sh

$ cd src

# install dependencies
$ composer install

# If you get an error message "file_put_contents..."
$ chmod -R 757 storage

# Environment settings
$ vi .env

$ cp .env_local .env

# Migration of db
$ php artisan migrate

# Link storage and public
$ php artisan storage:link

# Access the following URL
http://localhost:8000/
```

## Features
https://docs.google.com/spreadsheets/d/1JTMj9ESNzB6DjYj31TcaGiGS0SsWGrTVtiYeZ09U2QE/edit#gid=1362542026