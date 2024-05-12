<?php
 function generateApiKey($length = 32) {
    return hash('sha256', bin2hex(random_bytes($length)));
}

 function generateSha256Hash($inputString) {
    return hash('sha256', $inputString);
}
?>