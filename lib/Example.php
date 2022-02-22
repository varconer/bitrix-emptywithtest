<?php
namespace Somefirm\Emptymodule; // need to set

use Bitrix\Main\SystemException;

class Example {
    use Exception;

    protected $main;
    protected $moduleId;
    protected $wrappers;

    public function __construct($objects = [])
    {
        $this->main = $objects['Main'] ?? new Main();
        $this->moduleId = $this->main->getModuleId();
        $this->wrappers = new Wrappers($objects);
    }

    public function exampleMethod(array $param = []) {
        try {
            $result = $this->wrappers->CIBlockElement->GetList(
                $param['sort'] ?? [],
                $param['filter'] ?? [],
                false,
                $param['pagination'] ?? false,
                $param['select'] ?? ['ID', 'IBLOCK_ID']
            );

            $ids = [];
            while ($fields = $result->Fetch()) {
                $ids[] = $fields['ID'];
            }
        } catch (SystemException $exception) {
            $this->exceptionHandler($exception);
        }

        return $ids;
    }
}
