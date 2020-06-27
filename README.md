# agora-recruitment-task


## Requirements
- Docker >= 17.09 - `curl -fsSL https://get.docker.com -o get-docker.sh && sh get-docker.sh`
- docker-compose - https://docs.docker.com/compose/install/ 

Firing up the project and installing composer packages:

  ```
  docker-compose build
  docker-compose run php composer install
  docker-compose run php bin/console app:parse-client-orders -f <input file name>
  ```

### Running QA tests locally

Backend:
```
docker-compose run php composer qa
```
