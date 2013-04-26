<?php

// config/autoload/global.php:
return array(
	'service_manager' => array(
		'factories' => array(
			'Zend\Db\Adapter\Adapter'
			=> 'Zend\Db\Adapter\AdapterServiceFactory',
		),
		'aliases' => array(
			'db' => 'Zend\Db\Adapter\Adapter',
		),
	),
	'db' => array(
		'driver' => 'Pdo',
		'dsn' => 'mysql:dbname=test;host=localhost',
		'username' => 'root',
		'password' => '',
		'driver_options' => array(
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
		),
	),
	'doctrine' => array(
		'connection' => array(
			'orm_default' => array(
				'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
				'params' => array(
					'host' => 'localhost',
					'port' => '3306',
					'dbname' => 'test',
					'user' => 'root',
					'password' => '',
				)
			)
		)
	),
);

