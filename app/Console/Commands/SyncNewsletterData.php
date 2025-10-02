<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncNewsletterData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:sync {database}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync newsletter data from SQLite to MySQL';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $database = $this->argument('database');
        
        try {
            // Najpierw stwórz tabelę w MySQL jeśli nie istnieje
            $mysql = \DB::connection('mysql');
            $mysql->getPdo()->exec("USE `{$database}`");
            
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
            $this->info("MySQL table created/verified");
            
            // Pobierz dane z SQLite
            $sqliteData = \DB::connection('sqlite')
                ->table('newsletter_subscriptions')
                ->get();
            
            if ($sqliteData->isEmpty()) {
                $this->info("No data found in SQLite database");
                return;
            }
            
            // Wstaw dane do MySQL
            $count = 0;
            foreach ($sqliteData as $row) {
                try {
                    $mysql->table('newsletter_subscriptions')->insertOrIgnore([
                        'email' => $row->email,
                        'status' => $row->status,
                        'subscribed_at' => $row->subscribed_at,
                        'unsubscribed_at' => $row->unsubscribed_at,
                        'unsubscribe_token' => $row->unsubscribe_token,
                        'created_at' => $row->created_at,
                        'updated_at' => $row->updated_at,
                    ]);
                    $count++;
                } catch (\Exception $e) {
                    $this->warn("Could not insert {$row->email}: " . $e->getMessage());
                }
            }
            
            $this->info("Synced {$count} newsletter subscriptions to MySQL database: {$database}");
            
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
        }
    }
}
