<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UserTracker;
use Illuminate\Http\Request;

class UserTrackerController extends Controller
{
    public function store(Request $request)
    {
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $browser_patterns = array(
            'Firefox' => 'Firefox',
            'Chrome' => 'Chrome',
            'Safari' => 'Safari',
            'Opera' => 'Opera',
            'Internet Explorer' => 'MSIE', // Internet Explorer
            'Edge' => 'Edge', // Microsoft Edge
        );
        $browser_name = '';
        $system_user_name = get_current_user();
        foreach ($browser_patterns as $browser_name => $pattern) {
            if (stripos($user_agent, $pattern) !== false) {
                $browser_name = $browser_name;
                break;
            }
        }

        if (empty($browser_name)) {
            $browser_name = $user_agent;
        }
        UserTracker::updateOrCreate(['user_ip' => $user_ip], [
            'country' => $request->country_info,
            'user_ip' => $user_ip,
            'url' => $request->url,
            'browser_name' => $browser_name,
            'system_user_name' => $system_user_name,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Tracking Successfully'
        ]);
    }
}
