<?php

use Illuminate\Database\Seeder;

class state17TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create Cities for the state of KS - Kansas.
        //If the table 'cities' exists, insert the data to the table.
        if (DB::table('cities')->get()->count() >= 0) {
            DB::table('cities')->insert([
                ['name' => 'Elsmore', 'state_id' => 3938],
                ['name' => 'Gas', 'state_id' => 3938],
                ['name' => 'Humboldt', 'state_id' => 3938],
                ['name' => 'Iola', 'state_id' => 3938],
                ['name' => 'La Harpe', 'state_id' => 3938],
                ['name' => 'Moran', 'state_id' => 3938],
                ['name' => 'Savonburg', 'state_id' => 3938],
                ['name' => 'Colony', 'state_id' => 3938],
                ['name' => 'Garnett', 'state_id' => 3938],
                ['name' => 'Greeley', 'state_id' => 3938],
                ['name' => 'Kincaid', 'state_id' => 3938],
                ['name' => 'Welda', 'state_id' => 3938],
                ['name' => 'Westphalia', 'state_id' => 3938],
                ['name' => 'Atchison', 'state_id' => 3938],
                ['name' => 'Cummings', 'state_id' => 3938],
                ['name' => 'Effingham', 'state_id' => 3938],
                ['name' => 'Lancaster', 'state_id' => 3938],
                ['name' => 'Muscotah', 'state_id' => 3938],
                ['name' => 'Hardtner', 'state_id' => 3938],
                ['name' => 'Hazelton', 'state_id' => 3938],
                ['name' => 'Isabel', 'state_id' => 3938],
                ['name' => 'Kiowa', 'state_id' => 3938],
                ['name' => 'Lake City', 'state_id' => 3938],
                ['name' => 'Medicine Lodge', 'state_id' => 3938],
                ['name' => 'Sharon', 'state_id' => 3938],
                ['name' => 'Sun City', 'state_id' => 3938],
                ['name' => 'Albert', 'state_id' => 3938],
                ['name' => 'Claflin', 'state_id' => 3938],
                ['name' => 'Ellinwood', 'state_id' => 3938],
                ['name' => 'Great Bend', 'state_id' => 3938],
                ['name' => 'Hoisington', 'state_id' => 3938],
                ['name' => 'Olmitz', 'state_id' => 3938],
                ['name' => 'Pawnee Rock', 'state_id' => 3938],
                ['name' => 'Fort Scott', 'state_id' => 3938],
                ['name' => 'Bronson', 'state_id' => 3938],
                ['name' => 'Fulton', 'state_id' => 3938],
                ['name' => 'Garland', 'state_id' => 3938],
                ['name' => 'Mapleton', 'state_id' => 3938],
                ['name' => 'Redfield', 'state_id' => 3938],
                ['name' => 'Uniontown', 'state_id' => 3938],
                ['name' => 'Everest', 'state_id' => 3938],
                ['name' => 'Fairview', 'state_id' => 3938],
                ['name' => 'Hiawatha', 'state_id' => 3938],
                ['name' => 'Horton', 'state_id' => 3938],
                ['name' => 'Morrill', 'state_id' => 3938],
                ['name' => 'Powhattan', 'state_id' => 3938],
                ['name' => 'Robinson', 'state_id' => 3938],
                ['name' => 'Cassoday', 'state_id' => 3938],
                ['name' => 'Andover', 'state_id' => 3938],
                ['name' => 'Augusta', 'state_id' => 3938],
                ['name' => 'Beaumont', 'state_id' => 3938],
                ['name' => 'Benton', 'state_id' => 3938],
                ['name' => 'Douglass', 'state_id' => 3938],
                ['name' => 'Elbing', 'state_id' => 3938],
                ['name' => 'El Dorado', 'state_id' => 3938],
                ['name' => 'Latham', 'state_id' => 3938],
                ['name' => 'Leon', 'state_id' => 3938],
                ['name' => 'Potwin', 'state_id' => 3938],
                ['name' => 'Rosalia', 'state_id' => 3938],
                ['name' => 'Rose Hill', 'state_id' => 3938],
                ['name' => 'Towanda', 'state_id' => 3938],
                ['name' => 'Whitewater', 'state_id' => 3938],
                ['name' => 'Cedar Point', 'state_id' => 3938],
                ['name' => 'Cottonwood Falls', 'state_id' => 3938],
                ['name' => 'Elmdale', 'state_id' => 3938],
                ['name' => 'Matfield Green', 'state_id' => 3938],
                ['name' => 'Strong City', 'state_id' => 3938],
                ['name' => 'Cedar Vale', 'state_id' => 3938],
                ['name' => 'Chautauqua', 'state_id' => 3938],
                ['name' => 'Niotaze', 'state_id' => 3938],
                ['name' => 'Peru', 'state_id' => 3938],
                ['name' => 'Sedan', 'state_id' => 3938],
                ['name' => 'Baxter Springs', 'state_id' => 3938],
                ['name' => 'Columbus', 'state_id' => 3938],
                ['name' => 'Crestline', 'state_id' => 3938],
                ['name' => 'Galena', 'state_id' => 3938],
                ['name' => 'Riverton', 'state_id' => 3938],
                ['name' => 'Scammon', 'state_id' => 3938],
                ['name' => 'Treece', 'state_id' => 3938],
                ['name' => 'Weir', 'state_id' => 3938],
                ['name' => 'West Mineral', 'state_id' => 3938],
                ['name' => 'Bird City', 'state_id' => 3938],
                ['name' => 'Saint Francis', 'state_id' => 3938],
                ['name' => 'Ashland', 'state_id' => 3938],
                ['name' => 'Englewood', 'state_id' => 3938],
                ['name' => 'Minneola', 'state_id' => 3938],
                ['name' => 'Clay Center', 'state_id' => 3938],
                ['name' => 'Green', 'state_id' => 3938],
                ['name' => 'Longford', 'state_id' => 3938],
                ['name' => 'Morganville', 'state_id' => 3938],
                ['name' => 'Wakefield', 'state_id' => 3938],
                ['name' => 'Concordia', 'state_id' => 3938],
                ['name' => 'Clyde', 'state_id' => 3938],
                ['name' => 'Jamestown', 'state_id' => 3938],
                ['name' => 'Aurora', 'state_id' => 3938],
                ['name' => 'Glasco', 'state_id' => 3938],
                ['name' => 'Miltonvale', 'state_id' => 3938],
                ['name' => 'Burlington', 'state_id' => 3938],
                ['name' => 'Gridley', 'state_id' => 3938],
                ['name' => 'Lebo', 'state_id' => 3938],
                ['name' => 'Le Roy', 'state_id' => 3938],
                ['name' => 'Waverly', 'state_id' => 3938],
                ['name' => 'Coldwater', 'state_id' => 3938],
                ['name' => 'Protection', 'state_id' => 3938],
                ['name' => 'Wilmore', 'state_id' => 3938],
                ['name' => 'Arkansas City', 'state_id' => 3938],
                ['name' => 'Atlanta', 'state_id' => 3938],
                ['name' => 'Burden', 'state_id' => 3938],
                ['name' => 'Cambridge', 'state_id' => 3938],
                ['name' => 'Dexter', 'state_id' => 3938],
                ['name' => 'Maple City', 'state_id' => 3938],
                ['name' => 'Rock', 'state_id' => 3938],
                ['name' => 'Udall', 'state_id' => 3938],
                ['name' => 'Winfield', 'state_id' => 3938],
                ['name' => 'Arcadia', 'state_id' => 3938],
                ['name' => 'Arma', 'state_id' => 3938],
                ['name' => 'Cherokee', 'state_id' => 3938],
                ['name' => 'Farlington', 'state_id' => 3938],
                ['name' => 'Franklin', 'state_id' => 3938],
                ['name' => 'Girard', 'state_id' => 3938],
                ['name' => 'Hepler', 'state_id' => 3938],
                ['name' => 'Mc Cune', 'state_id' => 3938],
                ['name' => 'Mulberry', 'state_id' => 3938],
                ['name' => 'Opolis', 'state_id' => 3938],
                ['name' => 'Pittsburg', 'state_id' => 3938],
                ['name' => 'Frontenac', 'state_id' => 3938],
                ['name' => 'Walnut', 'state_id' => 3938],
                ['name' => 'Dresden', 'state_id' => 3938],
                ['name' => 'Jennings', 'state_id' => 3938],
                ['name' => 'Norcatur', 'state_id' => 3938],
                ['name' => 'Oberlin', 'state_id' => 3938],
                ['name' => 'Abilene', 'state_id' => 3938],
                ['name' => 'Chapman', 'state_id' => 3938],
                ['name' => 'Enterprise', 'state_id' => 3938],
                ['name' => 'Herington', 'state_id' => 3938],
                ['name' => 'Hope', 'state_id' => 3938],
                ['name' => 'Solomon', 'state_id' => 3938],
                ['name' => 'Talmage', 'state_id' => 3938],
                ['name' => 'Woodbine', 'state_id' => 3938],
                ['name' => 'Bendena', 'state_id' => 3938],
                ['name' => 'Denton', 'state_id' => 3938],
                ['name' => 'Elwood', 'state_id' => 3938],
                ['name' => 'Highland', 'state_id' => 3938],
                ['name' => 'Troy', 'state_id' => 3938],
                ['name' => 'Wathena', 'state_id' => 3938],
                ['name' => 'White Cloud', 'state_id' => 3938],
                ['name' => 'Baldwin City', 'state_id' => 3938],
                ['name' => 'Eudora', 'state_id' => 3938],
                ['name' => 'Lawrence', 'state_id' => 3938],
                ['name' => 'Lecompton', 'state_id' => 3938],
                ['name' => 'Belpre', 'state_id' => 3938],
                ['name' => 'Kinsley', 'state_id' => 3938],
                ['name' => 'Lewis', 'state_id' => 3938],
                ['name' => 'Offerle', 'state_id' => 3938],
                ['name' => 'Elk Falls', 'state_id' => 3938],
                ['name' => 'Grenola', 'state_id' => 3938],
                ['name' => 'Howard', 'state_id' => 3938],
                ['name' => 'Longton', 'state_id' => 3938],
                ['name' => 'Moline', 'state_id' => 3938],
                ['name' => 'Hays', 'state_id' => 3938],
                ['name' => 'Catharine', 'state_id' => 3938],
                ['name' => 'Ellis', 'state_id' => 3938],
                ['name' => 'Pfeifer', 'state_id' => 3938],
                ['name' => 'Schoenchen', 'state_id' => 3938],
                ['name' => 'Victoria', 'state_id' => 3938],
                ['name' => 'Walker', 'state_id' => 3938],
                ['name' => 'Ellsworth', 'state_id' => 3938],
                ['name' => 'Holyrood', 'state_id' => 3938],
                ['name' => 'Kanopolis', 'state_id' => 3938],
                ['name' => 'Lorraine', 'state_id' => 3938],
                ['name' => 'Wilson', 'state_id' => 3938],
                ['name' => 'Garden City', 'state_id' => 3938],
                ['name' => 'Holcomb', 'state_id' => 3938],
                ['name' => 'Pierceville', 'state_id' => 3938],
                ['name' => 'Dodge City', 'state_id' => 3938],
                ['name' => 'Bucklin', 'state_id' => 3938],
                ['name' => 'Ford', 'state_id' => 3938],
                ['name' => 'Fort Dodge', 'state_id' => 3938],
                ['name' => 'Spearville', 'state_id' => 3938],
                ['name' => 'Wright', 'state_id' => 3938],
                ['name' => 'Lane', 'state_id' => 3938],
                ['name' => 'Ottawa', 'state_id' => 3938],
                ['name' => 'Pomona', 'state_id' => 3938],
                ['name' => 'Princeton', 'state_id' => 3938],
                ['name' => 'Rantoul', 'state_id' => 3938],
                ['name' => 'Richmond', 'state_id' => 3938],
                ['name' => 'Wellsville', 'state_id' => 3938],
                ['name' => 'Williamsburg', 'state_id' => 3938],
                ['name' => 'Junction City', 'state_id' => 3938],
                ['name' => 'Fort Riley', 'state_id' => 3938],
                ['name' => 'Milford', 'state_id' => 3938],
                ['name' => 'Gove', 'state_id' => 3938],
                ['name' => 'Grainfield', 'state_id' => 3938],
                ['name' => 'Grinnell', 'state_id' => 3938],
                ['name' => 'Park', 'state_id' => 3938],
                ['name' => 'Quinter', 'state_id' => 3938],
                ['name' => 'Bogue', 'state_id' => 3938],
                ['name' => 'Hill City', 'state_id' => 3938],
                ['name' => 'Morland', 'state_id' => 3938],
                ['name' => 'Penokee', 'state_id' => 3938],
                ['name' => 'Ulysses', 'state_id' => 3938],
                ['name' => 'Cimarron', 'state_id' => 3938],
                ['name' => 'Copeland', 'state_id' => 3938],
                ['name' => 'Ensign', 'state_id' => 3938],
                ['name' => 'Ingalls', 'state_id' => 3938],
                ['name' => 'Montezuma', 'state_id' => 3938],
                ['name' => 'Tribune', 'state_id' => 3938],
                ['name' => 'Hamilton', 'state_id' => 3938],
                ['name' => 'Lamont', 'state_id' => 3938],
                ['name' => 'Madison', 'state_id' => 3938],
                ['name' => 'Neal', 'state_id' => 3938],
                ['name' => 'Virgil', 'state_id' => 3938],
                ['name' => 'Eureka', 'state_id' => 3938],
                ['name' => 'Fall River', 'state_id' => 3938],
                ['name' => 'Piedmont', 'state_id' => 3938],
                ['name' => 'Severy', 'state_id' => 3938],
                ['name' => 'Coolidge', 'state_id' => 3938],
                ['name' => 'Kendall', 'state_id' => 3938],
                ['name' => 'Syracuse', 'state_id' => 3938],
                ['name' => 'Anthony', 'state_id' => 3938],
                ['name' => 'Attica', 'state_id' => 3938],
                ['name' => 'Bluff City', 'state_id' => 3938],
                ['name' => 'Danville', 'state_id' => 3938],
                ['name' => 'Freeport', 'state_id' => 3938],
                ['name' => 'Harper', 'state_id' => 3938],
                ['name' => 'Waldron', 'state_id' => 3938],
                ['name' => 'Burrton', 'state_id' => 3938],
                ['name' => 'Halstead', 'state_id' => 3938],
                ['name' => 'Hesston', 'state_id' => 3938],
                ['name' => 'Newton', 'state_id' => 3938],
                ['name' => 'North Newton', 'state_id' => 3938],
                ['name' => 'Sedgwick', 'state_id' => 3938],
                ['name' => 'Walton', 'state_id' => 3938],
                ['name' => 'Satanta', 'state_id' => 3938],
                ['name' => 'Sublette', 'state_id' => 3938],
                ['name' => 'Hanston', 'state_id' => 3938],
                ['name' => 'Jetmore', 'state_id' => 3938],
                ['name' => 'Circleville', 'state_id' => 3938],
                ['name' => 'Delia', 'state_id' => 3938],
                ['name' => 'Denison', 'state_id' => 3938],
                ['name' => 'Holton', 'state_id' => 3938],
                ['name' => 'Hoyt', 'state_id' => 3938],
                ['name' => 'Mayetta', 'state_id' => 3938],
                ['name' => 'Netawaka', 'state_id' => 3938],
                ['name' => 'Soldier', 'state_id' => 3938],
                ['name' => 'Whiting', 'state_id' => 3938],
                ['name' => 'Mc Louth', 'state_id' => 3938],
                ['name' => 'Nortonville', 'state_id' => 3938],
                ['name' => 'Oskaloosa', 'state_id' => 3938],
                ['name' => 'Ozawkie', 'state_id' => 3938],
                ['name' => 'Perry', 'state_id' => 3938],
                ['name' => 'Valley Falls', 'state_id' => 3938],
                ['name' => 'Winchester', 'state_id' => 3938],
                ['name' => 'Grantville', 'state_id' => 3938],
                ['name' => 'Meriden', 'state_id' => 3938],
                ['name' => 'Burr Oak', 'state_id' => 3938],
                ['name' => 'Esbon', 'state_id' => 3938],
                ['name' => 'Formoso', 'state_id' => 3938],
                ['name' => 'Jewell', 'state_id' => 3938],
                ['name' => 'Mankato', 'state_id' => 3938],
                ['name' => 'Randall', 'state_id' => 3938],
                ['name' => 'Webber', 'state_id' => 3938],
                ['name' => 'De Soto', 'state_id' => 3938],
                ['name' => 'Edgerton', 'state_id' => 3938],
                ['name' => 'Gardner', 'state_id' => 3938],
                ['name' => 'New Century', 'state_id' => 3938],
                ['name' => 'Olathe', 'state_id' => 3938],
                ['name' => 'Spring Hill', 'state_id' => 3938],
                ['name' => 'Stilwell', 'state_id' => 3938],
                ['name' => 'Mission', 'state_id' => 3938],
                ['name' => 'Shawnee', 'state_id' => 3938],
                ['name' => 'Overland Park', 'state_id' => 3938],
                ['name' => 'Leawood', 'state_id' => 3938],
                ['name' => 'Prairie Village', 'state_id' => 3938],
                ['name' => 'Lenexa', 'state_id' => 3938],
                ['name' => 'Shawnee Mission', 'state_id' => 3938],
                ['name' => 'Deerfield', 'state_id' => 3938],
                ['name' => 'Lakin', 'state_id' => 3938],
                ['name' => 'Cunningham', 'state_id' => 3938],
                ['name' => 'Kingman', 'state_id' => 3938],
                ['name' => 'Murdock', 'state_id' => 3938],
                ['name' => 'Nashville', 'state_id' => 3938],
                ['name' => 'Norwich', 'state_id' => 3938],
                ['name' => 'Spivey', 'state_id' => 3938],
                ['name' => 'Zenda', 'state_id' => 3938],
                ['name' => 'Greensburg', 'state_id' => 3938],
                ['name' => 'Haviland', 'state_id' => 3938],
                ['name' => 'Mullinville', 'state_id' => 3938],
                ['name' => 'Altamont', 'state_id' => 3938],
                ['name' => 'Bartlett', 'state_id' => 3938],
                ['name' => 'Chetopa', 'state_id' => 3938],
                ['name' => 'Dennis', 'state_id' => 3938],
                ['name' => 'Edna', 'state_id' => 3938],
                ['name' => 'Mound Valley', 'state_id' => 3938],
                ['name' => 'Oswego', 'state_id' => 3938],
                ['name' => 'Parsons', 'state_id' => 3938],
                ['name' => 'Dighton', 'state_id' => 3938],
                ['name' => 'Healy', 'state_id' => 3938],
                ['name' => 'Basehor', 'state_id' => 3938],
                ['name' => 'Easton', 'state_id' => 3938],
                ['name' => 'Fort Leavenworth', 'state_id' => 3938],
                ['name' => 'Lansing', 'state_id' => 3938],
                ['name' => 'Leavenworth', 'state_id' => 3938],
                ['name' => 'Linwood', 'state_id' => 3938],
                ['name' => 'Tonganoxie', 'state_id' => 3938],
                ['name' => 'Barnard', 'state_id' => 3938],
                ['name' => 'Beverly', 'state_id' => 3938],
                ['name' => 'Lincoln', 'state_id' => 3938],
                ['name' => 'Sylvan Grove', 'state_id' => 3938],
                ['name' => 'Blue Mound', 'state_id' => 3938],
                ['name' => 'Centerville', 'state_id' => 3938],
                ['name' => 'Lacygne', 'state_id' => 3938],
                ['name' => 'Mound City', 'state_id' => 3938],
                ['name' => 'Parker', 'state_id' => 3938],
                ['name' => 'Pleasanton', 'state_id' => 3938],
                ['name' => 'Prescott', 'state_id' => 3938],
                ['name' => 'Monument', 'state_id' => 3938],
                ['name' => 'Oakley', 'state_id' => 3938],
                ['name' => 'Winona', 'state_id' => 3938],
                ['name' => 'Emporia', 'state_id' => 3938],
                ['name' => 'Admire', 'state_id' => 3938],
                ['name' => 'Allen', 'state_id' => 3938],
                ['name' => 'Americus', 'state_id' => 3938],
                ['name' => 'Hartford', 'state_id' => 3938],
                ['name' => 'Neosho Rapids', 'state_id' => 3938],
                ['name' => 'Olpe', 'state_id' => 3938],
                ['name' => 'Reading', 'state_id' => 3938],
                ['name' => 'Moundridge', 'state_id' => 3938],
                ['name' => 'Canton', 'state_id' => 3938],
                ['name' => 'Galva', 'state_id' => 3938],
                ['name' => 'Lindsborg', 'state_id' => 3938],
                ['name' => 'Mcpherson', 'state_id' => 3938],
                ['name' => 'Marquette', 'state_id' => 3938],
                ['name' => 'Roxbury', 'state_id' => 3938],
                ['name' => 'Windom', 'state_id' => 3938],
                ['name' => 'Inman', 'state_id' => 3938],
                ['name' => 'Burns', 'state_id' => 3938],
                ['name' => 'Florence', 'state_id' => 3938],
                ['name' => 'Lincolnville', 'state_id' => 3938],
                ['name' => 'Lost Springs', 'state_id' => 3938],
                ['name' => 'Marion', 'state_id' => 3938],
                ['name' => 'Peabody', 'state_id' => 3938],
                ['name' => 'Goessel', 'state_id' => 3938],
                ['name' => 'Hillsboro', 'state_id' => 3938],
                ['name' => 'Lehigh', 'state_id' => 3938],
                ['name' => 'Durham', 'state_id' => 3938],
                ['name' => 'Ramona', 'state_id' => 3938],
                ['name' => 'Tampa', 'state_id' => 3938],
                ['name' => 'Axtell', 'state_id' => 3938],
                ['name' => 'Beattie', 'state_id' => 3938],
                ['name' => 'Blue Rapids', 'state_id' => 3938],
                ['name' => 'Bremen', 'state_id' => 3938],
                ['name' => 'Frankfort', 'state_id' => 3938],
                ['name' => 'Home', 'state_id' => 3938],
                ['name' => 'Marysville', 'state_id' => 3938],
                ['name' => 'Oketo', 'state_id' => 3938],
                ['name' => 'Summerfield', 'state_id' => 3938],
                ['name' => 'Vermillion', 'state_id' => 3938],
                ['name' => 'Waterville', 'state_id' => 3938],
                ['name' => 'Fowler', 'state_id' => 3938],
                ['name' => 'Meade', 'state_id' => 3938],
                ['name' => 'Plains', 'state_id' => 3938],
                ['name' => 'Bucyrus', 'state_id' => 3938],
                ['name' => 'Fontana', 'state_id' => 3938],
                ['name' => 'Hillsdale', 'state_id' => 3938],
                ['name' => 'Louisburg', 'state_id' => 3938],
                ['name' => 'Osawatomie', 'state_id' => 3938],
                ['name' => 'Paola', 'state_id' => 3938],
                ['name' => 'Beloit', 'state_id' => 3938],
                ['name' => 'Cawker City', 'state_id' => 3938],
                ['name' => 'Glen Elder', 'state_id' => 3938],
                ['name' => 'Hunter', 'state_id' => 3938],
                ['name' => 'Simpson', 'state_id' => 3938],
                ['name' => 'Tipton', 'state_id' => 3938],
                ['name' => 'Independence', 'state_id' => 3938],
                ['name' => 'Caney', 'state_id' => 3938],
                ['name' => 'Cherryvale', 'state_id' => 3938],
                ['name' => 'Coffeyville', 'state_id' => 3938],
                ['name' => 'Dearing', 'state_id' => 3938],
                ['name' => 'Elk City', 'state_id' => 3938],
                ['name' => 'Havana', 'state_id' => 3938],
                ['name' => 'Liberty', 'state_id' => 3938],
                ['name' => 'Sycamore', 'state_id' => 3938],
                ['name' => 'Tyro', 'state_id' => 3938],
                ['name' => 'Burdick', 'state_id' => 3938],
                ['name' => 'Council Grove', 'state_id' => 3938],
                ['name' => 'Dwight', 'state_id' => 3938],
                ['name' => 'White City', 'state_id' => 3938],
                ['name' => 'Wilsey', 'state_id' => 3938],
                ['name' => 'Elkhart', 'state_id' => 3938],
                ['name' => 'Richfield', 'state_id' => 3938],
                ['name' => 'Rolla', 'state_id' => 3938],
                ['name' => 'Baileyville', 'state_id' => 3938],
                ['name' => 'Bern', 'state_id' => 3938],
                ['name' => 'Centralia', 'state_id' => 3938],
                ['name' => 'Corning', 'state_id' => 3938],
                ['name' => 'Goff', 'state_id' => 3938],
                ['name' => 'Oneida', 'state_id' => 3938],
                ['name' => 'Sabetha', 'state_id' => 3938],
                ['name' => 'Seneca', 'state_id' => 3938],
                ['name' => 'Wetmore', 'state_id' => 3938],
                ['name' => 'Chanute', 'state_id' => 3938],
                ['name' => 'Erie', 'state_id' => 3938],
                ['name' => 'Galesburg', 'state_id' => 3938],
                ['name' => 'Saint Paul', 'state_id' => 3938],
                ['name' => 'Stark', 'state_id' => 3938],
                ['name' => 'Thayer', 'state_id' => 3938],
                ['name' => 'Arnold', 'state_id' => 3938],
                ['name' => 'Bazine', 'state_id' => 3938],
                ['name' => 'Beeler', 'state_id' => 3938],
                ['name' => 'Brownell', 'state_id' => 3938],
                ['name' => 'Ness City', 'state_id' => 3938],
                ['name' => 'Ransom', 'state_id' => 3938],
                ['name' => 'Utica', 'state_id' => 3938],
                ['name' => 'Almena', 'state_id' => 3938],
                ['name' => 'Clayton', 'state_id' => 3938],
                ['name' => 'Lenora', 'state_id' => 3938],
                ['name' => 'Norton', 'state_id' => 3938],
                ['name' => 'Burlingame', 'state_id' => 3938],
                ['name' => 'Carbondale', 'state_id' => 3938],
                ['name' => 'Lyndon', 'state_id' => 3938],
                ['name' => 'Melvern', 'state_id' => 3938],
                ['name' => 'Osage City', 'state_id' => 3938],
                ['name' => 'Overbrook', 'state_id' => 3938],
                ['name' => 'Quenemo', 'state_id' => 3938],
                ['name' => 'Scranton', 'state_id' => 3938],
                ['name' => 'Vassar', 'state_id' => 3938],
                ['name' => 'Downs', 'state_id' => 3938],
                ['name' => 'Osborne', 'state_id' => 3938],
                ['name' => 'Portis', 'state_id' => 3938],
                ['name' => 'Alton', 'state_id' => 3938],
                ['name' => 'Natoma', 'state_id' => 3938],
                ['name' => 'Bennington', 'state_id' => 3938],
                ['name' => 'Delphos', 'state_id' => 3938],
                ['name' => 'Minneapolis', 'state_id' => 3938],
                ['name' => 'Tescott', 'state_id' => 3938],
                ['name' => 'Burdett', 'state_id' => 3938],
                ['name' => 'Garfield', 'state_id' => 3938],
                ['name' => 'Larned', 'state_id' => 3938],
                ['name' => 'Rozel', 'state_id' => 3938],
                ['name' => 'Agra', 'state_id' => 3938],
                ['name' => 'Glade', 'state_id' => 3938],
                ['name' => 'Kirwin', 'state_id' => 3938],
                ['name' => 'Logan', 'state_id' => 3938],
                ['name' => 'Long Island', 'state_id' => 3938],
                ['name' => 'Phillipsburg', 'state_id' => 3938],
                ['name' => 'Prairie View', 'state_id' => 3938],
                ['name' => 'Belvue', 'state_id' => 3938],
                ['name' => 'Emmett', 'state_id' => 3938],
                ['name' => 'Fostoria', 'state_id' => 3938],
                ['name' => 'Havensville', 'state_id' => 3938],
                ['name' => 'Olsburg', 'state_id' => 3938],
                ['name' => 'Onaga', 'state_id' => 3938],
                ['name' => 'Saint George', 'state_id' => 3938],
                ['name' => 'Saint Marys', 'state_id' => 3938],
                ['name' => 'Wamego', 'state_id' => 3938],
                ['name' => 'Westmoreland', 'state_id' => 3938],
                ['name' => 'Byers', 'state_id' => 3938],
                ['name' => 'Coats', 'state_id' => 3938],
                ['name' => 'Iuka', 'state_id' => 3938],
                ['name' => 'Pratt', 'state_id' => 3938],
                ['name' => 'Sawyer', 'state_id' => 3938],
                ['name' => 'Atwood', 'state_id' => 3938],
                ['name' => 'Herndon', 'state_id' => 3938],
                ['name' => 'Ludell', 'state_id' => 3938],
                ['name' => 'Mc Donald', 'state_id' => 3938],
                ['name' => 'Hutchinson', 'state_id' => 3938],
                ['name' => 'South Hutchinson', 'state_id' => 3938],
                ['name' => 'Abbyville', 'state_id' => 3938],
                ['name' => 'Arlington', 'state_id' => 3938],
                ['name' => 'Buhler', 'state_id' => 3938],
                ['name' => 'Haven', 'state_id' => 3938],
                ['name' => 'Nickerson', 'state_id' => 3938],
                ['name' => 'Partridge', 'state_id' => 3938],
                ['name' => 'Plevna', 'state_id' => 3938],
                ['name' => 'Pretty Prairie', 'state_id' => 3938],
                ['name' => 'Sylvia', 'state_id' => 3938],
                ['name' => 'Turon', 'state_id' => 3938],
                ['name' => 'Yoder', 'state_id' => 3938],
                ['name' => 'Agenda', 'state_id' => 3938],
                ['name' => 'Belleville', 'state_id' => 3938],
                ['name' => 'Courtland', 'state_id' => 3938],
                ['name' => 'Cuba', 'state_id' => 3938],
                ['name' => 'Munden', 'state_id' => 3938],
                ['name' => 'Narka', 'state_id' => 3938],
                ['name' => 'Norway', 'state_id' => 3938],
                ['name' => 'Republic', 'state_id' => 3938],
                ['name' => 'Scandia', 'state_id' => 3938],
                ['name' => 'Bushton', 'state_id' => 3938],
                ['name' => 'Geneseo', 'state_id' => 3938],
                ['name' => 'Little River', 'state_id' => 3938],
                ['name' => 'Alden', 'state_id' => 3938],
                ['name' => 'Chase', 'state_id' => 3938],
                ['name' => 'Lyons', 'state_id' => 3938],
                ['name' => 'Raymond', 'state_id' => 3938],
                ['name' => 'Sterling', 'state_id' => 3938],
                ['name' => 'Leonardville', 'state_id' => 3938],
                ['name' => 'Manhattan', 'state_id' => 3938],
                ['name' => 'Ogden', 'state_id' => 3938],
                ['name' => 'Riley', 'state_id' => 3938],
                ['name' => 'Randolph', 'state_id' => 3938],
                ['name' => 'Damar', 'state_id' => 3938],
                ['name' => 'Palco', 'state_id' => 3938],
                ['name' => 'Plainville', 'state_id' => 3938],
                ['name' => 'Stockton', 'state_id' => 3938],
                ['name' => 'Woodston', 'state_id' => 3938],
                ['name' => 'Alexander', 'state_id' => 3938],
                ['name' => 'Bison', 'state_id' => 3938],
                ['name' => 'La Crosse', 'state_id' => 3938],
                ['name' => 'Liebenthal', 'state_id' => 3938],
                ['name' => 'Mc Cracken', 'state_id' => 3938],
                ['name' => 'Nekoma', 'state_id' => 3938],
                ['name' => 'Otis', 'state_id' => 3938],
                ['name' => 'Rush Center', 'state_id' => 3938],
                ['name' => 'Bunker Hill', 'state_id' => 3938],
                ['name' => 'Dorrance', 'state_id' => 3938],
                ['name' => 'Gorham', 'state_id' => 3938],
                ['name' => 'Lucas', 'state_id' => 3938],
                ['name' => 'Luray', 'state_id' => 3938],
                ['name' => 'Paradise', 'state_id' => 3938],
                ['name' => 'Russell', 'state_id' => 3938],
                ['name' => 'Waldo', 'state_id' => 3938],
                ['name' => 'Salina', 'state_id' => 3938],
                ['name' => 'Assaria', 'state_id' => 3938],
                ['name' => 'Brookville', 'state_id' => 3938],
                ['name' => 'Falun', 'state_id' => 3938],
                ['name' => 'Gypsum', 'state_id' => 3938],
                ['name' => 'New Cambria', 'state_id' => 3938],
                ['name' => 'Scott City', 'state_id' => 3938],
                ['name' => 'Andale', 'state_id' => 3938],
                ['name' => 'Bentley', 'state_id' => 3938],
                ['name' => 'Cheney', 'state_id' => 3938],
                ['name' => 'Clearwater', 'state_id' => 3938],
                ['name' => 'Colwich', 'state_id' => 3938],
                ['name' => 'Derby', 'state_id' => 3938],
                ['name' => 'Garden Plain', 'state_id' => 3938],
                ['name' => 'Goddard', 'state_id' => 3938],
                ['name' => 'Greenwich', 'state_id' => 3938],
                ['name' => 'Haysville', 'state_id' => 3938],
                ['name' => 'Kechi', 'state_id' => 3938],
                ['name' => 'Maize', 'state_id' => 3938],
                ['name' => 'Mount Hope', 'state_id' => 3938],
                ['name' => 'Peck', 'state_id' => 3938],
                ['name' => 'Valley Center', 'state_id' => 3938],
                ['name' => 'Viola', 'state_id' => 3938],
                ['name' => 'Wichita', 'state_id' => 3938],
                ['name' => 'Mcconnell Afb', 'state_id' => 3938],
                ['name' => 'Kismet', 'state_id' => 3938],
                ['name' => 'Liberal', 'state_id' => 3938],
                ['name' => 'Auburn', 'state_id' => 3938],
                ['name' => 'Berryton', 'state_id' => 3938],
                ['name' => 'Dover', 'state_id' => 3938],
                ['name' => 'Rossville', 'state_id' => 3938],
                ['name' => 'Silver Lake', 'state_id' => 3938],
                ['name' => 'Tecumseh', 'state_id' => 3938],
                ['name' => 'Wakarusa', 'state_id' => 3938],
                ['name' => 'Topeka', 'state_id' => 3938],
                ['name' => 'Hoxie', 'state_id' => 3938],
                ['name' => 'Selden', 'state_id' => 3938],
                ['name' => 'Edson', 'state_id' => 3938],
                ['name' => 'Goodland', 'state_id' => 3938],
                ['name' => 'Kanorado', 'state_id' => 3938],
                ['name' => 'Athol', 'state_id' => 3938],
                ['name' => 'Kensington', 'state_id' => 3938],
                ['name' => 'Lebanon', 'state_id' => 3938],
                ['name' => 'Smith Center', 'state_id' => 3938],
                ['name' => 'Cedar', 'state_id' => 3938],
                ['name' => 'Gaylord', 'state_id' => 3938],
                ['name' => 'Hudson', 'state_id' => 3938],
                ['name' => 'Macksville', 'state_id' => 3938],
                ['name' => 'St John', 'state_id' => 3938],
                ['name' => 'Stafford', 'state_id' => 3938],
                ['name' => 'Johnson', 'state_id' => 3938],
                ['name' => 'Manter', 'state_id' => 3938],
                ['name' => 'Hugoton', 'state_id' => 3938],
                ['name' => 'Moscow', 'state_id' => 3938],
                ['name' => 'Argonia', 'state_id' => 3938],
                ['name' => 'Belle Plaine', 'state_id' => 3938],
                ['name' => 'Caldwell', 'state_id' => 3938],
                ['name' => 'Conway Springs', 'state_id' => 3938],
                ['name' => 'Geuda Springs', 'state_id' => 3938],
                ['name' => 'Mayfield', 'state_id' => 3938],
                ['name' => 'Milan', 'state_id' => 3938],
                ['name' => 'Milton', 'state_id' => 3938],
                ['name' => 'Mulvane', 'state_id' => 3938],
                ['name' => 'Oxford', 'state_id' => 3938],
                ['name' => 'South Haven', 'state_id' => 3938],
                ['name' => 'Wellington', 'state_id' => 3938],
                ['name' => 'Colby', 'state_id' => 3938],
                ['name' => 'Brewster', 'state_id' => 3938],
                ['name' => 'Gem', 'state_id' => 3938],
                ['name' => 'Levant', 'state_id' => 3938],
                ['name' => 'Rexford', 'state_id' => 3938],
                ['name' => 'Collyer', 'state_id' => 3938],
                ['name' => 'Ogallah', 'state_id' => 3938],
                ['name' => 'Wakeeney', 'state_id' => 3938],
                ['name' => 'Alma', 'state_id' => 3938],
                ['name' => 'Eskridge', 'state_id' => 3938],
                ['name' => 'Harveyville', 'state_id' => 3938],
                ['name' => 'Mc Farland', 'state_id' => 3938],
                ['name' => 'Maple Hill', 'state_id' => 3938],
                ['name' => 'Paxico', 'state_id' => 3938],
                ['name' => 'Alta Vista', 'state_id' => 3938],
                ['name' => 'Sharon Springs', 'state_id' => 3938],
                ['name' => 'Wallace', 'state_id' => 3938],
                ['name' => 'Weskan', 'state_id' => 3938],
                ['name' => 'Barnes', 'state_id' => 3938],
                ['name' => 'Clifton', 'state_id' => 3938],
                ['name' => 'Greenleaf', 'state_id' => 3938],
                ['name' => 'Haddam', 'state_id' => 3938],
                ['name' => 'Hanover', 'state_id' => 3938],
                ['name' => 'Hollenberg', 'state_id' => 3938],
                ['name' => 'Linn', 'state_id' => 3938],
                ['name' => 'Mahaska', 'state_id' => 3938],
                ['name' => 'Morrowville', 'state_id' => 3938],
                ['name' => 'Palmer', 'state_id' => 3938],
                ['name' => 'Washington', 'state_id' => 3938],
                ['name' => 'Leoti', 'state_id' => 3938],
                ['name' => 'Marienthal', 'state_id' => 3938],
                ['name' => 'Altoona', 'state_id' => 3938],
                ['name' => 'Benedict', 'state_id' => 3938],
                ['name' => 'Buffalo', 'state_id' => 3938],
                ['name' => 'Fredonia', 'state_id' => 3938],
                ['name' => 'Neodesha', 'state_id' => 3938],
                ['name' => 'New Albany', 'state_id' => 3938],
                ['name' => 'Neosho Falls', 'state_id' => 3938],
                ['name' => 'Piqua', 'state_id' => 3938],
                ['name' => 'Toronto', 'state_id' => 3938],
                ['name' => 'Yates Center', 'state_id' => 3938],
                ['name' => 'Bonner Springs', 'state_id' => 3938],
                ['name' => 'Kansas City', 'state_id' => 3938],
                ['name' => 'Edwardsville', 'state_id' => 3938]
            ]);
        }
    }
}