<?php

session_start();

//unset all the current sessions
session_unset();

//all sessions are completely removed
session_destroy();

header("Location: index.php");
