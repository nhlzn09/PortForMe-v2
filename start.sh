#!/bin/sh
set -e
# Database CA certificate (Aiven needs SSL). Paste it into the DB_SSL_CA_PEM variable, or commit certs/ca.pem.
if [ -n "$DB_SSL_CA_PEM" ]; then
  printf '%s\n' "$DB_SSL_CA_PEM" > /tmp/db-ca.pem
  export MYSQL_ATTR_SSL_CA=/tmp/db-ca.pem
elif [ -f certs/ca.pem ]; then
  export MYSQL_ATTR_SSL_CA="$(pwd)/certs/ca.pem"
fi

php artisan migrate --force
exec php -S 0.0.0.0:"${PORT:-10000}" -t public router.php
