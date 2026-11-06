<?php

header('Content-Type: text/plain');
header('X-Test-Header: php-direct');
header('Set-Cookie: php_test=working; Path=/; Secure; HttpOnly; SameSite=Lax');

echo 'PHP direct header test';
