# Rick & Morty API Gateway

Extending the basic functionality of the Rick & Morty API.

The next searches can be preformed with this Gateway:

- Show all characters that exist (or are last seen) in a given dimension

- Show all characters that exist (or are last seen) at a given location

- Show all characters that partake in a given episode

- Showing all information of a character (Name, species, gender, last location, dimension, etc)

## Requirements
- PHP 7.4 >=
- Composer

## Usage
Install the dependencies with:
```
composer install
```
Once the dependencies had been installed the project can be started with either:
```
 symfony server:start
```
if the global symfony binary is installed. 
Or using the php debug server:
```
php -S localhost:8000 -t public/                                                                                        
```

## The endpoints

The characters can be filtered by posting a CharacterFilter object to the
`api/characters` endpoint

as follows:
```
curl --request POST \
  --url 'http://127.0.0.1:8000/api/characters?XDEBUG_SESSION_START=PHPSTORM' \
  --header 'Content-Type: application/json' \
  --data '{
	"episode": 1
}'
```

The CharacterFilter object can consist of the next attributes:
 - episode: int
 - location: LocationsFilter

And the Locations filter used in the previous filter consists of:
 - dimension: string
 - location: Location

Finally the Location object used in the LocationsFilter is the same as
the object in the request and can be mapped with just one attributes:
 - name: string

But the id can also be used to filter the characters

To retrieve a single character you can use the next endpoint:
```
curl --request GET \
  --url http://127.0.0.1:8000/api/character/{id}
```

where the id is an int.
