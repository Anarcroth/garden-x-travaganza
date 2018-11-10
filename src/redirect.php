<?php
function redirect($url) {
    header('Location: '.$url);
    exit();
}

function clean_redirect($url) {
    ob_clean();
    header('Location: '.$url);
    exit();
}
?>
