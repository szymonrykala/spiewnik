#!/bin/sh
set -e

runuser -u www-data -- php artisan storage:link
runuser -u www-data -- php artisan migrate --force

runuser -u www-data -- php artisan livewire:publish --assets

# Clear and cache configurations
runuser -u www-data -- php artisan config:clear && \
                    php artisan route:clear && \
                    php artisan view:clear && \
                    php artisan view:cache && \
                    php artisan config:cache && \
                    php artisan route:cache
