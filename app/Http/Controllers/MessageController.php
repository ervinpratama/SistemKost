<?php

namespace App\Http\Controllers;

use Auth;
use Alert;
use App\Models\Message;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Exports\MessageExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->get('filter');
        if (Auth::user()->role == 'admin') {
            $messages = Message::getDataDesc();
            if ($filters === 'accept'){
                $messages = $messages->where('status', 'accept');
            }if($filters === 'pending'){
                $messages = $messages->where('status', 'pending');
            }
        } else {
            $customer = Customer::select('id')->where('user_id', Auth::user()->id)->first();
            $messages = Message::getDataByCustomerDesc($customer->id);
            if ($filters === 'accept'){
                $messages = $messages->where('status', 'accept');
            }if($filters === 'pending'){
                $messages = $messages->where('status', 'pending');
            }
        }
        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        return view('messages.create', compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'message' => 'required',
        ]);
    
        if ($validator->fails()) {
            Alert::toast($validator->messages()->all()[0], 'error');
            return redirect()->back()->withInput();
        }

        Message::store($request);
        Alert::toast('Pesan berhasil dikirim ke admin.', 'success');
        return redirect()->route('messages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        return view('messages.edit', compact('message', 'customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'message' => 'required',
        ]);
    
        if ($validator->fails()) {
            Alert::toast($validator->messages()->all()[0], 'error');
            return redirect()->back()->withInput();
        }

        Message::edit($request, $message);
        Alert::toast('Pesan berhasil diedit.', 'success');
        return redirect()->route('messages.index');
    }

    public function updateStatus(Message $message)
    {
        Message::updateStatus($message);
        Alert::toast('Status pesan berhasil diperbarui.', 'success');
        return redirect()->route('messages.index');
    }

    // public function exportexcelmessage(){
    //     return Excel::download(new MessageExport, 'Message.csv');
    // }

    public function exportexcelmessage(Request $request)
    {
   $fileName = 'Message.csv';
   $message = Message::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Customer_Id', 'Message', 'Status' , 'Start Date', 'Update Date');

        $callback = function() use($message, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($message as $task) {
                $row['Customer_Id']  = $task->customer_id;
                $row['Message']    = $task->message;
                $row['Status']    = $task->status;
                $row['Start Date']  = $task->created_at;
                $row['Update Date']  = $task->updated_at;

                fputcsv($file, array($row['Customer_Id'], $row['Message'], $row['Status'] , $row['Start Date'], $row['Update Date']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
