<?php

  $host = "crimsonbookstore";
  $user = "jharvard";
  $pass = "crimson";

  $databaseName = "crimsonbookstore";
  $tableName = "variables";

  $con = mysql_connect($host,$user,$pass);
  $dbs = mysql_select_db($databaseName, $con);