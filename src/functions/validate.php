<?php
// валидация полей html-форм
function validate($str): string
{
    $str = (string) $str;
    $str = strip_tags($str);
    $str = trim($str);
    $str = preg_replace('/\s+/', ' ', $str);
    return htmlentities($str);
}

function isNotEmpty($str): bool
{
    if ((mb_strlen($str) > 0)) {
        return true;
    } else {
        $_SESSION['errorMessage'] = 'Необходимо корректно заполнить пустые поля';
        header('Location: ../pages/feedback.php');
        return false;
    }
}
