<?php 

require 'vendor/autoload.php';

use Guzzle\Http\Client;

$client = new Client('http://' . $_GET['host'] . '/georeport/v2', null);


$request = $client->get('requests');
$request->getQuery()->set('limit', $_GET['limit']);

$response = $request->send();
$data = $response->json();

// Credit goes to https://github.com/bmcbride/PHP-Database-GeoJSON/blob/master/mysql_geojson.php

# Build GeoJSON feature collection array
$geojson = array(
  'type'      => 'FeatureCollection',
  'features'  => array()
);

# Loop through rows to build feature arrays
foreach ($data as $row) {
  $properties = $row;
  # Remove x and y fields from properties (optional)
  unset($properties['long']);
  unset($properties['lat']);
  $feature = array(
    'type' => 'Feature',
    'geometry' => array(
      'type' => 'Point',
      'coordinates' => array(
        $row['long'],
        $row['lat']
      )
    ),
    'properties' => $row
  );
  # Add feature arrays to feature collection array
  array_push($geojson['features'], $feature);
}

header('Content-type: application/json');
echo json_encode($geojson, JSON_NUMERIC_CHECK);