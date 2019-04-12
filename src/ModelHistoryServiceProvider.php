<?php
/**
 * Created by PhpStorm.
 * User: aigletter
 * Date: 12.04.19
 * Time: 3:11
 */

namespace Aigletter\ModelHistory;


use Illuminate\Support\ServiceProvider;

class ModelHistoryServiceProvider extends ServiceProvider
{
    public function register() {

        $this->mergeConfigFrom(__DIR__ . '/../config/model-history.php', 'model-history');

        if ( ! class_exists('CreateModelHistoryTable')) {
            // Publish the migration
            $timestamp = date('Y_m_d_His', time());

            $this->publishes([
                __DIR__ . '/../database/migrations/0000_00_00_000000_create_model_history_table.php'
                        => database_path('migrations/' . $timestamp . '_create_model_history_table.php'),
            ], 'migrations');
        }
    }
}