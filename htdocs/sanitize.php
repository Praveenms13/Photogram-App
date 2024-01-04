<?php

function getsanitizeInput($input) {
    $input = preg_replace('/[^a-zA-Z@&#?=.0-9:\s&\/-]|(alert|prompt|script)/i', '', $input);
    return $input;
}

function postsanitizeInput($input) {
    $input = preg_replace('/[<>&"\'\x00-\x1F\x7F-\xFF]/', '', $input);
    $input = preg_replace('/\b(alert|prompt|script)\b/i', '', $input);
    return $input;
}
