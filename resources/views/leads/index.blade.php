@extends('layouts.master')
@section('title', 'CRM - Leads')
@section('main')
    <style>
        .spinner {
            text-align: center;
        }

        .spinner > div {
        width: 18px;
        height: 18px;
        background-color: #333;

        border-radius: 100%;
        display: inline-block;
        -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
        animation: sk-bouncedelay 1.4s infinite ease-in-out both;
        }

        .spinner .bounce1 {
        -webkit-animation-delay: -0.32s;
        animation-delay: -0.32s;
        }

        .spinner .bounce2 {
        -webkit-animation-delay: -0.16s;
        animation-delay: -0.16s;
        }

        @-webkit-keyframes sk-bouncedelay {
        0%, 80%, 100% { -webkit-transform: scale(0) }
        40% { -webkit-transform: scale(1.0) }
        }

        @keyframes sk-bouncedelay {
        0%, 80%, 100% { 
            -webkit-transform: scale(0);
            transform: scale(0);
        } 40% { 
            -webkit-transform: scale(1.0);
            transform: scale(1.0);
        }
        }
    </style>
    <div class="row mt-5 py-5">
        <div class="col-md-10 mx-auto">
            <button class="btn btn-primary mb-2" type="button" id="btn-add-lead">
                <span class="fa fa-plus"></span>
                Add Leads
            </button>
            <table class="table table-bordered" id="leads-table">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Source</th>
                        <th>Product</th>
                        <th>Deal Amount</th>
                        <th>Stage</th>
                        <th>Tools</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="modal fade" role="dialog" aria-hidden="true" id="lead-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title"><span class="mode">Add</span> Lead Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="lead-form" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="text-primary" for="sales_id">Salesperson</label>
                                <select type="text" class="form-control" id="sales_id" name="sales_id" required>
                                    <option value="" class="text-secondary">-Select Salesperson-</option>
                                    @foreach ($salespersons as $salesperson)
                                    <option value="{{ $salesperson->id }}">{{ $salesperson->name .' - '. $salesperson->position }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="text-primary" for="stage">Stage</label>
                                <select type="text" class="form-control" id="stage" name="stage" required>
                                    <option value="" class="text-secondary">-Select Stage-</option>
                                    <option value="initial_contact">Initial Contact</option>
                                    <option value="qualifying_lead">Qualifying Lead</option>
                                    <option value="proposal">Proposal</option>
                                    <option value="negotiating">Negotiating</option>
                                    <option value="win">Win</option>
                                    <option value="delivery">Delivery</option>
                                    <option value="lost">Lose</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="text-primary" for="client_name">Client</label>
                                <input type="text" class="form-control" id="client_name" name="client_name"
                                    placeholder="Client" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="text-primary" for="company_name">Company</label>
                                <input type="text" class="form-control" id="company_name" name="company_name"
                                placeholder="Company" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="text-primary" for="deal_amount">Deal Amount</label>
                                <input type="number" class="form-control" id="deal_amount" name="deal_amount"
                                    placeholder="Deal Amount" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="text-primary" for="expected_close_date">Expected close date</label>
                                <input type="date" class="form-control" id="expected_close_date" name="expected_close_date" required>
                            </div>
                        </div>
                        <div class="form-row" lead-stage="win" style="display: none">
                            <div class="form-group col-md-6">
                                <label class="text-primary" for="closed_amount">Closed Amount</label>
                                <input type="number" class="form-control" id="closed_amount" name="closed_amount"
                                    placeholder="Closed Amount" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="text-primary" for="actual_close_date">Actual close date</label>
                                <input type="date" class="form-control" id="actual_close_date" name="actual_close_date" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="text-primary" for="source">Source</label>
                                <input type="text" class="form-control" id="source" name="source"
                                    placeholder="Source" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="text-primary" for="customer_type">Customer Type</label>
                                <input type="text" class="form-control" id="customer_type" name="customer_type">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="text-primary" for="product_id">Product</label>
                                <select class="form-control" id="product_id" name="product_id" required>
                                    <option value="" class="text-secondary">-Select Product-</option>
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->product_name  }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="text-primary" for="add_ons">Add-ons</label>
                                <textarea class="form-control" id="add_ons" name="add_ons" placeholder="Add-ons"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="text-primary" for="potential_competitor">Potential Competitor</label>
                                <textarea class="form-control" id="potential_competitor" name="potential_competitor" placeholder="Potential Competitor"></textarea>
                            </div>
                        </div>
                        <div class="form-group" lead-stage="lose" style="display: none">
                            <label class="text-primary" for="lose_notes">Lose Notes</label>
                            <textarea class="form-control" id="lose_notes" name="lose_notes" placeholder="Lose Notes"></textarea> 
                        </div>
                        <div class="form-group">
                            <label class="text-primary" for="extra_notes">Extra Notes</label>
                            <textarea class="form-control" id="extra_notes" name="extra_notes" placeholder="Extra Notes"></textarea> 
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" form="lead-form">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" aria-hidden="true" id="lead-view-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title">View Lead</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row px-4 pb-4">
                        <div class="col-md-6 border-bottom">
                            <h4 class="text-primary">
                                <strong id="company_name_txt"></strong>
                            </h4>
                            <h5>
                                <strong id="client_name_txt"></strong>
                            </h5>
                        </div>
                        <div class="col-md-6 border-bottom">
                            <p class="mb-0">
                                <small class="text-info">
                                    <strong>Entry date:</strong>
                                    <strong id="entry_date_txt" class="text-dark"></strong>
                                </small>
                            </p>
                            <p class="mb-0">
                                <small class="text-info mb-0">
                                    <strong>Stage:</strong>
                                    <span id="stage_txt" class="badge badge-dark text-light text-uppercase"></span>
                                </small>
                            </p>
                            <p class="mb-0">
                                <small class="text-info mb-0">
                                    <strong>Customer Type:</strong>
                                    <strong id="customer_type_txt" class="text-dark"></strong>
                                </small>
                            </p>
                        </div>
                    </div>
                    <div class="row px-4">
                        <div class="col">
                            <div class="row">
                                <div class="col-md-5 text-primary">
                                    <h6><strong>Salesperson:</strong></h6>
                                </div>
                                <div class="col-md-7 text-right">
                                    <h6 id="salesperson_txt"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 text-primary">
                                    <h6><strong>Source:</strong></h6>
                                </div>
                                <div class="col-md-7 text-right">
                                    <h6 id="source_txt"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 text-primary">
                                    <h6><strong>Product:</strong></h6>
                                </div>
                                <div class="col-md-7 text-right">
                                    <h6 id="product_txt"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 text-primary">
                                    <h6><strong>Deal Amount:</strong></h6>
                                </div>
                                <div class="col-md-7 text-right">
                                    <h6 id="deal_amount_txt"></h6>
                                </div>
                            </div>
                            <div class="row" show-only-if="win">
                                <div class="col-md-5 text-primary">
                                    <h6><strong>Closed Amount:</strong></h6>
                                </div>
                                <div class="col-md-7 text-right">
                                    <h6 id="close_amount_txt"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 text-primary">
                                    <h6><strong>Expected close date:</strong></h6>
                                </div>
                                <div class="col-md-7 text-right">
                                    <h6 id="expected_close_date_txt"></h6>
                                </div>
                            </div>
                            <div class="row" show-only-if="win">
                                <div class="col-md-5 text-primary">
                                    <h6><strong>Actual close date:</strong></h6>
                                </div>
                                <div class="col-md-7 text-right">
                                    <h6 id="actual_close_date_txt"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 text-primary">
                                    <h6><strong>Add-ons:</strong></h6>
                                </div>
                                <div class="col-md-7 text-right">
                                    <h6 id="add_ons_txt"></h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 text-primary">
                                    <h6><strong>Potential Competitor:</strong></h6>
                                </div>
                                <div class="col-md-7 text-right">
                                    <h6 id="potential_competitor_txt"></h6>
                                </div>
                            </div>
                            <div class="row" show-only-if="lose">
                                <div class="col-md-5 text-primary">
                                    <h6><strong>Lose Notes:</strong></h6>
                                </div>
                                <div class="col-md-7 text-right">
                                    <h6 id="lose_notes_txt"></h6>
                                </div>
                            </div>
                            <div class="row border-bottom">
                                <div class="col-md-5 text-primary">
                                    <h6><strong>Extra Notes:</strong></h6>
                                </div>
                                <div class="col-md-7 text-right">
                                    <h6 id="extra_notes_txt"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <h6 class="text-primary mt-2"><strong>Remarks:</strong></h6>
                        </div>
                        <div class="col-md-5 py-1">
                            <button class="btn btn-sm btn-success btn-block fa fa-plus" type="button" id="btn-add-remarks"></button>
                        </div>
                    </div>
                    <div class="row" style="min-height: 25px">
                        <div class="col-12 text-center spinner-div">
                            <div class="spinner">
                                <div class="bounce1"></div>
                                <div class="bounce2"></div>
                                <div class="bounce3"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="accordion" id="remarks-accordion" style="display: none;">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" aria-hidden="true" id="lead-remarks-modal" style="background-color: rgba(25, 25, 25, 0.45)">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title"><span class="mode">Add</span> Remarks</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="lead-remarks-form" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="text-primary" for="remark_title">Title</label>
                            <input type="text" class="form-control" name="title" id="remark_title" required>
                        </div>
                        <div class="form-group">
                            <label class="text-primary" for="remark_description">Lose Notes</label>
                            <textarea class="form-control" name="description" id="remark_description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label class="text-primary" for="remark_status">Status</label>
                            <select class="form-control" name="status" id="remark_status" required>
                                <option value="">-Select status-</option>
                                <option value="To be done">To be done</option>
                                <option value="Doing">Doing</option>
                                <option value="Done">Done</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" form="lead-remarks-form">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function(){
            /*  initial datatable config for #leads-table */
            let table = $('#leads-table').DataTable({
                    deferRender:    true,
                    scrollCollapse: true,
                    scroller:       true,
                    order: [],
                    columnDefs: [ {
                        targets: -1,
                        data: null,
                        defaultContent: `<button class="btn btn-outline-primary btn-view"><span class="fa fa-search"></span></button>
                                        <button class="btn btn-outline-primary btn-edit"><span class="fa fa-pen"></span></button>
                                        <button class="btn btn-outline-danger btn-delete"><span class="fa fa-trash"></span></button>
                                        `
                    } ],
            } );

            /*  initial vars for form submissions */
            let leads_uri = `{{ route("leads.all") }}`;
            let leads_submit_uri = `{{route("leads.store")}}`;
            let lead_submit_method = `POST`;

            /* inital ajax leads data for datatale of #leads-table  */
            spinnersModal(); //spinner show
            table.ajax.url( `${leads_uri}` ).load( function(res){
                /* too fast in local so I added this */
                $('#spinner-modal').on('shown.bs.modal', function(){
                    spinnersModal('hide'); //spinner hide
                })
                /* too slow in test/live so I added this */
                spinnersModal('hide'); //spinner hide
            }, true);

            /* update table data every 30 seconds */
            setInterval( function () {
                table.ajax.reload( null, false ); // user paging is not reset on reload
            }, 30000 );

            let lead_remarks_submit_uri = '';
            let lead_remarks_submit_method = 'POST';
            /* `#leads-table tbody button.btn-view` event for showing each entity's data */
            $('#leads-table tbody').on( 'click', 'button.btn-view', function () {
                let data = table.row( $(this).parents('tr') ).data();
                $('#lead-view-modal #company_name_txt').text(data.company_name);
                $('#lead-view-modal #client_name_txt').text(data.client_name);
                $('#lead-view-modal #entry_date_txt').text(date_mdY(data.entry_date));
                $('#lead-view-modal #stage_txt').text(data.stage);
                $('#lead-view-modal #customer_type_txt').text(data.customer_type);
                $('#lead-view-modal #salesperson_txt').text(data.salesperson.name);
                $('#lead-view-modal #source_txt').text(data.source);
                $('#lead-view-modal #product_txt').text(data.product);
                $('#lead-view-modal #deal_amount_txt').text(`Php ${numberWithCommas(data.deal_amount)}`);
                $('#lead-view-modal #close_amount_txt').text(`Php ${numberWithCommas(data.closed_amount)}`);
                $('#lead-view-modal #expected_close_date_txt').text(date_mdY(data.expected_close_date));
                $('#lead-view-modal #actual_close_date_txt').text(date_mdY(data.actual_close_date));
                $('#lead-view-modal #add_ons_txt').text(data.add_ons);
                $('#lead-view-modal #potential_competitor_txt').text(data.potential_competitor);
                $('#lead-view-modal #lose_notes_txt').text(data.lose_notes);
                $('#lead-view-modal #extra_notes_txt').text(data.extra_notes);

                $('[show-only-if]').hide();
                if(data.stage == 'win' || data.stage == 'delivery') {
                    $('[show-only-if="win"]').show();
                } else if(data.stage == 'lost') {
                    $('[show-only-if="lose"]').show();
                }
                $('#lead-view-modal').modal('show');
                $('.spinner-div').show();

                let lead_remarks_uri = `{{ url("leads") }}/${data.id}/remarks`;
                lead_remarks_submit_uri = lead_remarks_uri;
                $.get(lead_remarks_uri)
                    .done(function(data){
                        let content = '';
                        if (data.length > 0) {
                            $.each(data, function(i, el){
                                content += `<div class="card">
                                                <div class="card-header bg-primary px-1 py-0" data-toggle="collapse" data-target="#collapse${i}">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <h2 class="mb-0">
                                                                <button class="btn text-white remark-title" type="button" data-toggle="collapse" data-target="#collapse${i}">
                                                                    ${el.title}
                                                                </button>
                                                            </h2>
                                                        </div>
                                                        <div class="col-md-3 text-right">
                                                            <h2 class="mb-0 pt-1">
                                                                <button class="btn btn-sm text-white btn-remark-edit" type="button" value="${el.id}">
                                                                    <span class="fa fa-pen"></span>
                                                                </button>
                                                                <button class="btn btn-sm text-white btn-remark-delete" type="button" value="${el.id}">
                                                                    <span class="fa fa-trash"></span>
                                                                </button>
                                                            </h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="collapse${i}" class="collapse" data-parent="#remarks-accordion">
                                                    <div class="card-body remark-body">
                                                    ${el.description}
                                                    </div>
                                                </div>
                                            </div>`;
                            })
                        } else {
                            content = "<em>No remarks to be shown.</em>";
                        }

                        $('#remarks-accordion').html(content);
                        $('.spinner-div').slideUp(200, function(){
                            setTimeout(function(){
                                $('#remarks-accordion').slideDown('500');
                            },300);
                        })
                    })
                    .fail(function(e){
                        console.log(e);
                    });
            });

            /* show modal when button#btn-add-remarks has been clicked */
            $('#lead-view-modal button#btn-add-remarks').click(function() {
                lead_remarks_submit_method = 'POST';
                $('#lead-remarks-modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });

            /* reset form when modal is hidden */
            $('#lead-remarks-modal').on('hidden.bs.modal', function(){
                $('#lead-remarks-modal form').trigger('reset');
            })

            $('#lead-remarks-form').submit(function(){
                let form = $(this).serializeArray();
                $('#spinner-modal').off('shown.bs.modal');
                spinnersModal();
                $.ajax({
                    type: lead_remarks_submit_method,
                    url: lead_remarks_submit_uri,
                    data: form,
                    success: (data)=>{
                        toastr.success(data.msg);
                        $('#lead-remarks-modal').modal('hide');
                    },
                    error: (e)=>{
                        $('#lead-remarks-modal form').find('input, textarea, select').removeClass('border border-danger');
                        $.each(e.responseJSON.errors, function(i, el){
                            $(`#lead-remarks-modal form #${i}`).addClass('border border-danger').focus();
                            toastr.error(el);
                            return false;
                        })
                    }
                })
                return false;
            })
            
            $('#lead-view-modal').on('hidden.bs.modal', function(){
                $('#remarks-accordion').html("");
            })

            /* `#leads-table tbody button.btn-edit` event for showing/editing each entity's data */
            $('#leads-table tbody').on( 'click', 'button.btn-edit', function () {
                let data = table.row( $(this).parents('tr') ).data();
                    leads_submit_uri = `{{ url('leads')}}/${data.id}`;
                    lead_submit_method = 'PATCH';

                $('#lead-modal .mode').text('Edit');
                $('#lead-modal').modal('show');
                $('#lead-modal #sales_id').val(data.sales_id);
                $('#lead-modal #stage').val(data.stage);
                $('#lead-modal #client_name').val(data.client_name);
                $('#lead-modal #company_name').val(data.company_name);
                $('#lead-modal #deal_amount').val(data.deal_amount);
                $('#lead-modal #expected_close_date').val(data.expected_close_date);
                $('#lead-modal #source').val(data.source);
                $('#lead-modal #customer_type').val(data.customer_type);
                $('#lead-modal #product_id').val(data.product_id);
                $('#lead-modal #add_ons').val(data.add_ons);
                $('#lead-modal #potential_competitor').val(data.potential_competitor);
                $('#lead-modal #extra_notes').val(data.extra_notes);

                $('[lead-stage]').hide();
                $('[lead-stage]').find('input', 'textarea').prop('required', false);
                if(data.stage == 'win' || data.stage == 'delivery') {
                    $('[lead-stage="win"]').fadeIn();
                    $('[lead-stage="win"] input').prop('required', true);
                    $('#lead-modal #closed_amount').val(data.closed_amount);
                    $('#lead-modal #actual_close_date').val(data.actual_close_date);
                } else if(data.stage == 'lost') {
                    $('[lead-stage="lose"]').fadeIn();
                    $('[lead-stage="lose"] textarea').prop('required', true);
                    $('#lead-modal #lose_notes').val(data.lose_notes);
                }
            });

            /* `#leads-table tbody button.btn-delete` event for deleting data */
            let lead_id;
            $('#leads-table tbody').on( 'click', 'button.btn-delete', function () {
                let data = table.row( $(this).parents('tr') ).data();
                lead_id = data.id;
                $('#confirmation-modal .modal-title').text('Are you sure you want to delete this lead?');
                $('#confirmation-modal').modal({
                    backdrop : 'static',
                    keyboard : false
                });
            });

            /* confirmation click event for deleting data */
            $('#confirmation-modal button.btn-proceed').click(function(){
                let delete_lead_uri = `{{ url('leads') }}/${lead_id}`;
                $.ajax({
                    type: 'DELETE',
                    url: delete_lead_uri,
                    success: (data)=>{
                        toastr.success(data.msg);
                        table.ajax.reload( null, false ); 
                        $('#confirmation-modal').modal('hide');
                    },
                    error: (e)=>{
                        console.log(e);
                    }
                });

            })

            /* `#btn-add-lead` click event to show `#lead-modal` to add data */
            $('#btn-add-lead').click(function(){
                leads_submit_uri = `{{route("leads.store")}}`;
                lead_submit_method = 'POST';
                $('#lead-modal').find('input, textarea, select').prop('disabled', false);
                $('#lead-modal .modal-footer button').prop({'hidden' : false , 'disabled' : false, });
                $('#lead-modal .mode').text('Add');
                $('#lead-modal').modal({
                    keyboard : false,
                    backdrop : 'static',
                });
            });

            /* add/update ajax form submission event  */
            $('#lead-modal form').submit(function(){
                let form = $(this).serialize();

                $.ajax({
                    type: lead_submit_method,
                    url: leads_submit_uri,
                    data: form,
                    success: (data)=>{
                        toastr.success(data.msg);
                        table.ajax.reload( null, false ); 
                        $('#lead-modal').modal('hide');
                    },
                    error: (e)=>{
                        // console.log(e);
                        $('#lead-modal form').find('input, textarea, select').removeClass('border border-danger');
                        $.each(e.responseJSON.errors, function(i, el){
                            $(`#lead-modal form #${i}`).addClass('border border-danger').focus();
                            toastr.error(el);
                            return false;
                        })
                    }
                });
                return false;
            });

            /* an event to reset form inputs and border colors after the modal is hidden  */
            $('#lead-modal').on('hidden.bs.modal', function(e) {
                $('#lead-modal form').trigger('reset');
                $('#lead-modal form').find('textarea, input, select').removeClass('border border-danger');
            });

            /* an event to show/hide and require/unrequire specific divs and inputs after changing the `select#stage`  */
            $('#lead-modal form #stage').change(function(){
                let stage = $(this).val();
                $('[lead-stage]').hide();
                $('[lead-stage] input, [lead-stage] textarea').prop('required', false).val('');
                
                if(stage == 'win' || stage == 'delivery') {
                    $('[lead-stage="win"]').fadeIn();
                    $('[lead-stage="win"] input').prop('required', true);
                } else if(stage == 'lose') {
                    $('[lead-stage="lose"]').fadeIn();
                }
            });

        });

        function date_mdY(d) {
            if(d != null) {
                let temp = new Date(d);
                let months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                let month = months[temp.getMonth()];
                return `${month} ${temp.getDate()}, ${temp.getFullYear()}`;
            }
            return '';
        }

        function numberWithCommas(x) {
            if(x!=null)
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return "";
        }

    </script>
@endsection