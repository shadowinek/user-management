# User Management System
## Setup
### Requirements
Your machine needs to be able to run Laravel apps and Docker. See https://laravel.com/docs/10.x for more info.

### How to run the app
1. Get the source code
```
git clone git@github.com:shadowinek/user-management.git
cd user-management
```

2. Install the app dependencies
```
composer install
```

3. Create a local config file
```
cp .env.example .env
```

4. Setup your `APP_KEY`
```
php artisan key:generate
```

5. Run your local server
```
./vendor/bin/sail up -d
```

Use `./vendor/bin/sail down` to stop the server.

6. TODO: Migrations
```
```

7.Open in your browser and enjoy. The default url should be http://localhost or http://127.0.0.1

#### Database
MySQL database `laravel` is available on 127.0.0.1:3306 with user `sail` and password `password`. You can change this in your `.env` config.

## Design
### Stories
* As an admin I can add users — a user has a name.
* As an admin I can delete users.
* As an admin I can assign users to a group they aren’t already part of.
* As an admin I can remove users from a group.
* As an admin I can create groups.
* As an admin I can delete groups when they no longer have members.

## Dev Diary
#### 24/05 12:30 (15m)
* Initial setup of the Laravel app
* I went with Laravel framework as I have the most recent experience with it
