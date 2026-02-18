<?php

class Data {

    public function validate($reporter, $contact, $location, $type, $severity, $description) {

        if (empty($reporter) || empty($contact) || empty($location) || empty($type) || empty($severity) || empty($description)) {
            return "All fields are required!";
        }

        if (!is_numeric($contact) || strlen($contact) != 11) {
            return "Contact number must be exactly 11 digits!";
        }

        if (strlen($description) < 10) {
            return "Description must be at least 10 characters!";
        }

        return true;
    }

    public function create($reporter, $contact, $location, $type, $severity, $description): array {

        return [
            "reporter" => $reporter,
            "contact" => $contact,
            "location" => $location,
            "type" => $type,
            "severity" => $severity,
            "description" => $description,
            "datetime" => date("Y-m-d H:i:s")
        ];
    }
}
