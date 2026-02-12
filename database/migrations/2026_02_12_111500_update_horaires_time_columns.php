<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE horaires ALTER COLUMN "heureOuverture" TYPE time USING "heureOuverture"::time');
        DB::statement('ALTER TABLE horaires ALTER COLUMN "heureFermeture" TYPE time USING "heureFermeture"::time');
        DB::statement('ALTER TABLE horaires ALTER COLUMN "heureOuverture" DROP NOT NULL');
        DB::statement('ALTER TABLE horaires ALTER COLUMN "heureFermeture" DROP NOT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE horaires ALTER COLUMN "heureOuverture" TYPE timestamp USING (date_trunc("day", now()) + "heureOuverture")');
        DB::statement('ALTER TABLE horaires ALTER COLUMN "heureFermeture" TYPE timestamp USING (date_trunc("day", now()) + "heureFermeture")');
        DB::statement('ALTER TABLE horaires ALTER COLUMN "heureOuverture" SET NOT NULL');
        DB::statement('ALTER TABLE horaires ALTER COLUMN "heureFermeture" SET NOT NULL');
    }
};
