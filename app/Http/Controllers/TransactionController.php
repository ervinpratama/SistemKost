<?php

namespace App\Http\Controllers;

use Auth;
use Alert;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use DB;
use App\Exports\TransactionExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
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
            $transactions = Transaction::getDataDesc();
            if ($filters === 'accept'){
                $transactions = $transactions->where('status', 'accept');
            }if($filters === 'pending'){
                $transactions = $transactions->where('status', 'pending');
            }
        } else {
            $customer = Customer::select('id')->where('user_id', Auth::user()->id)->first();
            $transactions = Transaction::getDataByCustomerDesc($customer->id);
            if ($filters === 'accept'){
                $transactions = $transactions->where('status', 'accept');
            }if($filters === 'pending'){
                $transactions = $transactions->where('status', 'pending');
            }
        }
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::getDataActiveCustomer();
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        return view('transactions.create', compact('customers', 'customer'));
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
            'month' => 'required',
            'total' => 'required',
        ]);

        if (Auth::user()->role == 'customer') {
            $validator = Validator::make($request->all(), [
                'evidence' => 'required',
            ]);
        }
    
        if ($validator->fails()) {
            Alert::toast($validator->messages()->all()[0], 'error');
            return redirect()->back()->withInput();
        }

        $id = Transaction::store($request);
        TransactionDetail::store($request, $id);
        Alert::toast('Transaksi baru berhasil dibuat.', 'success');
        return redirect()->route('transactions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $countMonth = TransactionDetail::countByTransaction($transaction->id);
        return view('transactions.detail', compact('transaction', 'countMonth'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $customers = Customer::getDataActiveCustomer();
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        $details = TransactionDetail::where('transaction_id', $transaction->id)->get();
        return view('transactions.edit', compact('transaction', 'customers', 'customer', 'details'));
    }

    public function updateStatus(Transaction $transaction)
    {
        Transaction::updateStatus($transaction);
        Alert::toast('Status transaksi berhasil diperbarui.', 'success');
        return redirect()->route('transactions.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'month' => 'required',
            'total' => 'required',
        ]);
    
        if ($validator->fails()) {
            Alert::toast($validator->messages()->all()[0], 'error');
            return redirect()->back()->withInput();
        }
        Transaction::edit($request, $transaction);
        TransactionDetail::destroyByTransaction($transaction->id);
        TransactionDetail::store($request, $transaction->id);
        Alert::toast('Transaksi berhasil diperbarui.', 'success');
        return redirect()->route('transactions.index');
    }

    // public function exportexcel(){
    //     return Excel::download(new TransactionExport, 'Transaction.csv');
    // }

    public function exportexcel(Request $request)
{
    // $transaction = DB::table("transactions")->select('evidence')->get();
    // return $transaction;

   $fileName = 'transaction.csv';
   $transaction = Transaction::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Customer_Id', 'Payment_Method', 'Total' , 'Description', 'Evidence' , 'Start Date', 'Update Date');

        $callback = function() use($transaction, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($transaction as $task) {
                $row['Customer_Id']  = $task->customer_id;
                $row['Payment_Method']    = $task->payment_method;
                $row['Total']    = $task->total;
                $row['Description']    = $task->description;
                // $row['Evidence']    = file_get_contents('storage/'. $task->evidence);
                $row['Evidence']    = $task->evidence;
                $row['Start Date']  = $task->created_at;
                $row['Update Date']  = $task->updated_at;

                fputcsv($file, array($row['Customer_Id'], $row['Payment_Method'], $row['Total'] , $row['Description'], $row['Evidence'] , $row['Start Date'], $row['Update Date']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
