<?php
//  реквизиты доступа к БД
$dbName = 'cat_book.sql';

return [
	  'class' => 'yii\db\Connection',
	  'dsn' => "sqlite:@app/data/$dbName",
	  'charset' => 'utf8'
];
