<?php
namespace Somefirm\Emptymodule; // need to set

use Bitrix\Main\SystemException;

class Wrappers
{
    use Exception;

    public $lastError;

    public function __construct($objects = [])
    {
        $this->getObjects($objects);
    }

    protected function getObjects($objects)
    {
        try {
            $needObjects = [
                'CIBlockElement', // Bitrix
                'Option', // Bitrix D7
                'CAgent', // Bitrix
            ];

            foreach ($needObjects as $obj) {
                if (!empty($objects[$obj])) {
                    $this->{$obj} = $objects[$obj];
                } else {
                    $className = __NAMESPACE__."\\Wrappers\\".$obj;
                    $this->{$obj} = new $className();
                }
            }
        } catch (SystemException $exception) {
            $this->exceptionHandler($exception);
        }
    }
}
