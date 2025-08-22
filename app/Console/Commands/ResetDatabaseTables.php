<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetDatabaseTables extends Command
{
    protected $signature = 'db:reset-tables';
    protected $description = 'Truncate all tables and reset auto-increment IDs';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // List of tables in the order that respects foreign key constraints
        $tables = [
            'staff_products', // Child table with foreign keys to bookings, staff, services, products
            'invoices',       // Child table with foreign keys to bookings, customers, services, staff
            'bookings',       // Child table with foreign keys to customers, services, staff
            'services',       // Child table with foreign key to staff
            'customers',      // Parent table
            'staff',          // Parent table
            'products',       // Parent table
            'messages',       // No foreign keys
            'shops',          // No foreign keys
        ];

        // Disable foreign key checks to avoid constraint violations
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate each table
        foreach ($tables as $table) {
            DB::table($table)->truncate();
            $this->info("Truncated table: {$table}");
        }

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->info('All tables have been reset successfully.');
    }
}
