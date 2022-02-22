<?php
namespace Somefirm\Emptymodule; // need to set

class Main {
    protected $moduleId;
    public $lastError;

    public function __construct()
    {
        $this->moduleId = basename(__DIR__);
    }

    public function getModuleId()
    {
        return $this->moduleId;
    }
}

require_once('autoload.php');
?>
