
<?php


if (isset($errors)) {
    foreach ($errors as $error)
    {
        echo "<p class='error'>$error</p>";
    }
}