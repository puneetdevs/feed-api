# Setup development environment
- Run "composer install" to install dependencies
- Duplicate .env.example file, rename to .env and setup local configuration
- Setup .env File set Database Changes and Site URL
- Generate app key by running "php artisan key:generate" command
- Run DB migrations: "php artisan migrate"
- Seed default DB data: "php artisan db:seed"
- Run Command "php artisan feed:update" This Will Fetch Latest news
- Run Command "php artisan serve"

#API URL
http://siteurl/api/news

End Points
- start_date
- end_date
- source
- limit

EG: http://siteurl/api/news?limit=25