<?php
/**
 * @var \omnilight\scheduling\Schedule $schedule
 */
/**
 * 任务调度
 * crontab -e * * * * * php /path/to/yii schedule/run  1>> /dev/null 2>&1
 * @see
 */

// $schedule->command('migrate')->cron('* * * * *');

// $schedule->exec('composer self-update')->daily();

//$schedule->exec('ls -al >> test.log')->cron('* * * * *');