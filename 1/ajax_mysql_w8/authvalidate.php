<?php
session_start();
if(empty($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
else {
    if($_SESSION['username']['role_id'] == 0) {
        header('Location: index.php');
        exit;
    }
}