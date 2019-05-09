<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class LocationController extends Controller
{
    public function locations()
    {

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/sarathi-5e339-firebase-adminsdk-6wqpf-749e4337b0.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://sarathi-5e339.firebaseio.com/')
            ->create();

        $database = $firebase->getDatabase();

        $location = $database
            ->getReference('locations');
        // echo '<pre>';
        $locations = $location->getvalue();
        return view('home.add-location', compact('locations'));
        //return view('home');
//
//        return view('home.add-location');
    }

    public function viewMap()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/sarathi-5e339-firebase-adminsdk-6wqpf-749e4337b0.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://sarathi-5e339.firebaseio.com/')
            ->create();

        $database = $firebase->getDatabase();

        $location = $database
            ->getReference('locations');
        // echo '<pre>';
        $locations = $location->getvalue();
        return view('home.view-map', compact('locations'));
        //return view('home');

    }
//
//    public function showMap(){
//        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/sarathi-5e339-firebase-adminsdk-6wqpf-749e4337b0.json');
//        $firebase = (new Factory)
//            ->withServiceAccount($serviceAccount)
//            ->withDatabaseUri('https://sarathi-5e339.firebaseio.com/')
//            ->create();
//
//        $database = $firebase->getDatabase();
//
//        $location = $database
//            ->getReference('locations');
//        // echo '<pre>';
//        $locations = $location->getvalue();
//        return view('home.add-location', compact('locations'));
//        //return view('home');
//    }


}
