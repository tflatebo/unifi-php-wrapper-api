# Build locally
```
docker build -t unifi-parental-control-api-php-image -f docker/php-fpm/Dockerfile .
docker push tflatebo/unifi-parental-control:unifi-parental-control-api-php
```

```
docker build -t unifi-parental-control-api-proxy-image -f docker/nginx/Dockerfile .
docker push tflatebo/unifi-parental-control:unifi-parental-control-api-proxy
```

# Build for pushing to docker hub
```
docker build -t tflatebo/unifi-parental-control:api-php -f docker/php-fpm/Dockerfile .
docker push tflatebo/unifi-parental-control:api-php
```

```
docker build -t tflatebo/unifi-parental-control:api-proxy -f docker/nginx/Dockerfile .
docker push tflatebo/unifi-parental-control:api-proxy
```
