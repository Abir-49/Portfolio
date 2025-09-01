<?php
session_start();
session_destroy();
setcookie("admin_logged_in", "", time()-86400, "/");
header("Location: login.php");
exit;
