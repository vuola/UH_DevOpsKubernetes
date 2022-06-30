FROM nginx
COPY static-html-directory /usr/share/nginx/html
COPY myscript ./myscript
ENTRYPOINT ./myscript/myscript.sh && nginx -g 'daemon off;'

