<?php
function isEmailDuplicate($email): bool
{
    $result = query("SELECT * FROM `users` WHERE email = ?;", [$email]);
    if (count($result)) {
        return true;
    } else {
        return false;
    }
}