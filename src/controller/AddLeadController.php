<?php

namespace App\controller;

use App\components\BelmarProApiService;
use App\form\AddLeadForm;
use App\view\ViewRender;

class AddLeadController
{
    private array $config;
    private ViewRender $viewRender;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->viewRender = new ViewRender();
    }

    public function run(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlerFormSubmit();
        } else {
            $this->renderForm();
        }
    }

    private function handlerFormSubmit(): void
    {
        $form = new AddLeadForm();
        $form->load($_POST);

        $response = [];
        $success = false;

        if ($form->validate()) {
            $baseUrl = $this->config['params']['baseUrl'] ?? '';
            $token = $this->config['params']['token'] ?? '';

            $apiService = new BelmarProApiService($baseUrl, $token);
            $response = $apiService->addLead($form->getData());
            $success = true;
        }
        echo $this->viewRender->renderTemplate(__DIR__ . '/../view/template/add-lead.php', [
            'success' => $success,
            'response' => $response,
            'vendor_url' => $this->config['params']['vendor_url'] ?? '',
        ]);
    }

    private function renderForm(): void
    {
        echo $this->viewRender->renderTemplate(__DIR__ . '/../view/template/add-lead.php', [
            'success' => false,
            'response' => [],
            'vendor_url' => $this->config['params']['vendor_url'] ?? '',
        ]);
    }
}