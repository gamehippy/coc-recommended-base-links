<?php

$pages = [
"https://www.youtube.com/results?search_query=th18+war+base+link",
"https://www.youtube.com/results?search_query=th18+legend+base+link",
"https://www.youtube.com/results?search_query=th18+farming+base+link"
];

$links = [];

foreach($pages as $url){

$html = file_get_contents($url);

preg_match_all(
'/https:\/\/link\.clashofclans\.com[^ "\']+/',
$html,
$matches
);

if(!empty($matches[0])){
$links = array_merge($links,$matches[0]);
}

}

$links = array_unique($links);

$data = [
"townhall"=>18,
"recommended_bases"=>[]
];

foreach($links as $link){

$data["recommended_bases"][]=[
"type"=>"war",
"link"=>$link
];

}

file_put_contents(
"bases/th18.json",
json_encode($data,JSON_PRETTY_PRINT)
);

echo "Found ".count($links)." base links";

?>