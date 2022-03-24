<?php

if (!function_exists('flashSession')) {
    function flashSession(string $msg, string $class = 'success')
    {
        session()->flash('message', $msg);
        session()->flash('alert-class', $class);
    }
}

if (!function_exists('generateSalt')) {
    function generateSalt()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
