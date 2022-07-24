<?php


function remove_spacing($string): string|null
{
    return $string = preg_replace('/\s+/', '', $string);
}

function demo(){
    return "demo txt";
}
