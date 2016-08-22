<?php
/**
 * Created by PhpStorm.
 * User: Simon
 * Date: 22.08.2016
 * Time: 20:31
 */

    session_start();

    // do both fields contain information?
    if(isset($_POST['username']) && isset($_POST['password'])) {
        // TODO check if the credentials are correct, if yes set $_SESSION['user-id']
        if(false) {
            $_SESSION['user-id'] = 1;
        } else {
            // TODO output form with error 'please enter correct username and password'
        }
    }

    else if(isset($_POST['username'])) {
        // TODO output form with error 'please enter password'
    }

    else if(isset($_POST['password'])) {
        // TODO output form with error 'please enter username'
    }

    // did we just set a cookie? cool, back to index.php
    if(isset($_SESSION['user-id'])) {
        Header('Location: index.php');
        exit;
    } else {
        // TODO output form without errors
    }