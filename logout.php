<?php

session_start();


        // unset all session variables
        session_unset();

        // destroy the session
        session_destroy();

        // redirect to the main index page
        header('Location: http://localhost/project/');
        exit();
