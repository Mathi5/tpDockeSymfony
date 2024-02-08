#!/usr/bin/env bash

composer install -n
#composer install --no-dev --optimize-autoloader
npm install -d && npm run build
#bin/console make:migration --no-interaction
#bin/console doc:mig:mig --no-interaction
bin/console d:s:u -f --no-interaction
bin/console doctrine:fixtures:load --no-interaction
bin/console cache:clear
chmod 777 /var/www/public/images/articles/

exec "$@"