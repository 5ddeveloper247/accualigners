<?php

$forms = [
    1 => ['title'=>'Dashbord', 'form_id' => 1],
    2 => ['title'=>'Admin User', 'form_id' => 2],
    3 => ['title'=>'Patient', 'form_id' => 3],
    4 => ['title'=>'Clinic', 'form_id' => 4],
    5 => ['title'=>'Doctor', 'form_id' => 5],
    6 => ['title'=>'Clinic Doctor', 'form_id' => 6],
    7 => ['title'=>'Shipping', 'form_id' => 7],
    8 => ['title'=>'Shipping Charges', 'form_id' => 8],
    9 => ['title'=>'Appointment', 'form_id' => 9],
    10 => ['title'=>'Order', 'form_id' => 10],
    11 => ['title'=>'Slider', 'form_id' => 11],
    12 => ['title'=>'Case', 'form_id' => 12],
    13 => ['title'=>'Setting', 'form_id' => 13],
];

$user_permission = [];
$user_permission['admin'] = [1,2,3,4,5,6,7,8,9,10,11,12,13];
$user_permission['receptionist'] = [1,12];

return $user_permission;