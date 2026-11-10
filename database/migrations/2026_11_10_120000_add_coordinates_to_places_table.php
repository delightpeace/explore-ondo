<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('places', 'lat')) {
            Schema::table('places', function (Blueprint $table): void {
                $table->decimal('lat', 10, 7)->nullable();
            });
        }

        if (! Schema::hasColumn('places', 'lng')) {
            Schema::table('places', function (Blueprint $table): void {
                $table->decimal('lng', 10, 7)->nullable();
            });
        }
    }

    public function down(): void
    {
        $columns = [];

        if (Schema::hasColumn('places', 'lat')) {
            $columns[] = 'lat';
        }

        if (Schema::hasColumn('places', 'lng')) {
            $columns[] = 'lng';
        }

        if ($columns !== []) {
            Schema::table('places', function (Blueprint $table) use ($columns): void {
                $table->dropColumn($columns);
            });
        }
    }
};
