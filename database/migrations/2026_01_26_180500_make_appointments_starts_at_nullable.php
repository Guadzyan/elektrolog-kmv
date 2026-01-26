<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'sqlite') {
            Schema::disableForeignKeyConstraints();

            DB::statement('ALTER TABLE appointments RENAME TO appointments_old');

            DB::statement(<<<SQL
CREATE TABLE appointments (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    client_id INTEGER NOT NULL,
    starts_at DATETIME NULL,
    duration_minutes INTEGER NOT NULL DEFAULT 60,
    status VARCHAR(32) NOT NULL DEFAULT 'pending',
    source VARCHAR(32) NOT NULL DEFAULT 'web',
    needle_type VARCHAR(16) NULL,
    note TEXT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    CONSTRAINT appointments_client_id_foreign FOREIGN KEY (client_id) REFERENCES clients (id) ON DELETE CASCADE
)
SQL);

            DB::statement("CREATE INDEX appointments_client_id_index ON appointments (client_id)");
            DB::statement("CREATE INDEX appointments_starts_at_index ON appointments (starts_at)");
            DB::statement("CREATE INDEX appointments_status_index ON appointments (status)");
            DB::statement("CREATE INDEX appointments_source_index ON appointments (source)");
            DB::statement("CREATE INDEX appointments_starts_at_status_index ON appointments (starts_at, status)");

            DB::statement(<<<SQL
INSERT INTO appointments (id, client_id, starts_at, duration_minutes, status, source, needle_type, note, created_at, updated_at)
SELECT id, client_id, starts_at, duration_minutes, status, source, needle_type, note, created_at, updated_at
FROM appointments_old
SQL);

            DB::statement('DROP TABLE appointments_old');

            Schema::enableForeignKeyConstraints();

            return;
        }

        DB::statement('ALTER TABLE appointments MODIFY starts_at DATETIME NULL');
    }

    public function down(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'sqlite') {
            Schema::disableForeignKeyConstraints();

            DB::statement('ALTER TABLE appointments RENAME TO appointments_old');

            DB::statement(<<<SQL
CREATE TABLE appointments (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    client_id INTEGER NOT NULL,
    starts_at DATETIME NOT NULL,
    duration_minutes INTEGER NOT NULL DEFAULT 60,
    status VARCHAR(32) NOT NULL DEFAULT 'pending',
    source VARCHAR(32) NOT NULL DEFAULT 'web',
    needle_type VARCHAR(16) NULL,
    note TEXT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    CONSTRAINT appointments_client_id_foreign FOREIGN KEY (client_id) REFERENCES clients (id) ON DELETE CASCADE
)
SQL);

            DB::statement("CREATE INDEX appointments_client_id_index ON appointments (client_id)");
            DB::statement("CREATE INDEX appointments_starts_at_index ON appointments (starts_at)");
            DB::statement("CREATE INDEX appointments_status_index ON appointments (status)");
            DB::statement("CREATE INDEX appointments_source_index ON appointments (source)");
            DB::statement("CREATE INDEX appointments_starts_at_status_index ON appointments (starts_at, status)");

            // If some rows have NULL starts_at, set them to current timestamp to satisfy NOT NULL
            DB::statement(<<<SQL
INSERT INTO appointments (id, client_id, starts_at, duration_minutes, status, source, needle_type, note, created_at, updated_at)
SELECT id, client_id, COALESCE(starts_at, CURRENT_TIMESTAMP), duration_minutes, status, source, needle_type, note, created_at, updated_at
FROM appointments_old
SQL);

            DB::statement('DROP TABLE appointments_old');

            Schema::enableForeignKeyConstraints();

            return;
        }

        DB::statement('ALTER TABLE appointments MODIFY starts_at DATETIME NOT NULL');
    }
};
