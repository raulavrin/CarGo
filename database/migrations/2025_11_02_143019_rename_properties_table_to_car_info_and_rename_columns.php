<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $driver = DB::getDriverName();
        
        // First, rename the table
        Schema::rename('properties', 'car_info');
        
        // Rename columns - use database-specific SQL for better compatibility
        if ($driver === 'mysql' || $driver === 'mariadb') {
            // MySQL/MariaDB syntax
            DB::statement('ALTER TABLE car_info CHANGE property_type car_type VARCHAR(255)');
            DB::statement('ALTER TABLE car_info CHANGE space seats VARCHAR(255)');
            DB::statement('ALTER TABLE car_info CHANGE bed doors VARCHAR(255)');
            DB::statement('ALTER TABLE car_info CHANGE bath milage VARCHAR(255)');
        } elseif ($driver === 'pgsql') {
            // PostgreSQL syntax
            DB::statement('ALTER TABLE car_info RENAME COLUMN property_type TO car_type');
            DB::statement('ALTER TABLE car_info RENAME COLUMN space TO seats');
            DB::statement('ALTER TABLE car_info RENAME COLUMN bed TO doors');
            DB::statement('ALTER TABLE car_info RENAME COLUMN bath TO milage');
        } else {
            // For SQLite and others, use Schema methods (requires doctrine/dbal for SQLite)
            Schema::table('car_info', function (Blueprint $table) {
                $table->renameColumn('property_type', 'car_type');
                $table->renameColumn('space', 'seats');
                $table->renameColumn('bed', 'doors');
                $table->renameColumn('bath', 'milage');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = DB::getDriverName();
        
        // Reverse the column renames first
        if ($driver === 'mysql' || $driver === 'mariadb') {
            // MySQL/MariaDB syntax
            DB::statement('ALTER TABLE car_info CHANGE car_type property_type VARCHAR(255)');
            DB::statement('ALTER TABLE car_info CHANGE seats space VARCHAR(255)');
            DB::statement('ALTER TABLE car_info CHANGE doors bed VARCHAR(255)');
            DB::statement('ALTER TABLE car_info CHANGE milage bath VARCHAR(255)');
        } elseif ($driver === 'pgsql') {
            // PostgreSQL syntax
            DB::statement('ALTER TABLE car_info RENAME COLUMN car_type TO property_type');
            DB::statement('ALTER TABLE car_info RENAME COLUMN seats TO space');
            DB::statement('ALTER TABLE car_info RENAME COLUMN doors TO bed');
            DB::statement('ALTER TABLE car_info RENAME COLUMN milage TO bath');
        } else {
            // For SQLite and others, use Schema methods
            Schema::table('car_info', function (Blueprint $table) {
                $table->renameColumn('car_type', 'property_type');
                $table->renameColumn('seats', 'space');
                $table->renameColumn('doors', 'bed');
                $table->renameColumn('milage', 'bath');
            });
        }
        
        // Then rename the table back
        Schema::rename('car_info', 'properties');
    }
};
