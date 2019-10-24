#!/usr/bin/env bash

# Copyright © Reach Digital (https://www.reachdigital.io/)
# See LICENSE.txt for license details.

set -e
trap '>&2 echo Error: Command \`$BASH_COMMAND\` on line $LINENO failed with exit code $?' ERR

# prepare for test suite
sed -e "s?BOL_CLIENT_ID_VALUE?${BOL_CLIENT_ID}?g" --in-place phpunit.xml
sed -e "s?BOL_CLIENT_SECRET_VALUE?${BOL_CLIENT_SECRET}?g" --in-place phpunit.xml
