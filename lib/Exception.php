<?php
namespace Somefirm\Emptymodule; // need to set

use Bitrix\Main\SystemException;

trait Exception
{
    public function exceptionHandler($exception)
    {
        $this->lastError =
            $exception->getFile()."(".$exception->getLine()."): ".$exception->getMessage()."\r\n".
            $exception->getTraceAsString()
        ;
        $this->createReport('exception_log.txt', $this->lastError);
        echo $this->lastError;
        die();
    }

    public function createReport($fileName, $report)
    {
        $prefix = trim(strtolower(str_replace('\\', '_', __NAMESPACE__)), '_');

        $text = date('Y.m.d H:i:s')."\r\n";
        $text .= print_r($report, true)."\r\n\r\n";

        $handle = @fopen($_SERVER['DOCUMENT_ROOT'].'/upload/'.$prefix.'_'.$fileName, 'a');
        fwrite($handle, $text);
        fclose($handle);
    }
}
