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
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(ParishesTableSeeder::class);
        $this->call(CitizenshipsTableSeeder::class);
        $this->call(TaxpayerTypesTableSeeder::class);
        $this->call(BankAccountTypesTableSeeder::class);
        $this->call(OwnershipStatesTableSeeder::class);
        $this->call(PaymentStatesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(PaymentTypesTableSeeder::class);
        $this->call(MunicipalitiesTableSeeder::class);
        $this->call(EconomicSectorsTableSeeder::class);
        $this->call(ChargingMethodsTableSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(OrdinancesTableSeeder::class);
        $this->call(CorrelativeTypesTableSeeder::class);
        $this->call(ApplicationStatesTableSeeder::class);
        $this->call(FineStatesTableSeeder::class);
        $this->call(RepresentationTypesTableSeeder::class);
        $this->call(CommunitiesTableSeeder::class);
        $this->call(CommunityParishTableSeeder::class);
        $this->call(ActivityClassificationsTableSeeder::class);
        $this->call(ListsTableSeeder::class);
        $this->call(EconomicActivitiesTableSeeder::class);
        $this->call(PaymentMethodsTableSeeder::class);
    }
}
