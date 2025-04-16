### SetUp:
- PHP: 8.4
- composer install
- `cp .env.example .env`
- add to `.env` value of `API_EXCHANGERATESAPI_TOKEN`

### RUN:
`php init.php input.txt`

### Origin file 
`./app-origin.php`

### Test run:
`./vendor/bin/phpunit`

### Note

The code could look simpler using the dependency injection pattern. For example, there would be no need to pass a token or url through the application layers.

A feature to consider could be the feature flag, for example, when choosing a provider to download Bin or Rate