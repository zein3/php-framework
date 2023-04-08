<?php

namespace App\Core;

class ErrorController extends Controller {
    private int $error_code;
    private string $message;

    public function __construct($error_code, string $message) {
        $this->error_code = (is_numeric($error_code)) ? $error_code : 500;
        $this->message = $message;
    }

    public function show() {
        $this->view('error', [
            'error_code' => $this->error_code,
            'message' => $this->message
        ]);
    }
}