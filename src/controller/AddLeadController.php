<?php

namespace App\controller;

use App\components\BelmarProApiService;
use App\form\AddLeadForm;
use App\view\ViewRender;
use Exception;

class AddLeadController
{
    private ViewRender $viewRender;
    private BelmarProApiService $apiService;

    public function __construct()
    {
        $this->viewRender = new ViewRender();
        $this->apiService = new BelmarProApiService();
    }

    public function run(): void
    {
        $form = new AddLeadForm();
        $error = '';
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $form->load($_POST);
                if ($form->validate()) {
                    $response = $this->apiService->addLead($form->getData());
                    if (!empty($response)) {
                        header("Location: /statuses.php");
                    }
                }
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        echo $this->viewRender->renderTemplate(
            'add-lead',
            ['form' => $form,
                'error' => $error,
            ]
        );
    }
}