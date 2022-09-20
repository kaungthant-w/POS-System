<?php
session_start();
session_destroy();

// header("location:home");

echo '
    <script>
        window.location = "home";
    </script>
';