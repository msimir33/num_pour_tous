<?php

use Library\Database\Connection;

require '../src/Library/Database/Connection.php';

$config = require '../config/database.php';
$db = new Connection($config);

$events = file_get_contents('https://public.opendatasoft.com/api/records/1.0/search/?dataset=evenements-publics-cibul&q=&facet=tags&facet=placename&facet=department&facet=region&facet=city&facet=date_start&facet=date_end&facet=pricing_info&facet=updated_at&facet=city_district');
$results = json_decode($events);

foreach ($results->records as $event) {
    $db->execute('INSERT INTO events (title, description, address, event_at) VALUES (:title, :description, :address, :event_at)', [
        'title' => $event->fields->title,
        'description' => $event->fields->description,
        'address' => $event->fields->address,
        'event_at' => $event->fields->date_start
    ]);
}