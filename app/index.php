<?php

/* DB connection */
require ("../db/db_repositories.php");

/* Load DB */
$dbr = new DB_Repositories();

/* Repositories list */
$repositories = $dbr->getList();

/* Main application */
include ("most_stars/main.php");
