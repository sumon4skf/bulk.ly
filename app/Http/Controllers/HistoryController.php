<?php

namespace Bulkly\Http\Controllers;

use Bulkly\cr;
use Illuminate\Http\Request;
use Bulkly\BufferPosting;
use Bulkly\SocialPostGroups;
use DB;
use Carbon;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request()->input('search');
        $search = explode("+", $search );
        $search = implode(" ", $search);
        $date = request()->input('date');
        $group = request()->input('group');

        $BufferPosting = BufferPosting::with('groupInfo','accountInfo');

        if(request()->has('search') && $search !== ""){
            $BufferPosting = $BufferPosting->where('post_text', 'LIKE', "%{$search}%" );
        }

        
        // if(request()->has('date')){
        //     $BufferPosting = $BufferPosting->where('sent_at',  date("Y-m-d H:i:s", strtotime($date)) );
        // }

        
        if(request()->has('group') && $group !== ""){

            $BufferPosting = $BufferPosting->where('group_id', $group );
        }

        $BufferPosting = $BufferPosting->paginate(10);


        $groups = SocialPostGroups::get();

         // dd($BufferPosting);

       return view('pages.history', compact('BufferPosting','groups'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Bulkly\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Bulkly\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Bulkly\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cr $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Bulkly\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy(cr $cr)
    {
        //
    }
}
