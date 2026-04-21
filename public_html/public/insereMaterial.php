<?php
session_start();
// ALTERADO: Endpoint legado removido definitivamente por segurança; usar material.php.
header('location:material.php');
exit;
