<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            DB::unprepared('
                CREATE TRIGGER product_after_insert AFTER INSERT ON products
                BEGIN
                    UPDATE category_products SET total = total + 1 WHERE id = NEW.category_product_id;
                END');

            DB::unprepared('
                CREATE TRIGGER product_after_delete AFTER DELETE ON products
                BEGIN
                    UPDATE category_products SET total = total - 1 WHERE id = OLD.category_product_id;
                END');

            DB::unprepared('
                CREATE TRIGGER product_after_update AFTER UPDATE ON products
                BEGIN
                    UPDATE category_products SET total = total - 1
                    WHERE id = OLD.category_product_id
                      AND OLD.category_product_id <> NEW.category_product_id;
                    UPDATE category_products SET total = total + 1
                    WHERE id = NEW.category_product_id
                      AND OLD.category_product_id <> NEW.category_product_id;
                END');

            return;
        }

        DB::unprepared('
            CREATE TRIGGER product_after_insert AFTER INSERT ON products
            FOR EACH ROW
            UPDATE category_products SET total = total + 1 WHERE id = NEW.category_product_id');

        DB::unprepared('
            CREATE TRIGGER product_after_delete AFTER DELETE ON products
            FOR EACH ROW
            UPDATE category_products SET total = total - 1 WHERE id = OLD.category_product_id');

        DB::unprepared('
            CREATE TRIGGER product_after_update AFTER UPDATE ON products
            FOR EACH ROW
            BEGIN
                IF OLD.category_product_id <> NEW.category_product_id THEN
                    UPDATE category_products SET total = total - 1 WHERE id = OLD.category_product_id;
                    UPDATE category_products SET total = total + 1 WHERE id = NEW.category_product_id;
                END IF;
            END');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS product_after_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS product_after_delete');
        DB::unprepared('DROP TRIGGER IF EXISTS product_after_update');
    }
};
