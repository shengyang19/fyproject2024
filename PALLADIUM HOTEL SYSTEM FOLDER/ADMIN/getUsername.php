<?php
session_start();
echo isset($_SESSION['info']) ? $_SESSION['info'] : '';
?>