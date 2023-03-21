<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Users::all();
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

        $user = Users::find($id);

        if (!$user) {

            $response = [
                'message' => 'user does not exist',
            ];

            return response($response);
        }

        $response = [
            'id' => $user->id,
            'name' => $user->full_name,
        ];

        return response($response, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Users::find($id);
        $user->update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Users::destroy($id);

        $response = [
            'message' => 'user deleted successfully',
        ];

        return response($response, 201);
    }
}
