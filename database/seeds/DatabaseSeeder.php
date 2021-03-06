<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(OutletTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SupplierTableSeeder::class);
        $this->call(MedsTypeTableSeeder::class);
        $this->call(MedsCategoryTableSeeder::class);
        $this->call(DoctorTableSeeder::class);
        $this->call(MedicineTableSeeder::class);
        $this->call(ProcurementTableSeeder::class);
        $this->call(ProcurementMedicineTableSeeder::class);
        $this->call(CustomerTableSeeder::class);
        $this->call(TransactionTableSeeder::class);
        $this->call(TransactionMedicineTableSeeder::class);

    }
}
