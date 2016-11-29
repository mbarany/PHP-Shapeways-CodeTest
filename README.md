# PHP-Shapeways-CodeTest
I used SQLite instead of MySQL so it would be easy to demo, but it could also easily work with MySQL

# Setup
- Clone Repo `git clone https://github.com/mbarany/PHP-Shapeways-CodeTest.git`
- Run Composer `composer install`
- Reset DB and load fixtures `./bin/reset_db.sh`
- Run PHP Server `php -S localhost:9000 -t webroot -d "date.timezone=America/New_York"`
- Open http://localhost:9000/

#Answers
- 1,2,3 are in `webroot/index.php`
- 4,5 are in `layouts/main.html`
- For #6, I would use a combination of selenium tests preferably with http://webdriver.io/ and internal QA API endpoints to validate the functional tests

License
=======

    Copyright 2016 Michael Barany

    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.