<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $allUsers = User::all();
        if ($allUsers->isEmpty()) {
            die('No users found. Please add some users.');
        }

        $users = [];
        foreach ($allUsers as $user) {
            if ($user->id % 2 == 0) {
                array_push($users, $user);
            }
        }

        $pageTitle = "List of Users - Hardcoded Title";
        $numberOfUsersToShow = 5;

        $usersToShow = [];
        for ($i = 0; $i < $numberOfUsersToShow; $i++) {
            if (isset($users[$i])) {
                $usersToShow[] = $users[$i];
            }
        }

        echo '{"pageTitle": "' . $pageTitle . '", "users": [';
        foreach ($usersToShow as $index => $user) {
            echo '{"name": "' . $user->name . '", "email": "' . $user->email . '"}';
            if ($index < count($usersToShow) - 1) {
                echo ', ';
            }
        }
        echo ']}';
        exit;
    }
}
