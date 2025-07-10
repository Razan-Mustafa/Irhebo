<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncMiniDB extends Command
{
    protected $signature = 'sync:mini-db';
    protected $description = 'Sync selected tables from Mini DB to Main DB';

    public function handle()
    {
        $tablesToSync = [
            'users',
            'user_languages',
            'freelancers',
            'freelancer_certificates',
            'freelancer_cateogries',
            'categories',
            'category_translations',
            'sub_categories',
            'sub_category_translations',
            'tags',
            'tag_translations',
            'services',
            'service_media',
            'service_tags',
            'service_translations',
            'portfolios',
            'portfolio_media',
            'portfolio_services',
            'plans',
            'plan_translations',
            'plan_features',
            'plan_feature_translations',
            'professions',
            'profession_translations',
            'languages',
            'countries',
            'currencies',
            'faqs',
            'faq_translations',
            'generals',
            'wishlists',
        ];

        foreach ($tablesToSync as $table) {
            $this->info("Syncing table: $table");

            $rows = DB::connection('mini_db')->table($table)->get();

            foreach ($rows as $row) {
                // You may use updateOrInsert based on 'id' or another unique key
                DB::table($table)->updateOrInsert(
                    ['id' => $row->id],
                    (array) $row
                );
            }
        }

        $this->info('✅ Sync completed.');
    }
}
