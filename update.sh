#!/bin/sh

# git update first
echo "\n\n==> Updating code from git..."
git reset --hard && git pull

rm -Rf web/assets/*
