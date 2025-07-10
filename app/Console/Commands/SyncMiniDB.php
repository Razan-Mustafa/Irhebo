<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncMiniDB extends Command
{
    protected $signature = 'sync:to-mini-db';
    protected $description = 'Sync selected tables from Main DB to Mini DB';

    public function handle()
    {
        $tablesToSync = [
            'categories',
            'category_translations',
            'sub_categories',
            'sub_category_translations',
            'tags',
            'tag_translations',
            'professions',
            'profession_translations',
            'languages',
            'countries',
            'faqs',
            'faq_translations',
            'generals',
            'plans',
            'plan_translations',
            'users',
            'user_languages',
            'freelancers',
            'freelancer_certificates',
            'freelancer_cateogries',
            'services',
            'service_media',
            'service_tags',
            'service_translations',
            'portfolios',
            'portfolio_media',
            'portfolio_services',
            'plan_features',
            'plan_feature_translations',
            'wishlists',
        ];

        foreach ($tablesToSync as $table) {
            $this->info("Syncing table: $table");

            // read from default (main)
            $rows = DB::table($table)->get();

            foreach ($rows as $row) {
                // write to mini_db
                DB::connection('mini_db')->table($table)->updateOrInsert(
                    ['id' => $row->id],
                    (array) $row
                );
            }
        }
        $this->info('✅ Sync completed.');
    }
}
