#!/bin/sh
WORKSPACE="/var/www/app"

cd $WORKSPACE

# Install app dependencies
yarn install

# Run the CMD
exec "$@"

echo "install dependencies completed!!!"

# keep container don't exit code
tail -f /etc/issue