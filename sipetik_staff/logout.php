<?php
session_start();
$_SESSION=["login_staff"];
session_unset();
session_destroy();
header("Location: login_staff.php");
exit()

?>