# Rick & Morty API Gateway

Extending the basic functionality of the Rick & Morty API.

The next searches can be preformed with this Gateway:

- Show all characters that exist (or are last seen) in a given dimension

- Show all characters that exist (or are last seen) at a given location

- Show all characters that partake in a given episode

- Showing all information of a character (Name, species, gender, last location, dimension, etc)

## Requirements
- [Docker](https://docs.docker.com/)
- [Docker machine](https://docs.docker.com/machine/)
- [VirtualBox](https://www.virtualbox.org/)
- [Dobi](https://dnephin.github.io/dobi/)

## Usage
Initialize the machine by running:
```
$ source setenv
```
This will run the machine or create it and run it if it has never been created.
After the previous step you can start the containers needed to launch the application by running:
```
$ dobi dev
```

Then the API is available in the IP: 192.168.50.100

## The endpoints

The characters can be filtered by posting a CharacterFilter object to the
`api/characters` endpoint

as follows:
```
curl --request POST \
  --url 'http://192.168.50.100:80/api/characters?XDEBUG_SESSION_START=PHPSTORM' \
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
  --url http://192.168.50.100:80/api/character/{id}
```

where the id is an int.
