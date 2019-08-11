<?php

namespace App\Http\Controllers;

use App\Client;
use App\Exports\ClientsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderBy('name')->paginate(10);

        return view('clients.index',compact('clients'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!empty($request->files->get('file'))) {
            $clients = simplexml_load_file($request->files->get('file'));
        }

        $request->validate([
            'name' => 'required',
            'document' => 'required',
            'postcode' => 'required',
            'address' => 'required',
            'district' => 'required',
            'city' => 'required',
            'state' => 'required'
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')
            ->with('success', 'Torcedor criado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('clients.show',compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit',compact('client'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Torcedor excluído com sucesso.');
    }

    /**
     * Import a XML file.
     *
     * @param  \App\Client  $product
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        return view('clients.import');
    }

    public function toFrom($client)
    {
        return [
            'name' => $client['nome'],
            'document' => $client['documento'],
            'postcode' => $client['cep'],
            'address' => $client['endereco'],
            'district' => $client['bairro'],
            'city' => $client['cidade'],
            'state' => $client['uf'],
            'telephone' => $client['telefone'],
            'email' => $client['email'],
            'active' => $client['ativo'],
        ];
    }


    /**
     * Export clients to a Excel file.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new ClientsExport(), 'clientes.xlsx');
    }
}
