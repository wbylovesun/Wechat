<?php
require_once 'autoload.php';

use Wechat\MultiMedia\Voice;

$voice = new Voice();
$result = $voice->setAccessToken($token)
                ->download('Y9RMK2FS0VDwSlipRylEg5pCgIGF3W6pJCrAwQGcjC-KXObU8_drdXSLSKretIrm', 'E:\\');

echo $result === false ? $voice->getErrCode() : $result;