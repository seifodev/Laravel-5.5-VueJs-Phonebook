<?php

namespace App\Http\Controllers;

use App\Phonebook;
use Illuminate\Http\Request;
use App\Http\Requests\PhonebookRequest;

class PhonebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax())
        {
            return Phonebook::orderBy('name')->get();
        }
        return view('phonebook');
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
     * @param PhonebookRequest $request
     * @return void
     */
    public function store(PhonebookRequest $request)
    {
        $phonebook = Phonebook::create($request->all());
        return response($phonebook->toArray(), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function show(Phonebook $phonebook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function edit(Phonebook $phonebook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function update(PhonebookRequest $request, Phonebook $phonebook)
    {
        $phonebook->name = $request->name;
        $phonebook->phone = $request->phone;
        $phonebook->email = $request->email;

        $phonebook->save();

        return response($phonebook->toArray(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Phonebook $phonebook
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Phonebook $phonebook)
    {
        $phonebook->delete();
        return response(['status' => 'deleted']);
    }
}
