<?php
namespace Somefirm\Emptymodule\Wrappers; // need to set

class Option {
    public function get(...$args) {
        return \Bitrix\Main\Config\Option::get(...$args);
    }

    public function set(...$args) {
        return \Bitrix\Main\Config\Option::set(...$args);
    }
}
