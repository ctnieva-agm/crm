<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreLead;
use App\Salesperson;
use App\Product;
use App\Lead;
use App\Http\Resources\Lead as LeadResource;
use App\Http\Requests\StoreRemark;
use App\LeadsRemark;
use Illuminate\Support\Str;

class LeadController extends Controller
{

    public function index()
    {
        $salespersons = Salesperson::all();
        $products = Product::all();
        return view('leads.index', compact('salespersons', 'products'));
    }

    public function store(StoreLead $request)
    {
        $input = $request->validated();
        $input['entry_date'] = date('Y-m-d H:i:s');
        $input['trash'] = 'no';
        $lead = Lead::create($input);
        return ["msg" => 'Success, data saved.'];
    }

    public function allLeads() {
        $leads = Lead::notTrashed()->latest('id')->get();
        $collection = LeadResource::collection($leads);
        return $collection;
    }

    public function update(StoreLead $request, Lead $lead)
    {
        $lead->sales_id     = $request->sales_id;
        $lead->client_name  = $request->client_name;
        $lead->company_name = $request->company_name;
        $lead->source       = $request->source;
        $lead->product_id   = $request->product_id;
        $lead->add_ons      = $request->add_ons;
        $lead->deal_amount  = $request->deal_amount;
        $lead->stage        = $request->stage;
        $lead->actual_close_date    = $request->actual_close_date;
        $lead->closed_amount        = $request->closed_amount;
        $lead->expected_close_date  = $request->expected_close_date;
        $lead->customer_type        = $request->customer_type;
        $lead->potential_competitor = $request->potential_competitor;
        $lead->lose_notes           = $request->lose_notes;
        $lead->extra_notes          = $request->extra_notes;
        $lead->update();
        return ["msg" => 'Success, changes saved.'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        $lead->trash = 'yes';
        $lead->trash_date = date("Y-m-d H:i:s");
        $lead->update();
        return ["msg" => 'Success, lead deleted.'];
    }

    public function remarks(Lead $lead) {
        $data = $lead->remarks;
        return $data;
    }

    public function remarkStore(StoreRemark $request, $id) {
        $input = $request->validated();
        $status = Str::snake($input['status']);
        $input['leads_id'] = $id;
        $input[$status] = date('Y-m-d H:i:s');

        LeadsRemark::create($input);
        return ["msg" => 'Success, data saved.'];
    }
}
