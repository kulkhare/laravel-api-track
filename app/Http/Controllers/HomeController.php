<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ApiRequestLog;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request){
        $show = request('show', 30);
        $partners = User::where('role',2)->get();
        $apiRequests = ApiRequestLog::with(['user'])
                        ->when($request->by_partner != '' && $request->by_partner != "all", function ($query) use ($request){
                            return $query->where('requester', $request->by_partner);
                        })
                        ->when($request->by_datetime != '', function ($query) use ($request){
                            return $query->where('created_at', $request->by_datetime);
                        })
                        ->take($show)
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('home', compact('partners', 'apiRequests'));
    }
}
