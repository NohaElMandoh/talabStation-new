<?php

namespace App\Http\Controllers\merchant;


use App\Events\TicketEvent;
use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Ticket;
use App\User;
use Auth;
use Illuminate\Http\Request;

use Response;

class TicketController extends Controller
{
    //
    public function index()
    {
        $tickets = Auth::user()->tickets()->paginate(20);
        return view('merchant.tickets.index', compact('tickets'));
    }

    public function create()
    {
      return view('merchant.tickets.create');
    }

    public function store(Request $request)
    {
        $validateData= [
            'content' => 'required',
            'type' => 'required',
          
        ];
        $valid = validator($request->all(), $validateData);

        if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);

            $item = Auth::user()->tickets()->create($request->all());
        $this->sendOrderNotification('create order ', $item);


        return response()->json(['success' => true, 'message' => 'تمت الاضافة بنجاح']);
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);

        return view('merchant.tickets.show', compact('ticket'));
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);

        return view('merchant.tickets.edit', compact('ticket'));
    }

    public function update(Request $request, $ticket_id)
    {

        $validateData= [
            'content' => 'required',
            'type' => 'required',
        
        ];
        $valid = validator($request->all(), $validateData);

        if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);


        $ticket = Ticket::findOrFail($ticket_id);
        $ticket->update($request->all());
        

        return response()->json(['success' => true, 'message' => 'تمت التعديل بنجاح']);

    }

    // public function destroy($item_id)
    // {
    //     // to do
    //     // delete addons and options
    //     $item = Item::findOrFail($item_id);
    //     $item->delete();
    //     return response()->json(['success' => true, 'message' => 'تم الحذف بنجاح']);
    // }

    public function sendOrderNotification($mg1, $ticket)
    {

        $text = Auth()->user()->name . " {$mg1}";

        $admin = User::where('email', 'admin@admin.com')->get();
        // $collection1 = collect($admin);
        // $client_notify = Client::where('id', $client->id)->get();
        // $merged = $collection1->merge($client_notify);
        // $merged_all = $merged->all();
        event(new TicketEvent($ticket, $text, $admin));

    }

}
