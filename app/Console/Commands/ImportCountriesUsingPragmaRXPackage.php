<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PragmaRX\Countries\Package\Countries as CountriesPackage;
use Illuminate\Support\Facades\DB;

class ImportCountriesUsingPragmaRXPackage extends Command
{
    protected $signature = 'import:countries-pragmarx';

    protected $description = 'Import countries and states using PragmaRX Countries package';

    public function handle()
    {
        $countries = CountriesPackage::all();
        foreach ($countries as $country) {
            // Insert or update country data
            $isCountryInserted = DB::table('countries')->updateOrInsert([
                'name' => $country->name->common,
            ]);
        
            // Retrieve the country ID
            $countryId = DB::table('countries')
                ->where('name', $country->name->common)
                ->value('id');
        
            // Check if the updateOrInsert was successful
            if ($isCountryInserted && $countryId) {
                // Retrieve states for the country
                $states = $country->hydrateStates()->states;
        
                foreach ($states as $state) {
                    // Check if the state and its name are not null
                    if ($state && isset($state['name'])) {
                        // Insert or update state data
                        DB::table('states')->updateOrInsert([
                            'country_id' => $countryId,
                            'name' => $state['name'],
                        ]);
                    }
                }
            }
        }
        

        $this->info('Countries and states imported successfully.');
    }
}
