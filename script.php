<?php

    echo "Hello this is a script, but has no access to the app.";

    // ini_set('session.cookie_lifetime', 604800);
    // ini_set('session.gc_maxlifetime', 604800);
    // ini_set('session.name ', 'jmgalleriesession');
    session_start();
    print phpinfo();

?>