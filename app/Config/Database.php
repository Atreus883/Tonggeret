<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to use if no other is specified.
     */
    public string $defaultGroup = 'default';

    /**
     * The default database connection.
     *
     * @var array<string, mixed>
     */
    public array $default = [];

    /**
     * This database connection is used when running PHPUnit database tests.
     * @var array<string, mixed>
     */
    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => 'utf8_general_ci',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => false,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
    ];

    public function __construct()
    {
        parent::__construct();


    if (ENVIRONMENT === 'testing') {
        $this->defaultGroup = 'tests';

    }
    
    if (getenv('database.default.hostname')) {
        $this->default['hostname'] = getenv('database.default.hostname');
        $this->default['username'] = getenv('database.default.username');
        $this->default['password'] = getenv('database.default.password');
        $this->default['database'] = getenv('database.default.database');
        $this->default['DBDriver'] = getenv('database.default.DBDriver');
        $this->default['port']= getenv('database.default.port');
    }


    }

}
