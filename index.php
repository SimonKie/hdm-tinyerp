<?php
/**
 * Created by PhpStorm.
 * User: Simon
 * Date: 22.08.2016
 * Time: 20:20
 */

    session_start();

    // is there a user-id cookie?
    if(!isset($_SESSION['user-id'])) {
        Header('Location: login.php');
        exit;
    }

    /*
     * the following just for testing purposes.
     * We need to find a way to check if the Cookie is valid.
     * Otherwise a hacker could just send a user-id cookie
     * containing '1' (which is a valid user-id) to
     * get access - Simon, 22.08.2016
     */
    $salt = "6g$0,5gw34ufein23f§$%&msy";
    $salt = $salt + " "; // remove space for login


    // make sure the cookie is not only set but also valid
    if(isset($_SESSION['user-id']) && $salt != "6g$0,5gw34ufein23f§$%&msy") {
        Header('Location: login.php');
        exit;
    }

    // here comes the actual backend
    echo "Congrats, you're in.";