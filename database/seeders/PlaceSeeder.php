<?php

namespace Database\Seeders;

use App\Models\Place;

use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Place::create([
            'name' => 'Nibanola Resort',
            'description' => 'A large leisure resort on the edge of the city. Visitors mention swimming, boat rides, horse riding, motorbike rides, a restaurant, a lounge and a poolside area. It’s family-friendly and quiet. There is a gate fee and most activities are paid separately.
             Reviews of the food and prices are mixed.',
            'address' => 'Ore-Ondo Road, Igbado, Ondo State'


        ]);

        Place::create([
            'name' => 'Osemawe Palace',
            'description' => 'The palace of the Osemawe of Ondo, the traditional ruler of the Ondo Kingdom. It sits in the old part of town, close to the central markets. It’s a cultural landmark and a working royal seat, so treat it as a place to see from outside unless you’ve arranged a visit. I found no opening hours or visitor information for it,
             so ask locally or write ahead if you want to go in.',
            'address' => 'Osemawe Palace, Ondo (central Ondo City)'


        ]);


        Place::create([
            'name' => 'Mukeke Mall',
            'description' => 'A modern one-stop shopping mall. Reviewers mention groceries, frozen foods, a bakery, electronics, fabrics, a pharmacy and a home-furnishing section. They describe it as organised and cleaner than the open markets,
            with fairly priced products and well-behaved staff.',
            'address' => 'Opposite NCI, Lisaluwa, Ondo'


        ]);

        Place::create([
            'name' => 'Ondo Central Market (Ughele)',
            'description' => 'The largest market in Ondo City, rated 4.1 stars. It mixes lock-up shops, open stalls and hawkers, selling foodstuffs, soup ingredients, drinks, clothing, jewellery, kitchen items and even used goods. Prices are described as fair, and wheelbarrow men will carry your goods for a fee.
            Hold your belongings carefully, as in any big market.',
            'address' => 'Ondo-Akure Road, Ondo'


        ]);


        Place::create([
            'name' => 'Iyalaje Market',
            'description' => 'TAnother large market on the same road, with up to four entrances. It sells most household and food items. Reviewers call it rough and unstructured,
            and warn that motorists drive inside it.',
            'address' => 'Ondo-Akure Road, Ondo'


        ]);
    }
}
