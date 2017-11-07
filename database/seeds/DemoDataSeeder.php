<?php

use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    public function run()
    {
        $this->truncateAllTables();

        // Create product (in our example it's car)
        factory(App\Models\Product::class, 20)->create()->each(
            function ($product) {
                // Create images for product
                factory(App\Models\ProductImage::class, 4)->create(["product_id" => $product->id]);

                // Create trip where we use created product
                $trip = factory(App\Models\Trip::class)->create(["product_id" => $product->id]);

                // Create order with created trip
                factory(App\Models\Order::class)->create(["trip_id" => $trip->id]);
            }
        );
    }

    protected function truncateAllTables($excepts = ['migrations'])
    {
        $tables = DB::connection()
            ->getPdo()
            ->query("SHOW FULL TABLES")
            ->fetchAll();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach ($tables as $table) {
            $tableName = $table[0];

            if (in_array($tableName, $excepts))
                continue;

            DB::table($tableName)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}