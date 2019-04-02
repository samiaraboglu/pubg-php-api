# pubg-php-api
PlayerUnknown's Battlegrounds Php Api

- [PUBG Official Documentation](https://documentation.pubg.com/en/introduction.html)

### Installing

Via composer
```
$ composer require samiaraboglu/pubg-php-api
```

### Config
```php
$config = new Pubg\Config();
$config->setApiKey('{API_KEY}');
$config->setPlatform('{PLATFORM}');

$api = new Pubg\Api($config);
```

Platform: `kakao`, `psn`, `steam`, `tournament`, `xbox`

Platform Region: `pc-as`, `pc-eu`, `pc-jp`, `pc-kakao`, `pc-krjp`, `pc-na`, `pc-oc`, `pc-ru`, `pc-sa`, `pc-sea`, `pc-tournament`, `psn-as`, `psn-eu`, `psn-na`, `psn-oc`, `xbox-as`, `xbox-eu`, `xbox-na`, `xbox-oc`, `xbox-sa`

### Players
Use the player service.
```php
$playerService = new Pubg\Player($api);
```

Get a single player by name or accound ID.
```php
// by player name
$player = $playerService->get('{PLAYER_NAME}');

// by account id
$player = $playerService->get('{ACCOUNT_ID}');
```

Get a collection of up to 6 players by names or account IDs.
```php
// by players names
$players = $playerService->getAll(['{PLAYER_NAME_1}', '{PLAYER_NAME_2}']);

// by accounts ids
$players = $playerService->getAll(['{ACCOUNT_ID_1}', '{ACCOUNT_ID_2}']);
```

### Season Stats
Use the season service.
```php
$seasonService = new Pubg\Season($api);
```

Get the list of available seasons.
```php
$seasons = $seasonService->getAll();
```

Get season information for a single player.
```php
$season = $seasonService->get('{ACCOUNT_ID}', '{SEASON_ID}');
```

### Lifetime Stats
Use the lifetime service.
```php
$lifetimeService = new Pubg\Lifetime($api);
```

Get lifetime stats for a single player.
```php
$lifetime = $lifetimeService->get('{ACCOUNT_ID}');
```

### Matches
Use the match service.
```php
$matchService = new Pubg\Match($api);
```

Get a single match.
```php
$match = $matchService->get('{MATCH_ID}');
```

### Leaderboards
Use the leaderboard service.
```php
$leaderboardService = new Pubg\Leaderboard($api);
```

Get the leaderboard for a game mode.
```php
$leaderboards = $leaderboardService->get('{GAME_MODE}', {PAGE_NUMBER});
```

Game modes: `duo`, `duo-fpp`, `solo`, `solo-fpp`, `squad`, `squad-fpp`

Page numbers: `0`, `1`

### Tournaments
Use the tournament service.
```php
$tournamentService = new Pubg\Tournament($api);
```

Get the list of available tournaments.
```php
$tournaments = $tournamentService->getAll();
```

Get information for a single tournament.
```php
$tournament = $tournamentService->get('{TOURNAMENT_ID}');
```

### Samples
Use the samples service.
```php
$sampleService = new Pubg\Sample($api);
```

Get a list of sample matches.
```php
$samples = $sampleService->get();

// date filter
$samples = $sampleService->get('2019-03-29T00:00:00Z');
```
