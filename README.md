# Build locally
```
docker build -t unifi-parental-control-api-image -f Dockerfile.php .
docker push tflatebo/unifi-parental-control:unifi-parental-control-api
```

```
docker build -t unifi-parental-control-web-image -f Dockerfile.nginx .
docker push tflatebo/unifi-parental-control:unifi-parental-control-api-proxy
```
