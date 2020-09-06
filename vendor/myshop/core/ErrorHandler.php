<?php

namespace myshop;


class ErrorHandler
{
    /**
     * ErrorHandler constructor.
     */
    public function __construct()
    {
        if(DEBUG)
            error_reporting(-1);
        else
            error_reporting(0);
        set_exception_handler([$this,'exceptionHendler']);
    }

    public function exceptionHendler($e){
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    protected function logErrors($message = '', $file = '', $line = ''){
        error_log(
            "[". date('Y-m-d H:i:s') ."] Ошибка: {$message} | Файл: {$file} | Строка: {$line} \n===============\n",
            3,
            ROOT.'/tmp/errors.log');
    }

    protected function displayError($errorNumber,$errorStr, $errorFile, $errorLine, $responce = 404){
            http_response_code($responce);
            if($responce === 404 && !DEBUG){
                require WWW.'/errors/404.php';
                die;
            }
            if(DEBUG)
            {
                require WWW.'/errors/dev.php';
            }
            else
                require WWW.'/errors/prod.php';

    }
}