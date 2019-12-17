<?php


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            PermissionsTableSeeder::class,
            ModulesTableSeeder::class,
            FormsTableSeeder::class,
            RolePermissionFormTableSeeder::class,

            //BrandTableSeeder::class,
            CategoryTableSeeder::class,
            SubcategoryTableSeeder::class,
            CurrencyTableSeeder::class,
            ProductTableSeeder::class,
            PriceTableSeeder::class,

            ModuleTableSeeder::class
        ]);

    }
}
