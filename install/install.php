<?php
use Bitrix\Main\Localization\Loc;

if (!check_bitrix_sessid()) return;

Loc::loadMessages(__FILE__);

echo CAdminMessage::ShowNote(Loc::getMessage("MOD_INST_OK"));
?>
<form action="<?=$APPLICATION->GetCurPage()?>">
    <input type="hidden" name="lang" value="<?=LANG?>">
    <input type="submit" name="" value="<?=Loc::getMessage("MOD_BACK")?>">
</form>
