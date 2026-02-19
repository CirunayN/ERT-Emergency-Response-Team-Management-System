<?php

class Incident
{
    public static function all(): array
    {
        if (!isset($_SESSION['incidents'])) {
            $_SESSION['incidents'] = [];
        }
        return $_SESSION['incidents'];
    }

    public static function create(array $data): void
    {
        if (!isset($_SESSION['incidents'])) {
            $_SESSION['incidents'] = [];
        }
     
        $_SESSION['incidents'][] = $data;
    }
}
