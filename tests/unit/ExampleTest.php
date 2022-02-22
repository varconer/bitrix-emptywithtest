<?php
namespace Somefirm\Emptymodule; // need to set

use Bitrix\Main\Loader;

class ExampleTest extends BitrixTestCase
{
    public function testExampleMethod()
    {
        // входные параметры
        $param = [];

        // результат для проверки
        $expectedResult = [1, 2];

        // заглушки
        Loader::includeModule('iblock');

        $CIBlockResultStub = $this->createMock(\CIBlockResult::class);
        $fetchResults = [
            [
                'ID' => 1,
            ],
            [
                'ID' => 2,
            ],
            false,
        ];
        $CIBlockResultStub->method('Fetch')
            ->will($this->onConsecutiveCalls(...$fetchResults));

        $CIBlockElementStub = $this->createMock(Wrappers\CIBlockElement::class);
        $CIBlockElementStub->method('GetList')
            ->willReturn($CIBlockResultStub);

        // вычисление результата
        $object = new Example([
            'CIBlockElement' => $CIBlockElementStub,
        ]);
        $result = $object->exampleMethod($param);

        // проверка
        $this->assertEquals($expectedResult, $result);
    }
}
