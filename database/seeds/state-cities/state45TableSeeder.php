<?php

use Illuminate\Database\Seeder;

class state45TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create Cities for the state of UT - Utah.
        //If the table 'cities' exists, insert the data to the table.
        if (DB::table('cities')->get()->count() >= 0) {
            DB::table('cities')->insert([
                ['name' => 'Beaver', 'state_id' => 3973],
                ['name' => 'Greenville', 'state_id' => 3973],
                ['name' => 'Milford', 'state_id' => 3973],
                ['name' => 'Minersville', 'state_id' => 3973],
                ['name' => 'Bear River City', 'state_id' => 3973],
                ['name' => 'Brigham City', 'state_id' => 3973],
                ['name' => 'Collinston', 'state_id' => 3973],
                ['name' => 'Corinne', 'state_id' => 3973],
                ['name' => 'Deweyville', 'state_id' => 3973],
                ['name' => 'Fielding', 'state_id' => 3973],
                ['name' => 'Garland', 'state_id' => 3973],
                ['name' => 'Grouse Creek', 'state_id' => 3973],
                ['name' => 'Honeyville', 'state_id' => 3973],
                ['name' => 'Howell', 'state_id' => 3973],
                ['name' => 'Mantua', 'state_id' => 3973],
                ['name' => 'Park Valley', 'state_id' => 3973],
                ['name' => 'Plymouth', 'state_id' => 3973],
                ['name' => 'Portage', 'state_id' => 3973],
                ['name' => 'Riverside', 'state_id' => 3973],
                ['name' => 'Snowville', 'state_id' => 3973],
                ['name' => 'Tremonton', 'state_id' => 3973],
                ['name' => 'Willard', 'state_id' => 3973],
                ['name' => 'Cache Junction', 'state_id' => 3973],
                ['name' => 'Clarkston', 'state_id' => 3973],
                ['name' => 'Cornish', 'state_id' => 3973],
                ['name' => 'Hyde Park', 'state_id' => 3973],
                ['name' => 'Hyrum', 'state_id' => 3973],
                ['name' => 'Lewiston', 'state_id' => 3973],
                ['name' => 'Logan', 'state_id' => 3973],
                ['name' => 'Mendon', 'state_id' => 3973],
                ['name' => 'Millville', 'state_id' => 3973],
                ['name' => 'Newton', 'state_id' => 3973],
                ['name' => 'Paradise', 'state_id' => 3973],
                ['name' => 'Providence', 'state_id' => 3973],
                ['name' => 'Richmond', 'state_id' => 3973],
                ['name' => 'Smithfield', 'state_id' => 3973],
                ['name' => 'Trenton', 'state_id' => 3973],
                ['name' => 'Wellsville', 'state_id' => 3973],
                ['name' => 'Price', 'state_id' => 3973],
                ['name' => 'East Carbon', 'state_id' => 3973],
                ['name' => 'Helper', 'state_id' => 3973],
                ['name' => 'Kenilworth', 'state_id' => 3973],
                ['name' => 'Sunnyside', 'state_id' => 3973],
                ['name' => 'Wellington', 'state_id' => 3973],
                ['name' => 'Dutch John', 'state_id' => 3973],
                ['name' => 'Manila', 'state_id' => 3973],
                ['name' => 'Bountiful', 'state_id' => 3973],
                ['name' => 'Centerville', 'state_id' => 3973],
                ['name' => 'Clearfield', 'state_id' => 3973],
                ['name' => 'Farmington', 'state_id' => 3973],
                ['name' => 'Kaysville', 'state_id' => 3973],
                ['name' => 'Layton', 'state_id' => 3973],
                ['name' => 'North Salt Lake', 'state_id' => 3973],
                ['name' => 'Hill Afb', 'state_id' => 3973],
                ['name' => 'Syracuse', 'state_id' => 3973],
                ['name' => 'Woods Cross', 'state_id' => 3973],
                ['name' => 'Altamont', 'state_id' => 3973],
                ['name' => 'Altonah', 'state_id' => 3973],
                ['name' => 'Bluebell', 'state_id' => 3973],
                ['name' => 'Duchesne', 'state_id' => 3973],
                ['name' => 'Fruitland', 'state_id' => 3973],
                ['name' => 'Hanna', 'state_id' => 3973],
                ['name' => 'Mountain Home', 'state_id' => 3973],
                ['name' => 'Myton', 'state_id' => 3973],
                ['name' => 'Neola', 'state_id' => 3973],
                ['name' => 'Roosevelt', 'state_id' => 3973],
                ['name' => 'Tabiona', 'state_id' => 3973],
                ['name' => 'Talmage', 'state_id' => 3973],
                ['name' => 'Castle Dale', 'state_id' => 3973],
                ['name' => 'Clawson', 'state_id' => 3973],
                ['name' => 'Cleveland', 'state_id' => 3973],
                ['name' => 'Elmo', 'state_id' => 3973],
                ['name' => 'Emery', 'state_id' => 3973],
                ['name' => 'Ferron', 'state_id' => 3973],
                ['name' => 'Green River', 'state_id' => 3973],
                ['name' => 'Huntington', 'state_id' => 3973],
                ['name' => 'Orangeville', 'state_id' => 3973],
                ['name' => 'Antimony', 'state_id' => 3973],
                ['name' => 'Boulder', 'state_id' => 3973],
                ['name' => 'Cannonville', 'state_id' => 3973],
                ['name' => 'Escalante', 'state_id' => 3973],
                ['name' => 'Hatch', 'state_id' => 3973],
                ['name' => 'Henrieville', 'state_id' => 3973],
                ['name' => 'Panguitch', 'state_id' => 3973],
                ['name' => 'Bryce', 'state_id' => 3973],
                ['name' => 'Tropic', 'state_id' => 3973],
                ['name' => 'Cisco', 'state_id' => 3973],
                ['name' => 'Moab', 'state_id' => 3973],
                ['name' => 'Thompson', 'state_id' => 3973],
                ['name' => 'Beryl', 'state_id' => 3973],
                ['name' => 'Brian Head', 'state_id' => 3973],
                ['name' => 'Cedar City', 'state_id' => 3973],
                ['name' => 'Kanarraville', 'state_id' => 3973],
                ['name' => 'Modena', 'state_id' => 3973],
                ['name' => 'Newcastle', 'state_id' => 3973],
                ['name' => 'Paragonah', 'state_id' => 3973],
                ['name' => 'Parowan', 'state_id' => 3973],
                ['name' => 'Summit', 'state_id' => 3973],
                ['name' => 'Eureka', 'state_id' => 3973],
                ['name' => 'Levan', 'state_id' => 3973],
                ['name' => 'Mona', 'state_id' => 3973],
                ['name' => 'Nephi', 'state_id' => 3973],
                ['name' => 'Alton', 'state_id' => 3973],
                ['name' => 'Glendale', 'state_id' => 3973],
                ['name' => 'Kanab', 'state_id' => 3973],
                ['name' => 'Mount Carmel', 'state_id' => 3973],
                ['name' => 'Orderville', 'state_id' => 3973],
                ['name' => 'Duck Creek Village', 'state_id' => 3973],
                ['name' => 'Delta', 'state_id' => 3973],
                ['name' => 'Fillmore', 'state_id' => 3973],
                ['name' => 'Hinckley', 'state_id' => 3973],
                ['name' => 'Holden', 'state_id' => 3973],
                ['name' => 'Kanosh', 'state_id' => 3973],
                ['name' => 'Leamington', 'state_id' => 3973],
                ['name' => 'Lynndyl', 'state_id' => 3973],
                ['name' => 'Meadow', 'state_id' => 3973],
                ['name' => 'Oak City', 'state_id' => 3973],
                ['name' => 'Scipio', 'state_id' => 3973],
                ['name' => 'Garrison', 'state_id' => 3973],
                ['name' => 'Croydon', 'state_id' => 3973],
                ['name' => 'Morgan', 'state_id' => 3973],
                ['name' => 'Circleville', 'state_id' => 3973],
                ['name' => 'Greenwich', 'state_id' => 3973],
                ['name' => 'Junction', 'state_id' => 3973],
                ['name' => 'Kingston', 'state_id' => 3973],
                ['name' => 'Marysvale', 'state_id' => 3973],
                ['name' => 'Garden City', 'state_id' => 3973],
                ['name' => 'Laketown', 'state_id' => 3973],
                ['name' => 'Randolph', 'state_id' => 3973],
                ['name' => 'Woodruff', 'state_id' => 3973],
                ['name' => 'Bingham Canyon', 'state_id' => 3973],
                ['name' => 'South Jordan', 'state_id' => 3973],
                ['name' => 'Draper', 'state_id' => 3973],
                ['name' => 'Magna', 'state_id' => 3973],
                ['name' => 'Midvale', 'state_id' => 3973],
                ['name' => 'Riverton', 'state_id' => 3973],
                ['name' => 'Sandy', 'state_id' => 3973],
                ['name' => 'West Jordan', 'state_id' => 3973],
                ['name' => 'Herriman', 'state_id' => 3973],
                ['name' => 'Salt Lake City', 'state_id' => 3973],
                ['name' => 'West Valley City', 'state_id' => 3973],
                ['name' => 'Aneth', 'state_id' => 3973],
                ['name' => 'Blanding', 'state_id' => 3973],
                ['name' => 'Bluff', 'state_id' => 3973],
                ['name' => 'La Sal', 'state_id' => 3973],
                ['name' => 'Mexican Hat', 'state_id' => 3973],
                ['name' => 'Lake Powell', 'state_id' => 3973],
                ['name' => 'Montezuma Creek', 'state_id' => 3973],
                ['name' => 'Monticello', 'state_id' => 3973],
                ['name' => 'Monument Valley', 'state_id' => 3973],
                ['name' => 'Axtell', 'state_id' => 3973],
                ['name' => 'Centerfield', 'state_id' => 3973],
                ['name' => 'Chester', 'state_id' => 3973],
                ['name' => 'Ephraim', 'state_id' => 3973],
                ['name' => 'Fairview', 'state_id' => 3973],
                ['name' => 'Fayette', 'state_id' => 3973],
                ['name' => 'Fountain Green', 'state_id' => 3973],
                ['name' => 'Gunnison', 'state_id' => 3973],
                ['name' => 'Manti', 'state_id' => 3973],
                ['name' => 'Mayfield', 'state_id' => 3973],
                ['name' => 'Moroni', 'state_id' => 3973],
                ['name' => 'Mount Pleasant', 'state_id' => 3973],
                ['name' => 'Spring City', 'state_id' => 3973],
                ['name' => 'Sterling', 'state_id' => 3973],
                ['name' => 'Wales', 'state_id' => 3973],
                ['name' => 'Aurora', 'state_id' => 3973],
                ['name' => 'Redmond', 'state_id' => 3973],
                ['name' => 'Salina', 'state_id' => 3973],
                ['name' => 'Sigurd', 'state_id' => 3973],
                ['name' => 'Richfield', 'state_id' => 3973],
                ['name' => 'Annabella', 'state_id' => 3973],
                ['name' => 'Elsinore', 'state_id' => 3973],
                ['name' => 'Glenwood', 'state_id' => 3973],
                ['name' => 'Joseph', 'state_id' => 3973],
                ['name' => 'Koosharem', 'state_id' => 3973],
                ['name' => 'Monroe', 'state_id' => 3973],
                ['name' => 'Sevier', 'state_id' => 3973],
                ['name' => 'Coalville', 'state_id' => 3973],
                ['name' => 'Echo', 'state_id' => 3973],
                ['name' => 'Henefer', 'state_id' => 3973],
                ['name' => 'Kamas', 'state_id' => 3973],
                ['name' => 'Oakley', 'state_id' => 3973],
                ['name' => 'Park City', 'state_id' => 3973],
                ['name' => 'Peoa', 'state_id' => 3973],
                ['name' => 'Dugway', 'state_id' => 3973],
                ['name' => 'Grantsville', 'state_id' => 3973],
                ['name' => 'Ibapah', 'state_id' => 3973],
                ['name' => 'Rush Valley', 'state_id' => 3973],
                ['name' => 'Stockton', 'state_id' => 3973],
                ['name' => 'Tooele', 'state_id' => 3973],
                ['name' => 'Vernon', 'state_id' => 3973],
                ['name' => 'Wendover', 'state_id' => 3973],
                ['name' => 'Bonanza', 'state_id' => 3973],
                ['name' => 'Fort Duchesne', 'state_id' => 3973],
                ['name' => 'Jensen', 'state_id' => 3973],
                ['name' => 'Lapoint', 'state_id' => 3973],
                ['name' => 'Randlett', 'state_id' => 3973],
                ['name' => 'Tridell', 'state_id' => 3973],
                ['name' => 'Vernal', 'state_id' => 3973],
                ['name' => 'Whiterocks', 'state_id' => 3973],
                ['name' => 'American Fork', 'state_id' => 3973],
                ['name' => 'Alpine', 'state_id' => 3973],
                ['name' => 'Eagle Mountain', 'state_id' => 3973],
                ['name' => 'Cedar Valley', 'state_id' => 3973],
                ['name' => 'Lindon', 'state_id' => 3973],
                ['name' => 'Lehi', 'state_id' => 3973],
                ['name' => 'Saratoga Springs', 'state_id' => 3973],
                ['name' => 'Orem', 'state_id' => 3973],
                ['name' => 'Pleasant Grove', 'state_id' => 3973],
                ['name' => 'Provo', 'state_id' => 3973],
                ['name' => 'Elberta', 'state_id' => 3973],
                ['name' => 'Goshen', 'state_id' => 3973],
                ['name' => 'Payson', 'state_id' => 3973],
                ['name' => 'Salem', 'state_id' => 3973],
                ['name' => 'Santaquin', 'state_id' => 3973],
                ['name' => 'Spanish Fork', 'state_id' => 3973],
                ['name' => 'Springville', 'state_id' => 3973],
                ['name' => 'Mapleton', 'state_id' => 3973],
                ['name' => 'Heber City', 'state_id' => 3973],
                ['name' => 'Midway', 'state_id' => 3973],
                ['name' => 'Wallsburg', 'state_id' => 3973],
                ['name' => 'Central', 'state_id' => 3973],
                ['name' => 'Enterprise', 'state_id' => 3973],
                ['name' => 'Gunlock', 'state_id' => 3973],
                ['name' => 'Hurricane', 'state_id' => 3973],
                ['name' => 'Ivins', 'state_id' => 3973],
                ['name' => 'La Verkin', 'state_id' => 3973],
                ['name' => 'Leeds', 'state_id' => 3973],
                ['name' => 'New Harmony', 'state_id' => 3973],
                ['name' => 'Rockville', 'state_id' => 3973],
                ['name' => 'Santa Clara', 'state_id' => 3973],
                ['name' => 'Springdale', 'state_id' => 3973],
                ['name' => 'Saint George', 'state_id' => 3973],
                ['name' => 'Toquerville', 'state_id' => 3973],
                ['name' => 'Virgin', 'state_id' => 3973],
                ['name' => 'Washington', 'state_id' => 3973],
                ['name' => 'Pine Valley', 'state_id' => 3973],
                ['name' => 'Veyo', 'state_id' => 3973],
                ['name' => 'Dammeron Valley', 'state_id' => 3973],
                ['name' => 'Hildale', 'state_id' => 3973],
                ['name' => 'Bicknell', 'state_id' => 3973],
                ['name' => 'Hanksville', 'state_id' => 3973],
                ['name' => 'Loa', 'state_id' => 3973],
                ['name' => 'Lyman', 'state_id' => 3973],
                ['name' => 'Teasdale', 'state_id' => 3973],
                ['name' => 'Torrey', 'state_id' => 3973],
                ['name' => 'Roy', 'state_id' => 3973],
                ['name' => 'Ogden', 'state_id' => 3973],
                ['name' => 'Eden', 'state_id' => 3973],
                ['name' => 'Hooper', 'state_id' => 3973],
                ['name' => 'Huntsville', 'state_id' => 3973]
            ]);
        }
    }
}
