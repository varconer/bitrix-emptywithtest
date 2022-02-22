<?php
use Bitrix\Main\Loader;
use Bitrix\Main\Web\Uri;
use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;

if (!$USER->IsAdmin()) return;

$moduleId = basename(__DIR__);
$suffix = strtoupper($moduleId);

Loc::loadMessages(__FILE__);
Loader::includeModule($moduleId);

$request = Application::getInstance()->getContext()->getRequest();
$uriString = $request->getRequestUri();
$uri = new Uri($uriString);
$redirect = $uri->getUri();

$aTabs = [
    [
        "DIV" => str_replace(".", "_", $moduleId),
        "TAB" => Loc::getMessage($suffix.".SETTINGS"),
        "ICON" => "settings",
        "TITLE" => Loc::getMessage($suffix.".TITLE"),
    ],
];
$arAllOptions = [
    "main" => [
        Loc::getMessage($suffix.".LABEL"),
        ["note" => Loc::getMessage($suffix.".NOTE")],
        ["test", Loc::getMessage($suffix.".TEST"), "", ["text", 20]],
        ["test2", Loc::getMessage($suffix.".TEST2"), "", ["checkbox", ""]],
        ["test3", Loc::getMessage($suffix.".TEST3"), "", ["selectbox", [
            "val1" => "Value 1",
            "val2" => "Value 2",
        ]]],
        ["test4", Loc::getMessage($suffix.".TEST4"), "", ["multiselectbox", [
            "val1" => "Value 1",
            "val2" => "Value 2",
        ]]],
        ["test5", Loc::getMessage($suffix.".TEST5"), "", ["textarea", 10, 50]],
        ["test6", Loc::getMessage($suffix.".TEST6"), "", ["password", 20]],
    ],
];

if ((isset($_REQUEST["save"]) || isset($_REQUEST["apply"])) && check_bitrix_sessid()) {
    __AdmSettingsSaveOptions($moduleId, $arAllOptions["main"]);
    LocalRedirect($redirect);
}

$tabControl = new CAdminTabControl("tabControl", $aTabs);
?>
<form method="post" action="<?=$redirect?>" name="<?=str_replace(".", "_", $moduleId)?>">
    <?
    echo bitrix_sessid_post();

    $tabControl->Begin();

    $tabControl->BeginNextTab();

    __AdmSettingsDrawList($moduleId, $arAllOptions["main"]);

    $tabControl->Buttons([]);
    $tabControl->End();
    ?>
</form>
