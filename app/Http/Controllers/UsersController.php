<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //test du commit a partir de phpstorm
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
    static::$db = self::firestoreDatabaseInstance();
    }


    public function index()
    {
        $docRef = self::$db->collection('User');
        $snapshot = $docRef->documents();
        $user = $snapshot;
        // print_r($user);
        return view ('users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $docRef = self::$db->collection('User');
        $docRef->add([
            'FullName' => $request->FullName
        ]);

        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $docRef = self::$db->collection('User')->document($id);
        //$query = $docRef->where('id', '=', $id);
        $snapshot = $docRef->snapshot();
        $user = $snapshot;

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $docRef = self::$db->collection('User')->document($id);
        $snapshot = $docRef->snapshot();
        $department = $snapshot;
        $docRef->set([
          'FullName' => $request->FullName
        ]);

        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $docRef = self::$db->collection('User')->document($id);
        $docRef->delete();

        return redirect('/users');
    }
}
