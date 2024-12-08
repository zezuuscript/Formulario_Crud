<?php
if (!isset($_SESSION)) {
    session_start();
}

session_destroy();
echo "<script>alert('Sua sessão foi finalizada com sucesso.'); window.location.href = 'login.html';</script>";
