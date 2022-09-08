<?php

declare(strict_types=1);

use DragonCode\LaravelHttpLogger\Concerns\HasTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    use HasTable;

    public function up() : void
    {
        $this->connection()->table($this->getLogsTableName(), static function(Blueprint $table) {
            $table->unsignedBigInteger('user_id')
                ->nullable()
                ->after('id');
        });
    }

    public function down() : void
    {
        $this->connection()->table($this->getLogsTableName(), static function(Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }

    protected function connection() : Builder
    {
        return Schema::connection($this->getLogsConnectionName());
    }
};
