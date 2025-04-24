<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UserTracker;
use Illuminate\Http\Request;

class ApiUserTrackerController extends Controller
{
    public function trackUser(Request $request)
    {
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $system_user_name = get_current_user();
        $user_agent = $request->user_agent;


        $browser_patterns = [
            'Firefox' => 'Firefox',
            'Chrome' => 'Chrome',
            'Safari' => 'Safari',
            'Opera' => 'Opera',
            'Internet Explorer' => 'MSIE',
            'Edge' => 'Edge',
        ];
        $browser_name = $user_agent;

        foreach ($browser_patterns as $name => $pattern) {
            if (stripos($user_agent, $pattern) !== false) {
                $browser_name = $name;
                break;
            }
        }

        UserTracker::updateOrCreate(
            ['user_ip' => $user_ip],
            [
                'country' => $request->country_info,
                'user_ip' => $user_ip,
                'url' => $request->url,
                'browser_name' => $browser_name,
                'system_user_name' => $system_user_name,
            ]
        );

        return response()->json([
            'status' => 200,
            'message' => 'Tracking Successfully',
        ]);
    }
}
