FROM nginxinc/nginx-unprivileged:stable-alpine
COPY .docker/nginx.prod.conf /etc/nginx/conf.d/default.conf
