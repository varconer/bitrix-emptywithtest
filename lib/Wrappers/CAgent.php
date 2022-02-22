<?php
namespace Somefirm\Emptymodule\Wrappers; // need to set

class CAgent {
    public function RemoveAgent(...$args) {
        return \CAgent::RemoveAgent(...$args);
    }

    public function AddAgent(...$args) {
        return \CAgent::AddAgent(...$args);
    }
}
