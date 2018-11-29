<?php
/**
 *  Настройки доступа к файловой системе БД
 */

$dbDir = '../data';
$dbDirFiles = $dbDir.'/*';

exec('chmod -Rf 0777 '.$dbDir);
exec('chmod -f 0777 '.$dbDirFiles);
exec('chown -Rf "www-data":"www-data" '.$dbDir);
exec('chown -f "www-data":"www-data" '.$dbDirFiles);

/**
 *  Конфигурация доступа к БД
 */
$dbName = 'cat_book.sql';

return [
	  'class' => 'yii\db\Connection',
	  'dsn' => "sqlite:@app/data/$dbName",
	  'charset' => 'utf8'
];