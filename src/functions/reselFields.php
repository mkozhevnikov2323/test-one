<?php
function resetTextFields(): void
{
    $_SESSION['user']['name'] = '';
    $_SESSION['user']['comment'] = '';
    header('Location: ../../pages/feedback.php');
}

if (isset($_GET['reset'])) {
    resetTextFields();
}