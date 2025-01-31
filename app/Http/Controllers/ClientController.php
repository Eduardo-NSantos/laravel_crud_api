<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Services\ApiResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return all clients in the database
        return ApiResponse::success(Client::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the request
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:clients',
                'phone' => 'required'
            ]
        );

        // add a new client to the database
        $client = new Client();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->save();

        return ApiResponse::success($client);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::find($id);

        if(!$client){
            return ApiResponse::error('client not found');
        }

        return ApiResponse::success($client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate the request
        $request->validate([
            'name' => 'required',
            'email' => "required|email|unique:clients,email,$id",
            'phone' => 'required'
        ]);

        // uptdate the client data in database
        $client = Client::find($id);

        if(!$client){
            return ApiResponse::error('client not found');
        }

        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->save();
        
        return ApiResponse::success($client);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete the client
        $client = Client::find($id);
        
        if(!$client){
            return ApiResponse::error('client not found');
        }

        $client->delete();
        return ApiResponse::success('client deleted successfully');
    }
}
