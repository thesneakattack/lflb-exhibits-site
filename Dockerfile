FROM tangramor/nginx-php8-fpm:latest

# Match container user to host's UID and GID
RUN groupmod -g 1003 nginx && \
    usermod -u 1001 -g 1003 nginx

# Fix Laravel folder ownership
RUN chown -R nginx:nginx /var/www/html/

# Use the nginx user
USER root
