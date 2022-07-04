FROM nginx
COPY static-html-directory /usr/share/nginx/html
COPY myscript ./myscript
ARG _PORT_
ENV PORT=${_PORT_}
ARG _NGINX_PORT_
ENV NGINX_PORT=${_NGINX_PORT_}
ENTRYPOINT ./myscript/myscript.sh && nginx -g 'daemon off;'

