#!/bin/sh

# git update first
echo "\n\n==> Updating code from git..."
git reset --hard && git pull

echo "\n\n==> Runing migrations..."

rm -Rf web/assets/*
