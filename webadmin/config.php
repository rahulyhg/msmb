<?

$config["date"]			= getdate();
$config["db"]["name"] 		= "thecrec5_mat";

# user information
/*if ($config["user"]) {
	$config["userinfo"] = GetSingleRecord("users",$config["db"]["name"],"usrUniqueID",$config["tss_user"]);
	$config["userinfo"]["usrFullname"] = $config["userinfo"]["usrForename"]." ".$config["userinfo"]["usrSurname"];
	$config["userinfo"]["usrEmail"] = $config["userinfo"]["usrEmailAddress"];
}*/

# site url
#$config["siteurl"] = "http://www.thecreativeit.com/demourl@/shaadi/";
$config["siteurl"] = "http://www.thecreativeit.com/demourl@/shaadi/";

# general domain name
$config["contact"]["domain"]		= "thecreativeit.com";

# recipient of contact form submissions
//$config["contact"]["recipient"]		= "creativedesignforyou@gmail.com";

# e-mail address from which e-mails sent from the site appear to originate from
$config["contact"]["replyto"]		= "test@".$config["contact"]["domain"];

# other e-mail addresses
$config["contact"]["webmaster"]		= "test@".$config["contact"]["domain"];

# headers for e-mails sent from site
$config["contact"]["headers"]		= "From: ".$config["contact"]["replyto"]."\r\n";
$config["contact"]["headers"]		.= "Reply-To: ".$config["contact"]["replyto"]."\r\n";


$config["dtml_fieldinfo"]["sample"] = array(
	"id"		=> array("User ID",			"autofixed"),
	"name"		=> array("Name",			"textbox"),
	"age"		=> array("Age",		"textbox"),	
);


$config["menu_hobbie"] = array(
	"1"	=> "Acting",
	"2"	=> "Cooking",
	"3"	=> "Gardening/ landscaping",
	"4"	=> "Palmistry",
	"5"	=> "Astronomy",
	"6"	=> "Crosswords",
	"7"	=> "Graphology",
	"8"	=> "Pets",
	"9"	=> "Astrology",
	"10"	=> "Dancing",
	"11"	=> "Nature",
	"12"	=> "Photography",
	"13"	=> "Art / handicraft",
	"14"	=> "Film-making",
	"15"	=> "Numerology",
	"16"	=> "Playing musical instruments",
	"17"	=> "Collectibles",
	"18"	=> "Fishing",
	"19"	=> "Painting",
	"20"	=> "Puzzles",	
);
$config["menu_interest"] = array(
	"1"	=> "Adventure sports",
	"2"	=> "Learning new languages",
	"3"	=> "Social service",
	"4"	=> "Writing",
	"5"	=> "Book clubs",
	"6"	=> "Movies",
	"7"	=> "Sports",
	"8"	=> "Yoga",
	"9"	=> "Computer games",
	"10"	=> "Music",
	"11"	=> "Television",
	"12"	=> "Alternative healing / medicine",
	"13"	=> "Health & fitness",
	"14"	=> "Politics",
	"15"	=> "Theatre",
	"16"	=> "Internet",
	"17"	=> "Reading",
	"18"	=> "Travel",
);
$config["menu_music"] = array(
	"1"	=> "Blues",
	"2"	=> "Hip-Hop",
	"3"	=> "Jazz",
	"4"	=> "Sufi",
	"5"	=> "Devotional",
	"6"	=> "Heavy metal",
	"7"	=> "Pop",
	"8"	=> "Techno",
	"9"	=> "Disco",
	"10"	=> "House music",
	"11"	=> "Qawalis",
	"12"	=> "Western classical",
	"13"	=> "Film songs",
	"14"	=> "Indian classical",
	"15"	=> "Rap",
	"16"	=> "Don't have an ear for music",
	"17"	=> "Ghazals",
	"18"	=> "Indipop",	
	"19"	=> "Reggae",
);

$config["menu_read"] = array(
	"1"	=> "Actually a bookworm",
	"2"	=> "Fantasy",
	"3"	=> "Philosophy / spiritual",
	"4"	=> "Short stories",
	"5"	=> "Biographies",
	"6"	=> "History",
	"7"	=> "Poetry",
	"8"	=> "Stay away from books",
	"9"	=> "Business / Occupational",
	"10"	=> "Humor",
	"11"	=> "Romance",
	"12"	=> "Thriller / suspense",
	"13"	=> "Classi",
	"14"	=> "Literature",
	"15"	=> "Science fiction",
	"16"	=> "Comics",
	"17"	=> "Magazines/newspapers",
	"18"	=> "Self-help",		
);

$config["menu_movie"] = array(
	"1"	=> "Action / suspense",
	"2"	=> "Epics",
	"3"	=> "Not into movies",
	"4"	=> "Comedy",
	"5"	=> "Horror",
	"6"	=> "Non-commercial / art",
	"7"	=> "Classic",
	"8"	=> "Romantic",
	"9"	=> "World cinema",
	"10"	=> "Drama",
	"11"	=> "Short films",
	"12"	=> "You can call me a movie",
	"13"	=> "Documentaries",
	"14"	=> "Sci-Fi & fantasy",
);

$config["menu_sport"] = array(
	"1"	=> "Adventure Sports",
	"2"	=> "Cricket",
	"3"	=> "Golf",
	"4"	=> "Swimming / water sports",
	"5"	=> "Aerobics",
	"6"	=> "Cycling",
	"7"	=> "Hockey",
	"8"	=> "Table-tennis",
	"9"	=> "Basketball",
	"10"	=> "Card games",
	"11"	=> "Jogging / walking",
	"12"	=> "Tennis",
	"13"	=> "Badminton",
	"14"	=> "Carrom",
	"15"	=> "Martial arts",
	"16"	=> "Volleyball",
	"17"	=> "Bowling",
	"18"	=> "Chess",
	"19"	=> "Scrabble",
	"20"	=> "Weight training",
	"21"	=> "Billiards / snooker / pool",		
	"22"	=> "Football",
	"23"	=> "Squash",
	"24"	=> "Yoga / meditation",
);

$config["menu_cuisine"] = array(
	"1"	=> "Arabic",
	"2"	=> "Italian",
	"3"	=> "Punjabi",
	"4"	=> "If anything can be eaten, I will!",
	"5"	=> "Bengali",
	"6"	=> "Konkan",
	"7"	=> "Rajasthani",
	"8"	=> "Chinese",
	"9"	=> "Mexican",
	"10"	=> "South Indian",
	"11"	=> "Continental",
	"12"	=> "Moghlai",
	"13"	=> "Sushi",
	"14"	=> "Gujarati",
	"15"	=> "Not a foodie!",
	"16"	=> "Thai",
);

$config["menu_dress"] = array(
	"1"	=> "Casual",
	"2"	=> "Designer",
	"3"	=> "Indian / Ethnic wear",
	"4"	=> "Western formal wear",	
);

$config["dtml_fieldinfo"]["tbl_register"] = array(
	"id"		=> array("User ID", "autofixed"),
	"username"		=> array("Username", "textbox"),
	"password"		=> array("Password", "textbox"),	
	"email"		=> array("Email address", "textbox"),
	"domail"		=> array("Domail", "combobox"),
	"name"		=> array("Name", "textbox"),
	"age"		=> array("Age", "textbox"),
	"gender"		=> array("Gender", "radiobox"),
	"maritalStatus" => array("Marital Status", "radiobox"),
	"no_of_Children" => array("No of children", "combobox"),
	"childrenLivingStatus" => array("Children living status", "radiobox"),
	"countryLivingIn" => array("Country living in", "combobox"),
	"citizenship" => array("Citizenship", "combobox"),
	"education" => array("Education", "combobox"),
	"educationDetail" => array("Education Details", "textbox"),
	"occupation" => array("Occupation", "combobox"),
	"occupationDetail" => array("Occupation Details", "textbox"),
		
);

?>