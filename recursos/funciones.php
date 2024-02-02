<?php

function generarTokenUnico($length = 50) {
    return bin2hex(random_bytes($length));
}

?>
