<?php
$cronfiles=exec('crontab -l > cron.txt ',$output);
echo "<pre>";
print_r($output);