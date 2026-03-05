<?php

$searchPages = [
"https://www.youtube.com/results?search_query=th18+war+base+link",
"https://www.youtube.com/results?search_query=th17+war+base+link",
"https://www.youtube.com/results?search_query=th16+war+base+link"
];

$allLinks = [];

foreach($searchPages as $url){

$html = file_get_contents($url);

preg_match_all(
'/https:\/\/link\.clashofclans\.com[^ "\']+/',
$html,
$matches
);

if(!empty($matches[0])){
$allLinks = array_merge($allLinks,$matches[0]);
}

}

$allLinks = array_unique($allLinks);

$data = [
"townhall"=>18,
"recommended_bases"=>[]
];

foreach($allLinks as $link){

$data["recommended_bases"][]=[
"type"=>"war",
"link"=>$link
];

}

file_put_contents(
"bases/th18.json",
json_encode($data,JSON_PRETTY_PRINT)
);

echo "Links collected: ".count($allLinks);

?>