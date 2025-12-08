<?php

class LogObserver implements SplObserver
{
    private $logFile;

    public function __construct($logFile = 'ventas.log')
    {
        $this->logFile = $logFile;
    }

    public function update(SplSubject $subject): void
    {
        $message = date('[Y-m-d H:i:s]') . " - Boleto vendido\n";
        file_put_contents($this->logFile, $message, FILE_APPEND);
    }
}
