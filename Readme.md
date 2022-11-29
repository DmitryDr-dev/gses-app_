# GSES App

## Running the app

```bash
mysql.server start
symfony server:start -d

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

## Requests

### user

- url: http://127.0.0.1:8000/user
- method: POST
- body:
```json
{
    "firstName": "Rasmus",
    "lastName": "Lerdorf",
    "email": "rasmus.lerdorf@email.com"
}
```

### exchange-rate

- url: http://127.0.0.1:8000/rate
- method: POST
- body:
```json
{
  "sourceCurrency": "usd",
  "targetCurrency": "uah",
  "sourceAmount": 1
}
```
`sourceAmount` - int or float accepted