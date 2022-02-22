<?php
namespace Somefirm\Emptymodule\Wrappers; // need to set

use Bitrix\Main\SystemException;
use Bitrix\Main\Loader;
use Somefirm\Emptymodule\Exception; // need to set

class CIBlockElement
{
    use Exception;

    protected $element;

    public function __construct() {
        try {
            if (!Loader::includeModule('iblock')) throw new SystemException("Module iblock don`t installed");
            $this->element = new \CIBlockElement;
        } catch (SystemException $exception) {
            $this->exceptionHandler($exception);
        }
    }

    public function GetList(...$args) {
        return \CIBlockElement::GetList(...$args);
    }

    public function Add(...$args) {
        try {
            $result = $this->element->Add(...$args);
            if (!$result) throw new SystemException($this->element->LAST_ERROR);
        } catch (SystemException $exception) {
            $this->exceptionHandler($exception);
        }

        return $result;
    }

    public function Update(...$args) {
        try {
            $result = $this->element->Update(...$args);
            if (!$result) throw new SystemException($this->element->LAST_ERROR);
        } catch (SystemException $exception) {
            $this->exceptionHandler($exception);
        }

        return $result;
    }

    public function SetPropertyValuesEx(...$args) {
        return \CIBlockElement::SetPropertyValuesEx(...$args);
    }

    public function GetPropertyValuesArray(&$items, ...$args)
    {
        \CIBlockElement::GetPropertyValuesArray($items, ...$args);

        return $items;
    }

    public function GetProperty(...$args)
    {
        return \CIBlockElement::GetProperty(...$args);
    }
}
