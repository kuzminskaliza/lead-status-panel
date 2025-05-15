<?php

namespace App\form;

class AddLeadForm
{
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $phone;
    public array $errors = [];

    public function load(array $data): void
    {
        $this->firstName = trim($data['firstName'] ?? '');
        $this->lastName = trim($data['lastName'] ?? '');
        $this->email = trim($data['email'] ?? '');
        $this->phone = trim($data['phone'] ?? '');
    }

    public function validate(): bool
    {
        if (empty($this->firstName)) {
            $this->errors['firstName'] = 'First name is required';
        }
        if (empty($this->lastName)) {
            $this->errors['lastName'] = 'Last name is required';
        }
        if (empty($this->email)) {
            $this->errors['email'] = 'Email is required';
        }
        if (empty($this->phone)) {
            $this->errors['phone'] = 'Phone is required';
        }
        return empty($this->errors);
    }

    public function getData(): array
    {
        return [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'box_id' => 28,
            'offer_id' => 3,
            'countryCode' => 'RU',
            'language' => 'ru',
            'password' => 'qwerty12',
            'ip' => $_SERVER['REMOTE_ADDR'],
            'landingUrl' => $_SERVER['HTTP_HOST'] ?? '',
        ];
    }
}