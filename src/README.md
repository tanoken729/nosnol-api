# nosnol

![image](https://user-images.githubusercontent.com/49152949/141650271-3e7cc3a2-3443-4f7c-9129-fbd907e97531.png)

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
- register
- login (JWT)
- display user details
- edit user information
- update user information
- logout
- follow
- unfollow
- like
- unlike
- Comment
- uploading audio files
- play a audio file
- display a list of audio files.
- narrow down by audio file genre
- narrow down by audio file emotion
- display the audio file details
- search for audio files
- delete an account

https://docs.google.com/spreadsheets/d/1JTMj9ESNzB6DjYj31TcaGiGS0SsWGrTVtiYeZ09U2QE/edit#gid=1362542026


## ERD
<img width="764" alt="スクリーンショット 2021-11-06 17 06 11" src="https://user-images.githubusercontent.com/49152949/140602917-63dc4536-ae3c-499f-b794-76e27c95fd9d.png">

https://cacoo.com/diagrams/rhUFcoZ1g54y2qT6/33CEE

## Network Diagram
<img width="1192" alt="スクリーンショット 2021-11-14 0 34 13" src="https://user-images.githubusercontent.com/49152949/141649748-6fc15442-fc28-4bcd-b53f-f4f823ac0fbc.png">

https://app.diagrams.net/#G1IzgHapkGtKOpiYQYtCWq2wnTDkaWNVdv
