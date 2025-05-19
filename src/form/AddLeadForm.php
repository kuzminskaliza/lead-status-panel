<?php

namespace App\form;

class AddLeadForm
{
    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public string $phone = '';
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
        $this->errors = [];
        if (empty($this->firstName)) {
            $this->errors['firstName'] = 'First name is required';
        }
        if (empty($this->lastName)) {
            $this->errors['lastName'] = 'Last name is required';
        }
        if (empty($this->email)) {
            $this->errors['email'] = 'Email is required';
        } elseif ($this->email !== filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Invalid email';
        }
        if (empty($this->phone)) {
            $this->errors['phone'] = 'Phone is required';
        } elseif (!preg_match('/^\+?[0-9]{10,15}$/', $this->phone)) {
            $this->errors['phone'] = 'Invalid phone';
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
    public function getLabel(string $property): string
    {
        $labels = [
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'email' => 'Email',
            'phone' => 'Phone',
        ];
        return $labels[$property] ?? '';
    }

    public function getErrors($data): string
    {
        return $this->errors[$data] ?? '';
    }
    public function hasErrors($data): bool
    {
        return isset($this->errors[$data]);
    }
}