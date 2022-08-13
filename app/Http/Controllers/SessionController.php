<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessData;
use App\Models\Data;
use App\Models\Session;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sessions = Session::orderBy('is_running', 'DESC')->paginate(25);
        $isRunning = Session::isRunning();
        $setting = Setting::all()?->first();

        return view('scrapper.index', compact('sessions', 'isRunning', 'setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $session = Session::where('is_running', 1)->first();
        if (!$session) {
            $oldSession = Session::latest()->first();
            $session = new Session([
                'pattern' => Setting::all()?->first()?->pattern ?: env('SCRAPPER_PATTERN'),
                'is_running'    => 1,
                'time'      => 0,
            ]);
            if ($oldSession?->pattern === $session->pattern) {
                $session->current_number =  $oldSession->current_number;
            }
            $session->save();
        }
        if (!$session->current_number) {
            $session->current_number = Data::getNumber($session->pattern);
        } else {
            $session->current_number++;
        }
        $session->save();
        ProcessData::dispatch($session);
        return redirect(route('session.index'));


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        //
        $date = Carbon::parse($session->start);
        $now =
        $session->is_running = false;
        $session->end = \Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP');;
        $session->time = $date->diffInSeconds(Carbon::now());
        $session->save();
        return redirect(route('session.index'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function updatePattern(Request $request, Session $session)
    {
        if ($request->pattern) {
            if (Setting::count() > 0) {
                $setting = Setting::all()->first();
            } else {
                $setting = new Setting();
            }
            $setting->pattern = $request->pattern;
            $setting->save();
        }

        return redirect(route('session.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        //
    }
}
