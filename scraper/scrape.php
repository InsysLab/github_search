<?php

/* Github api request */
require('github_repositories.php');

/* DB queries */
require('../db/db_repositories.php');

/* Retrieve repository data from api */
$github = new Github_Repositories();

/* Store to db */
$dbr = new DB_Repositories();
$data = $github->getRepos();
$dbr->save($data);

echo "Done!";