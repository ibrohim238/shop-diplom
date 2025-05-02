#!/bin/bash

exec "$@"

# Ожидаем, что переменные WWWGROUP и WWWUSER переданы через ENV/ARG
# Освобождаем GID, если он занят не‐www-data
if getent group "${WWWGROUP}" >/dev/null && \
   [ "$(getent group "${WWWGROUP}" | cut -d: -f1)" != "www-data" ]; then
  OTHER=$(getent group "${WWWGROUP}" | cut -d: -f1)
  delgroup "${OTHER}"
fi

# Назначаем нужный GID группе www-data
groupmod -g "${WWWGROUP}" www-data

# Освобождаем UID, если он занят не‐www-data
OWNER=$(getent passwd | awk -F: -v uid="${WWWUSER}" '$3==uid{print $1}')
if [ -n "${OWNER}" ] && [ "${OWNER}" != "www-data" ]; then
  deluser "${OWNER}"
fi

# Назначаем UID пользователю www-data
usermod -u "${WWWUSER}" -g "${WWWGROUP}" www-data

# Исправляем владельца файлов
chown -R www-data:www-data /var/www
