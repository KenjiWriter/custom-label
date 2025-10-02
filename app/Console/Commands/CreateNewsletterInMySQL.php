<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateNewsletterInMySQL extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:create-mysql {database}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create newsletter table in MySQL database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $database = $this->argument('database');
        
        try {
            // Połącz się z MySQL
            $mysql = \DB::connection('mysql');
            $mysql->getPdo()->exec("USE `{$database}`");
            
            // Stwórz tabelę newsletter_subscriptions
            $sql = "
                CREATE TABLE IF NOT EXISTS `newsletter_subscriptions` (
                    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                    `email` varchar(255) NOT NULL,
                    `status` varchar(255) NOT NULL DEFAULT 'active',
                    `subscribed_at` timestamp NULL DEFAULT NULL,
                    `unsubscribed_at` timestamp NULL DEFAULT NULL,
                    `unsubscribe_token` varchar(255) DEFAULT NULL,
                    `created_at` timestamp NULL DEFAULT NULL,
                    `updated_at` timestamp NULL DEFAULT NULL,
                    PRIMARY KEY (`id`),
                    UNIQUE KEY `newsletter_subscriptions_email_unique` (`email`),
                    UNIQUE KEY `newsletter_subscriptions_unsubscribe_token_unique` (`unsubscribe_token`),
                    KEY `newsletter_subscriptions_email_status_index` (`email`,`status`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
            ";
            
            $mysql->getPdo()->exec($sql);
            
            $this->info("Newsletter table created successfully in database: {$database}");
            $this->info("You can now see it in phpMyAdmin!");
            
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
        }
    }
}
