<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class ImportCountries extends Command
{
    protected $signature = 'import:countries';
    protected $description = 'Import countries from Rest Countries API';

    // app/Console/Commands/ImportCountries.php

// ... (existing code)

public function handle()
{
    $client = new Client();
    $response = $client->get('https://restcountries.com/v3.1/all');

    if ($response->getStatusCode() == 200) {
        $data = json_decode($response->getBody(), true);
        $i = 1;
        foreach ($data as $item) {
            $countryName = $item['name']['common'];
            $countryId = $i++;

            $country = DB::table('countries')->updateOrInsert(
                
                ['name' => $countryName]
            );
            // dd($item);
            if (isset($item['subregion'])  && is_array($item['subregion'])) {
                dd( is_array($item['subregion']));
                foreach ($item['subregion'] as $state) {
                    $stateData = DB::table('states')->updateOrInsert([
                        'country_id' => $countryId,
                        'name' => $state,
                    ]);

                   
                }
            }
        }

        $this->info('Countries, states, and cities imported successfully.');
    } else {
        $this->error('Failed to retrieve data from the API.');
    }
}

// ... (existing code)

}
