<?php

namespace App\Http\Controllers;
use App\Models\Branch;
use App\Models\Transaction;
use Illuminate\Http\Request;
class TransactionController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => ""], ['name' => "Transaction List"]];
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $QUERY      = Transaction::Query();
        $search_status  =  0;
        if($request->get('status')!=''){
            $QUERY=$QUERY->where('status',$request->get('status'));
            $search_status  =  1;
        }
        if($request->get('transaction_type')!=''){
            $QUERY=$QUERY->where('transaction_type',$request->get('transaction_type'));
            $search_status  =  1;
        }
        if($request->get('type')!=''){
            $QUERY=$QUERY->where('type',$request->get('type'));
            $search_status  =  1;
        }
        if($request->get('from')!=''||$request->get('to')!=''){
            if($request->get('from')!='')
                $from   =   date("Y-m-d",strtotime(str_replace('/', '-',$request->get('from'))));
            else
                $from = date("Y-m-d",strtotime(str_replace('/', '-',$request->get('to'))));
            $to     =   $request->get('to');
            if($to=='')
                $to = date("Y-m-d",strtotime(str_replace('/', '-',$request->get('from'))));
            else
                $to = date("Y-m-d",strtotime(str_replace('/', '-',$request->get('to'))));
            $QUERY=$QUERY->whereBetween('date', [$from, $to]);
            $search_status  =  1;
        }
        $data['search_status']  = $search_status;
        $data['transactions']   = $QUERY->where('isDeleted',0)->orderBy('id','desc')->get();
        $data['status']         = $request->get('status');
        $data['type']           = $request->get('type');
        $data['from']           = $request->get('from');
        $data['to']             = $request->get('to');
        $data['pageConfigs']    = $pageConfigs;
        $data['breadcrumbs']    = $breadcrumbs;
        return view('transaction.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "
            ", 'name' => "Transaction"], ['name' => "Add Transaction"]];

        //Pageheader set true for breadcrumbs
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false
        ];
        $data['pageConfigs'] = $pageConfigs;
        $data['breadcrumbs'] = $breadcrumbs;
        //print_r($data['categories']);exit();
        $data['branches']    = Branch::orderBy('id')->pluck('name','id');
        return view('transaction.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $transaction             = new Transaction;
        $transaction->amount     = $request->amount;
        $transaction->date       = date("Y-m-d",strtotime(str_replace('/', '-',$request->date)));
        $transaction->type       = $request->type;
        $transaction->status     = $request->status;
        $transaction->note       = $request->note;
        $transaction->branch_id  = $request->branch_id;
        if($request->type=='debit')
            $transaction->transaction_type  = $request->transaction_type_debit;
        else
            $transaction->transaction_type  = $request->transaction_type_credit;
        $transaction->save();
        return redirect('transaction')->withSuccess('Transaction Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction,$id)
    {
        $breadcrumbs = [
            ['link' => "modern", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Transaction"], ['name' => "Transaction List"]];
        $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $data['pageConfigs'] = $pageConfigs;
        $data['breadcrumbs'] = $breadcrumbs;
        $data['transaction'] = Transaction::find($id);
        $data['branches']    = Branch::orderBy('id')->pluck('name','id');
        return view('transaction.add', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction,$id)
    {
        $transaction             = new Transaction;
        $transaction->exists     = true;
        $transaction->id         = $request->id;
        $transaction->amount     = $request->amount;
        $transaction->date       = date("Y-m-d",strtotime(str_replace('/', '-',$request->date)));
        $transaction->type       = $request->type;
        $transaction->status     = $request->status;
        $transaction->note       = $request->note;
        $transaction->branch_id  = $request->branch_id;
        if($request->type=='debit')
            $transaction->transaction_type  = $request->transaction_type_debit;
        else
            $transaction->transaction_type  = $request->transaction_type_credit;
        $transaction->save();
        return redirect('transaction')->withSuccess('Transaction Updated Successfully.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction,$id)
    {
        Transaction::where('id',$id)->update(array('isDeleted'=>1));
        return redirect('transaction')->withSuccess('Transaction Deleted Successfully.');;
    }
}
