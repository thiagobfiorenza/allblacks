<?php

namespace App\Http\Controllers;

use App\Client;
use App\Exports\ClientsExport;
use App\Mail\SendMailUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    /**
     * Display a listing of the clients.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderBy('name')->paginate(10);

        return view('clients.index',compact('clients'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new client.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created client in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // If is a XML import
        if (!empty($request->files->get('file'))) {
            $clients = simplexml_load_file($request->files->get('file'));
            $clients = json_decode(json_encode((array) $clients), true);
            $countCreated = 0;
            $countUpdated = 0;

            foreach ($clients['torcedor'] as $client) {
                $arrReplace = [
                    'name' => $client['@attributes']['nome'],
                    'document' => $client['@attributes']['documento'],
                    'postcode' => $client['@attributes']['cep'],
                    'address' => $client['@attributes']['endereco'],
                    'district' => $client['@attributes']['bairro'],
                    'city' => $client['@attributes']['cidade'],
                    'state' => $client['@attributes']['uf'],
                    'telephone' => $client['@attributes']['telefone'],
                    'email' => $client['@attributes']['email'],
                    'active' => $client['@attributes']['ativo'] ? 1 : 0,
                ];
                // Verify if document is unique to save only different data
                $find = Client::where('document', '=', $client['@attributes']['documento'])->first();
                if (!empty($find)) {
                    $countUpdated++;

                    $arrReplace['id'] = $find->id;
                } else {
                    $countCreated++;
                }
                $request->replace($arrReplace);

                $request->validate([
                    'name' => 'required',
                    'document' => 'required',
                    'postcode' => 'required',
                    'address' => 'required',
                    'district' => 'required',
                    'city' => 'required',
                    'state' => 'required'
                ]);
                Client::updated($request->all());

                $msg = $countCreated . ' torcedor(es) criado(s) e ' . $countUpdated . ' atualizado(s) com sucesso.';
            }
        } else {
            $request->validate([
                'name' => 'required',
                'document' => 'required|unique:clients',
                'postcode' => 'required',
                'address' => 'required',
                'district' => 'required',
                'city' => 'required',
                'state' => 'required'
            ]);
            Client::create($request->all());
            $msg = 'Torcedor criado com sucesso.';
        }

        return redirect()->route('clients.index')->with('success', $msg);
    }

    /**
     * Display the specified client.
     *
     * @param  \App\Client  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('clients.show',compact('client'));
    }

    /**
     * Show the form for editing the specified client.
     *
     * @param  \App\Client  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit',compact('client'));
    }

    /**
     * Update the specified client in storage.
     *
     * @param Request $request
     * @param Client $client
     * @return $this
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
            'document' => 'required',
            'postcode' => 'required',
            'address' => 'required',
            'district' => 'required',
            'city' => 'required',
            'state' => 'required'
        ]);
        $client->update($request->all());

        return redirect()->route('clients.index')
            ->with('success', 'Torcedor alterado com sucesso.');
    }

    /**
     * Remove the specified client from storage.
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
     * Show the form for import a XML.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function import()
    {
        return view('clients.import');
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

    /**
     * Show the form for creating a new mail.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mail()
    {
        return view('clients.mail');
    }

    /**
     * Send a mail to all active clients.
     *
     * @param Request $request
     * @return $this
     */
    public function send(Request $request)
    {
        $clients = Client::where('active', '=', 1)->get();
        $arrTo = [];
        foreach ($clients as $client) {
            $arrTo[] = $client->email;
        }

        Mail::bcc($arrTo)->send(new SendMailUser($request));

        return redirect()->route('clients.index')->with('success',
            'Comunicado enviado para todos os torcedores ativos.');
    }
}
