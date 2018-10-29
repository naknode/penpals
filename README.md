# Penpals [![Build Status](https://travis-ci.org/naknode/penpals.svg?branch=master)](https://travis-ci.org/naknode/penpals)

Penpal website the right way using Azure APIs from Microsoft to lessen harrassment and rude people while strengthening unity and friendships.

## Installation

### Prerequisites

* To run this project, you must have PHP 7 installed.
* You should setup a host on your web server for your local domain. For this you could also configure Laravel Homestead or Valet.
* If you want use Redis as your cache driver you need to install the Redis Server. You can either use homebrew on a Mac or compile from source (https://redis.io/topics/quickstart).

### Step 1

Begin by cloning this repository to your machine, and installing all Composer & NPM dependencies.

```bash
git clone git@github.com:naknode/penpals.git
cd penpals && composer install && npm install
php artisan migrate
npm run watch
```

### Step 2

Open up the file `.env` (if not there, just copy `.env.example`) and fill it out accordingly -- MySQL, Redis, etc.

### Step 3

Next, boot up a server and visit your forum. If using a tool like Laravel Valet, of course the URL will default to `http://penpals.test`.

1. Visit: `http://penpals.test/register` to register a new  account.
2. Edit `config/penpals.php`, and add any email address that should be marked as an administrator.
3. Enjoy.