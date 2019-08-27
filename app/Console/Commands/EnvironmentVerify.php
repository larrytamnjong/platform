<?php

namespace Ushahidi\App\Console\Commands;

use Illuminate\Console\Command;

use Ushahidi\App\Tools\OutputText;
use Composer\Script\Event;
use Composer\Installer\PackageEvent;

class EnvironmentVerify extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'environment:verify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify the environment setup.';
    protected $signature = 'environment:verify';

    private static $NO_ENV = "No environment file found. Please copy the .env.example file to create a new .env file.";
    private static $REQUIRED_ENV_KEYS = [
        "DB_CONNECTION" => "Please set `DB_CONNECTION=mysql` in the .env file.",
        "DB_HOST" => "Please set the address of your database in the DB_HOST key",
        "DB_PORT" => "Please set the port of your database in the DB_PORT key",
        "DB_DATABASE" => "Please set the name of your database in the DB_DATABASE key",
        "DB_USERNAME" => "Please set the username to connect to your database in the DB_USERNAME key",
        "DB_PASSWORD" => "Please set the password to connect to your database in the DB_PASSWORD key",
        "CACHE_DRIVER" => "Please set the CACHE_DRIVER according to your environment." .
                "See https://laravel.com/docs/5.8/cache#driver-prerequisites for more information on cache drivers.",
        "QUEUE_DRIVER" => "Please set the QUEUE_DRIVER according to your environment." .
                "See https://laravel.com/docs/5.8/queues for more information on queue drivers.",
    ];

    public static function verifyRequirements($console = true)
    {
        $env = new \Ushahidi\App\PlatformVerifier\Env();
        return $env->verifyRequirements(true);
    }

    public function verifyDB()
    {
        $db = new \Ushahidi\App\PlatformVerifier\Database();
        return $db->verifyRequirements(true);
    }
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        echo OutputText::info("Running ENV configuration checks");

        $this->verifyRequirements(true);

        echo OutputText::info("Running DB connectivity verification");

        $response = $this->verifyDB(true);
    }
}
