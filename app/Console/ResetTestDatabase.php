<?php

namespace Modules\RH\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ResetTestDatabase extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'rh:db-reset-test {module?}';

    /**
     * The console command description.
     */
    protected $description = '[RH] Remettre à plat la bdd TEST , exécuter migration et les seeders + module RH.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Remise à plat de la base de données TEST et du module RH ...');
        
        // Executer Migration
        $this->call('migrate:fresh', ['--env' => 'testing']);

        // Executer les seeders
        $this->call('db:seed', ['--env' => 'testing']);

        $module = $this->argument('module') ?: 'RH';
        if ($module){
            $this->call('module:seed', ['module' => $module, '--env' => 'testing']);
        }

        $this->info('SUCCESS : Base de données TEST remise à plat ');

    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [
            ['module', InputArgument::REQUIRED, 'Le nom du Module à Seeder.'],
        ];
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
