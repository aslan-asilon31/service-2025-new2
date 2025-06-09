<?php

namespace App\Http\Controllers\API\MsBarangResources;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Psr7\Request;

class MsBarangController extends Controller
{


    public function index()
    {
        // $response = Http::get('https://fakestoreapi.com/products');
        // dd($response);
        // $request = new Request('GET', 'https://fakestoreapi.com/products');

        $client = new \GuzzleHttp\Client([
            'verify' => false
        ]);

        $response = $client->get('https://fakestoreapi.com/products');
        dump(json_decode($response->getStatusCode(), true));
        dump(json_decode($response->getHeaderLine('content-type'), true));
        dump(json_decode($response->getBody(), true));

        dump('================Asinkron======================');

        $request = new \GuzzleHttp\Psr7\Request('GET', 'https://fakestoreapi.com/products');
        $promise = $client->sendAsync($request)->then(function ($response) {
            $body = $response->getBody()->getContents();
            $data = json_decode($body, true);
            dump($data);
        });
        $promise->wait();

        return view('api.barang', compact(''));
    }

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
