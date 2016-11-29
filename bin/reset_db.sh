#!/usr/bin/env bash

BASEDIR=$(dirname "$0")
DB=$BASEDIR/../app.db
SCHEMA=$BASEDIR/../resources/schema.sql
FIXTURES=$BASEDIR/../resources/fixtures.sql

rm -iv $DB
cat $SCHEMA | sqlite3 $DB
cat $FIXTURES | sqlite3 $DB
