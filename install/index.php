<?php
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class somefirm_emptymodule extends CModule { // need to set
    var $MODULE_ID;
    var $MODULE_SUFFIX;
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;
    var $MODULE_GROUP_RIGHTS = "Y";

    function __construct() {
        $this->MODULE_ID = str_replace("_", ".", __CLASS__);
        $this->MODULE_SUFFIX = strtoupper($this->MODULE_ID);
        $arModuleVersion = [];

        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path."/version.php");

        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        } else {
            $this->MODULE_VERSION = "1.0.0";
            $this->MODULE_VERSION_DATE = "2022-02-22";
        }

        $this->MODULE_NAME = Loc::getMessage($this->MODULE_SUFFIX.".INSTALL_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage($this->MODULE_SUFFIX.".INSTALL_DESCRIPTION");
        $this->PARTNER_NAME = Loc::getMessage($this->MODULE_SUFFIX.".INSTALL_COMPANY_NAME");
        $this->PARTNER_URI  = "https://somefirm.com/"; // need to set
    }

    // Install functions
    function InstallDB() {
        RegisterModule($this->MODULE_ID);
        return true;
    }

    function InstallFiles() {
        return true;
    }

    function InstallPublic() {
        return true;
    }

    function InstallEvents() {
        return true;
    }

    // UnInstal functions
    function UnInstallDB($arParams = []) {
        UnRegisterModule($this->MODULE_ID);
        return true;
    }

    function UnInstallFiles() {
        return true;
    }

    function UnInstallPublic() {
        return true;
    }

    function UnInstallEvents() {
        return true;
    }

    function DoInstall() {
        global $APPLICATION, $step;
        $keyGoodFiles = $this->InstallFiles();
        $keyGoodDB = $this->InstallDB();
        $keyGoodEvents = $this->InstallEvents();
        $keyGoodPublic = $this->InstallPublic();
        $APPLICATION->IncludeAdminFile(
            Loc::getMessage("SPER_INSTALL_TITLE"),
            $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/install.php"
        );
    }

    function DoUninstall() {
        global $APPLICATION, $step;
        $keyGoodFiles = $this->UnInstallFiles();
        $keyGoodDB = $this->UnInstallDB();
        $keyGoodEvents = $this->UnInstallEvents();
        $keyGoodPublic = $this->UnInstallPublic();
        $APPLICATION->IncludeAdminFile(
            Loc::getMessage("SPER_UNINSTALL_TITLE"),
            $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/uninstall.php"
        );
    }
}
?>
