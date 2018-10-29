#!/bin/bash
XDEBUG_CONFIG="idekey=PHPSTORM" PHP_IDE_CONFIG="serverName=william.dev" php -dxdebug.remote_host=`echo $SSH_CLIENT | cut -d "=" -f 2 | awk '{print $1}'` "$@"
