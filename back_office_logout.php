<?php
session_start();
unset($_session);
session_destroy();
session_write_close();
header('Location: back_office_login.php');
die;
?>