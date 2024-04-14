FROM nginx:1.17.5-alpine

# Copy nginx config
COPY containers/nginx/default.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www/app
 
COPY --chown=nginx:nginx ../../ /var/www/app