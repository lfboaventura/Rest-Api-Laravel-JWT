<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Validator;

class InvoiceController extends Controller
{
    private $invoice;
    private $user;

    public function __construct(Invoice $invoice)
    {
        $this->invoice  = $invoice;
        $this->user     = auth([])->user();
        $this->url      = URL::current();
    }

    public function create(Request $request)
    {
        $data           = $request->only('due','status');
        $data['due']    = date('d-m-Y H:i:s', strtotime($data['due'])); 

        $validator = Validator::make($data, [
            'due'       => 'required|date',
            'status'    => [
                'required',
                Rule::in( array_keys($this->invoice->arrayStatus())),
            ],
        ]);

        if ( $validator->fails())
        {
            return response()->json(['errors' => $validator->errors()],422);
        }

        try {
            $invoice = Invoice::create([
                'status'    => $data['status'],
                'due'       => $data['due'],
                'url'       => $this->generateUrlInvoice(),
                'user_id'   => $this->user->id,
            ]);

            return response()->json([
                'message' => 'Successfully registered',
                'invoice' => $invoice
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getPrevious(),
            ], 422);
        }
    }

        public function invoices()
    {
        return response()->json($this->invoice->with('user')->where('user_id', $this->user->id)->paginate(5));
    }

    public function getByUrl($url)
    {
        return $this->edit($this->invoice->with('user')->where('user_id', $this->user->id)->where('url', ( $this->url ) )->first());
    }
    
    public function getById($id)
    {
        return $this->edit($this->invoice->with('user')->where('user_id', $this->user->id)->where('id', $id)->first());
    }
    
    public function edit($invoice)
    {    
        if ( empty($invoice) )
        {
            return response()->json([
                'error' => 'invoice not found',
            ], 404);
        }

        return response()->json($invoice);
    }

    public function destroyByUrl($url)
    {
        return $this->destroy($this->invoice->with('user')->where('user_id', $this->user->id)->where('url', ( $this->url ) )->first());
    }
    
    public function destroyById($id)
    {
        return $this->destroy($this->invoice->with('user')->where('user_id', $this->user->id)->where('id', $id)->first());
    }

    public function destroy($invoice)
    {
        if ( empty($invoice) )
        {
            return response()->json([
                'error' => 'invoice not found',
            ], 404);
        }

        try {
            $invoice->delete();

            return response()->json([
                'message' => 'Successfully deleted',
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getPrevious(),
            ], 422);
        }
        
    }

    public function update(Request $request, $id)
    {
        $data           = $request->only('due','status');
        $data['due']    = date('d-m-Y H:i:s', strtotime($data['due'])); 

        $validator = Validator::make($data, [
            'due'       => 'required|date',
            'status'    => [
                'required',
                Rule::in( array_keys($this->invoice->arrayStatus())),
            ],
        ]);

        if ( $validator->fails())
        {
            return response()->json(['errors' => $validator->errors()],422);
        }

        $invoice = $this->invoice->where('user_id', $this->user->id)->where('id', $id)->first();
        if ( empty($invoice) )
        {
            return response()->json([
                'error' => 'invoice not found',
            ], 404);
        }

        try {
            $invoice->update([
                'status'    => $data['status'],
                'due'       => $data['due'],
            ]);

            return response()->json([
                'message' => 'Successfully updated',
                'invoice' => $invoice
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getPrevious(),
            ], 422);
        }
    }

    public function generateRandomString($length = 50) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    public function generateUrlInvoice()
    {
        while ( true ) {
            $url = $this->url . '/' . $this->generateRandomString();
            if ( empty($this->invoice->where('url',$url)->first()) ){
                break;
            }
        }
        return $url;
    }





}
