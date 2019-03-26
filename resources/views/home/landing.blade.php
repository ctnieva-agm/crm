@extends('layouts.master')

@section('main')
    @component('layouts.sidenav')
        @slot('source', isset($source) ? $source : "<none>")
        @slot('content')
            <div class="col-md-9 ml-sm-auto col-lg-10 px-4 py-5 mt-5">
                <div class="row">
                    <div class="col-12 border-primary border text-right p-2">
                        <button type="button" class="btn btn-outline-primary btn-lg ml-1" id="btn-add-contact">
                            <span class="fa fa-plus"></span> Add Contacts
                        </button>
                        <button type="button" class="btn btn-outline-primary btn-lg ml-1" id="btn-import-contact">
                            <span class="fa fa-upload"></span> Import Contacts
                        </button>
                        <button type="button" class="btn btn-outline-primary btn-lg ml-1">
                            <span class="fa fa-download"></span> Export Template
                        </button>
                        <button type="button" class="btn btn-outline-primary btn-lg ml-1">
                            <span class="fa fa-sync-alt"></span> Synchronize
                        </button>
                    </div>
                    <div class="col-12 px-0 mt-4">
                        <h3>Contact list: <span id="source-name">@isset($source) {{ $source }} @endisset</span></h3>
                        <table class="table table-bordered" id="contact-table">
                            <thead class="text-center">
                                <tr>
                                    <th>Member Vip</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Company</th>
                                    <th>Contact Number</th>
                                    <th>Date Registered</th>
                                    <th>Source</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        @endslot
        @slot('modals')
            <div class="modal fade" role="dialog" aria-hidden="true" id="import-modal">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-light">
                            <h5 class="modal-title">Import Contacts</h5>
                        </div>
                        <div class="modal-body">
                            <form id="import-form" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="file" class="form-control" id="contacts" name="contacts">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <button type="button" class="btn btn-danger btn-block"  data-dismiss="modal">Cancel</button>
                                    </div>
                                    <div class="form-group col-6">
                                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" role="dialog" aria-hidden="true" id="imported-contact-modal">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-light">
                            <h5 class="modal-title">Imported Contacts</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered" id="imported-contact-table">
                                <thead class="text-center">
                                    <tr>
                                        <th>Member Vip</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Company</th>
                                        <th>Contact Number</th>
                                        <th>Date Registered</th>
                                        <th>Source</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" role="dialog" aria-hidden="true" id="contact-modal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-light">
                            <h5 class="modal-title"><span class="mode">Add</span> Contact Form</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="contact-form">
                                @csrf
                                <div class="form-row">
                                    <div class="col border-bottom mb-3">
                                        <h5 class="text-primary">Personal Information</h5>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-7">
                                        <label class="text-primary" for="full_name">Full name</label>
                                        <input type="text" class="form-control" id="full_name"
                                            placeholder="Full name" name="full_name">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label class="text-primary" for="email">Email</label>
                                        <input type="email" class="form-control" id="email"
                                            placeholder="Email" name="email">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label class="text-primary" for="phone_number">Phone number</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                                            placeholder="Phone number">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="text-primary" for="birthday">Birth date</label>
                                        <input type="date" class="form-control" id="birthday" name="birthday"
                                            placeholder="Birth date">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="text-primary" for="gender">Gender</label>
                                        <select type="text" class="form-control" id="gender" name="gender">
                                            <option value="none">-----</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="text-primary" for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label class="text-primary" for="nationality">Nationality</label>
                                        <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Nationality">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="text-primary" for="system_id">System ID</label>
                                        <select id="system_id" name="system_id" class="form-control">
                                            <option selected>----</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="text-primary" for="source">Source</label>
                                        <input type="text" class="form-control" id="source" name="source" placeholder="Source"> 
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col border-bottom mb-3">
                                        <h5 class="text-primary">Job Information</h5>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-7">
                                        <label class="text-primary" for="company_name">Company Name</label>
                                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label class="text-primary" for="position">Position</label>
                                        <input type="text" id="position" name="position" class="form-control" placeholder="Position">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="text-primary" for="company_address">Company Address</label>
                                    <input type="text" class="form-control" id="company_address" name="company_address" placeholder="Company Address"> 
                                </div>
                                <div class="form-row">
                                    <div class="col border-bottom mb-3">
                                        <h5 class="text-primary">Other Information</h5>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label class="text-primary" for="sponsored_by">Sponsor</label>
                                        <input type="text" class="form-control" id="sponsored_by" name="sponsored_by" placeholder="Sponsor"> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="text-primary" for="notes">Notes</label>
                                    <textarea class="form-control" id="notes" name="notes" placeholder="Notes"></textarea> 
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" form="contact-form">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        @endslot
    @endcomponent
@endsection

@section('scripts')
<script>
    
    $(function(){
        let init_source = '@isset($source){{$source}}@endisset';
        const import_url = '{{ route("contact.import")}}';

        let table = $('#contact-table').DataTable({
					deferRender:    true,
					// scrollY:        200,
					scrollCollapse: true,
					scroller:       true,
					orderCellsTop: true,
					columnDefs: [ {
						targets: -1,
						data: null,
						defaultContent: `<button class="btn btn-primary"><span class="fa fa-search"></span></button>`
					} ],
        } );
                
        let imported_table = $('#imported-contact-table').DataTable({
                deferRender:    true,
                // scrollY:        200,
                scrollCollapse: true,
                scroller:       true,
                orderCellsTop: true,
                columnDefs: [ {
                    targets: -1,
                    data: null,
                    defaultContent: `<button class="btn btn-primary"><span class="fa fa-search"></span></button>`
                } ],
        } );

        if(init_source != '') {
            let init_fetch_contact_uri = `{{ route("home.source_contacts") }}?q=${init_source}`;
            spinnersModal();
            table.ajax.url( `${init_fetch_contact_uri}` ).load( function(res){
                /* too fast in local so I added this */
                $('#spinner-modal').on('shown.bs.modal', function(){
                    spinnersModal('hide');
                })
                /* too slow in test/live so I added this */
                spinnersModal('hide');
            }, true);
        }

        $('#src-list .nav-link.source').click(function(e){
            $('#spinner-modal').off('shown.bs.modal');
            spinnersModal();
            let uri = $(this).attr('href');
            let source_name = $(this).attr('source-name');
            let fetch_contact_uri = `{{ route("home.source_contacts") }}?q=${source_name}`;
            
            // removal of highlights on sources except the selected source
            $('#src-list .nav-item').removeClass('bg-info');
            $('#src-list .nav-link.source').removeClass('text-light');
            $(this).addClass('text-light');
            $(this).closest('.nav-item').addClass('bg-info');

            $('#source-name').text(source_name);
            history.pushState({source: source_name }, "uri", `${uri}`);
            
            table.ajax.url( `${fetch_contact_uri}` ).load( (res)=>{
                /* too fast in local so I added this */
                $('#spinner-modal').on('shown.bs.modal', function(){
                    spinnersModal('hide');
                })
                /* too slow in test/live so I added this */
                spinnersModal('hide');
            });
            
            e.preventDefault();
            return false;
        })

        $('#contact-table tbody').on( 'click', 'button', function () {
            let data = table.row( $(this).parents('tr') ).data();
           
            $('#contact-modal').find('input, textarea, select').prop('disabled', true);
            $('#contact-modal .modal-footer button').prop({'hidden' : true , 'disabled' : true, });

            $('#contact-modal .mode').text('View');
            $('#contact-modal #full_name').val(data.full_name);
            $('#contact-modal #email').val(data.email);
            $('#contact-modal #phone_number').val(data.phone_number);
            $('#contact-modal #birthday').val(data.birthday);
            $('#contact-modal #gender').val(data.gender);
            $('#contact-modal #address').val(data.address);
            $('#contact-modal #nationality').val(data.nationality);
            $('#contact-modal #system_id').val(data.system_id);
            $('#contact-modal #source').val(data.source);
            $('#contact-modal #company_name').val(data.company_name);
            $('#contact-modal #position').val(data.position);
            $('#contact-modal #sponsored_by').val(data.sponsored_by);
            $('#contact-modal #notes').val(data.notes);
            $('#contact-modal').modal({
                keyboard : false,
                backdrop : 'static',
            });
        });

        $('#imported-contact-table tbody').on( 'click', 'button', function () {
            let data = imported_table.row( $(this).parents('tr') ).data();

            $('#contact-modal').find('input, textarea, select').prop('disabled', true);
            $('#contact-modal .modal-footer button').prop({'hidden' : true , 'disabled' : true, });
            
            $('#contact-modal .mode').text('View');
            console.log(data);
            $('#contact-modal #full_name').val(data.full_name);
            $('#contact-modal #email').val(data.email);
            $('#contact-modal #phone_number').val(data.phone_number);
            $('#contact-modal #birthday').val(data.birthday);
            $('#contact-modal #gender').val(data.gender);
            $('#contact-modal #address').val(data.address);
            $('#contact-modal #nationality').val(data.nationality);
            $('#contact-modal #system_id').val(data.system_id);
            $('#contact-modal #source').val(data.source);
            $('#contact-modal #company_name').val(data.company_name);
            $('#contact-modal #position').val(data.position);
            $('#contact-modal #sponsored_by').val(data.sponsored_by);
            $('#contact-modal #notes').val(data.notes);
            $('#contact-modal').modal({
                keyboard : false,
                backdrop : 'static',
            });
        });

        $('#btn-add-contact').click(function(){
            $('#contact-modal').find('input, textarea, select').prop('disabled', false);
            $('#contact-modal .modal-footer button').prop({'hidden' : false , 'disabled' : false, });
            $('#contact-modal .mode').text('Add');
            $('#contact-modal').modal({
                keyboard : false,
                backdrop : 'static',
            });
        });

        $('#contact-modal').on('hidden.bs.modal', function(e){
            $('#contact-modal form').trigger('reset');
        });

        $('#contact-modal form').submit(function(){
            let form = $(this).serialize();
            $.post('{{route("contact.store")}}', form)
                .done(function(data){
                    toastr.success(data.msg);
                    setTimeout(()=> location.href = data.redirectTo, 1000);
                })
                .fail(function(e){
                    $('#contact-modal form').find('input, textarea, select').removeClass('border border-danger');
                    $.each(e.responseJSON.errors, function(i, el){
                        $(`#contact-modal form #${i}`).addClass('border border-danger').focus();
                        toastr.error(el);
                        return false;
                    })
                });
            return false;
        });

        $('#btn-import-contact').click(function(){
            $('#import-modal').modal({
                keyboard : false,
                backdrop : 'static',
            });
        });
        
        $('#import-modal').on('hidden.bs.modal', function(){
            $('#import-modal form').trigger('reset');
        });
        
        $('#import-modal #import-form').submit(function(e){
            $(this).find('button').prop('disabled', true);
            let data = new FormData(this);
            $.ajax({
                type: "POST",
                url: import_url,
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function ({msg, imported}) {
                    if(msg == 'done') {
                        toastr.success(`${imported.length} contact/s imported successfully!`)
                        imported_table.clear();
                        imported_table.rows.add(imported);
                        imported_table.draw();
                        $('#import-modal').modal('hide')
                            .on('hidden.bs.modal', function(){
                                $('#imported-contact-modal').modal('show');
                            })
                            .off('hidden.bs.modal');
                    }
                },
                error: function (e) {
                    console.log(e);
                },
                complete: (e) => {
                    $(this).find('button').prop('disabled', false);
                }
            });
            return false;
        })
    })
</script>
@endsection