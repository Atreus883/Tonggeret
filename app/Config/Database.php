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
     * This is the configuration used for local development.
     * @var array<string, mixed>
     */
    public array $default = [
        'DSN'      => '',
        'hostname' => $_ENV['DATABASE_HOSTNAME'] ?? 'localhost',
        'username' => $_ENV['DATABASE_USERNAME'] ?? 'root',
        'password' => $_ENV['DATABASE_PASSWORD'] ?? '',
        'database' => $_ENV['DATABASE_NAME'] ?? '',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => ($_ENV['CI_ENVIRONMENT'] !== 'production'),
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => $_ENV['DATABASE_PORT'] ?? 3306,
    ];

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

        // =================================================================
        // KODE UNTUK MEMBACA ENVIRONMENT VARIABLES DARI RENDER
        // =================================================================
        if (getenv('database.default.hostname')) {
            $this->default['hostname'] = getenv('database.default.hostname');
            $this->default['username'] = getenv('database.default.username');
            $this->default['password'] = getenv('database.default.password');
            $this->default['database'] = getenv('database.default.database');
            $this->default['DBDriver'] = getenv('database.default.DBDriver');
            $this->default['port']     = getenv('database.default.port');
        }
    }
}
