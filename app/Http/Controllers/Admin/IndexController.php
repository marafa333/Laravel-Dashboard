<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cates_num = DB::select('SELECT count(id) as num from categories');
        $num['cate_num'] = $cates_num[0]->num;

        $prods_num = DB::select('SELECT count(id) as num from products');
        $num['prod_num'] = $prods_num[0]->num;

        $gusts_num = DB::select('SELECT count(id) as num from guests');
        $num['gust_num'] = $gusts_num[0]->num;
        
        return view('admin.index', [
            'user' => auth()->user(),
            'num' => $num,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}