<?php
/**
 * Created by PhpStorm.
 * User: Valentin Beaury
 * Date: 11/02/2019
 * Time: 14:45
 */
session_start();
session_destroy();
header('Location: index.php');