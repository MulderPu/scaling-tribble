<?php

return [

	/*
	|--------------------------------------------------------------------------
	| PDO Fetch Style
	|--------------------------------------------------------------------------
	|
	| By default, database results will be returned as instances of the PHP
	| stdClass object; however, you may desire to retrieve records in an
	| array format for simplicity. Here you can tweak the fetch style.
	|
	*/

	'fetch' => PDO::FETCH_CLASS,

	/*
	|--------------------------------------------------------------------------
	| Default Database Connection Name
	|--------------------------------------------------------------------------
	|
	| Here you may specify which of the database connections below you wish
	| to use as your default connection for all database work. Of course
	| you may use many connections at once using the Database library.
	|
	*/

	'default' => env('DB_DRIVER', 'mysql'),

	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	|
	| Here are each of the database connections setup for your application.
	| Of course, examples of configuring each database platform that is
	| supported by Laravel is shown below to make development simple.
	|
	|
	| All database work in Laravel is done through the PHP PDO facilities
	| so make sure you have the driver for your particular database of
	| choice installed on your machine before you begin development.
	|
	| OpenShift Notes:
	|   MySQL:      https://developers.openshift.com/en/databases-mysql.html
	|   PostgreSQL: https://developers.openshift.com/en/databases-postgresql.html
	*/

	'connections' => [

		'sqlite' => [
			'driver'   => 'sqlite',
			'database' => storage_path().'/database.sqlite3',
			'prefix'   => '',
		],

		#primary database connection
		'mysql' => [
			'driver'    => 'mysql',
			'host'      => env('DB_HOST', env('OPENSHIFT_MYSQL_DB_HOST', 'localhost')),
			'port'      => env('DB_PORT', env('OPENSHIFT_MYSQL_DB_PORT', 3306)),
			'database'  => env('DB_DATABASE', env('OPENSHIFT_APP_NAME', 'forge')),
			'username'  => env('DB_USERNAME', env('OPENSHIFT_MYSQL_DB_USERNAME', 'forge')),
			'password'  => env('DB_PASSWORD', env('OPENSHIFT_MYSQL_DB_PASSWORD', '')),
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
			'strict'    => false,
		],

		#secondary database connection
		'mysql2' => [
			'driver'    => 'mysql',
			'host'      => env('DB_EXT_HOST', env('OPENSHIFT_EXTMYSQL_DB_HOST', 'localhost')),
			'port'      => env('DB_EXT_PORT', env('OPENSHIFT_EXTMYSQL_DB_PORT', 43936)),
			'database'  => env('DB_EXT_DATABASE', env('OPENSHIFT_EXTMYSQL_DB_NAME', 'forge')),
			'username'  => env('DB_EXT_USERNAME', env('OPENSHIFT_EXTMYSQL_DB_USERNAME', 'forge')),
			'password'  => env('DB_EXT_PASSWORD', env('OPENSHIFT_EXTMYSQL_DB_PASSWORD', '')),
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
			'strict'    => false,
		],

		'pgsql' => [
			'driver'   => 'pgsql',
			'host'     => env('DB_HOST', env('OPENSHIFT_POSTGRESQL_DB_HOST', 'localhost')),
			'port'     => env('DB_PORT', env('OPENSHIFT_POSTGRESQL_DB_PORT', 5432)),
			'database' => env('DB_DATABASE', env('OPENSHIFT_APP_NAME', 'forge')),
			'username' => env('DB_USERNAME', env('OPENSHIFT_POSTGRESQL_DB_USERNAME', 'forge')),
			'password' => env('DB_PASSWORD', env('OPENSHIFT_POSTGRESQL_DB_PASSWORD', '')),
			'charset'  => 'utf8',
			'prefix'   => '',
			'schema'   => 'public',
		]

	],

	/*
	|--------------------------------------------------------------------------
	| Migration Repository Table
	|--------------------------------------------------------------------------
	|
	| This table keeps track of all the migrations that have already run for
	| your application. Using this information, we can determine which of
	| the migrations on disk haven't actually been run in the database.
	|
	*/

	'migrations' => 'migrations',

	/*
	|--------------------------------------------------------------------------
	| Redis Databases
	|--------------------------------------------------------------------------
	|
	| Redis is an open source, fast, and advanced key-value store that also
	| provides a richer set of commands than a typical key-value systems
	| such as APC or Memcached. Laravel makes it easy to dig right in.
	|
	| OpenShift Notes:
	|   Redis:       https://hub.openshift.com/addons/34-redis
	|   Redis Cloud: https://hub.openshift.com/addons/17-rediscloud
	|
	*/

	'redis' => [

		'cluster' => false,

		'default' => [
			'host'     => '127.0.0.1',
			'port'     => 6379,
			'database' => 0,
		],

	],

];
