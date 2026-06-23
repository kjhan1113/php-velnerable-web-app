<?php
session_start();
session_unset();     // Remove session variable
session_destroy();   // Destroy session

header("Location: home.php");
exit;