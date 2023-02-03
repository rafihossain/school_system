@extends('backend.layouts.app')
@section('title', 'Calendar')
 

@section('content')
 

@if(Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
</div>
@endif

<div class="card">
    <div class="card-body">
        <div class="row row-deck row-cards justify-content-center">
            <div class="col-12"> 
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic" type="button" role="tab" aria-controls="basic" aria-selected="true">Basic</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="system-tab" data-bs-toggle="tab" data-bs-target="#system" type="button" role="tab" aria-controls="system" aria-selected="false">System</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment" type="button" role="tab" aria-controls="payment" aria-selected="false">Payment</button>
                    </li>
                    
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab"> 
                    
                        <form action="{{ route('backend.basic-form-serialize') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $setting_basic->id }}">

                            <div class="row justify-content-center">
                                <div class="col-xl-6">
                                    <div class="form-group mb-3 row">
                                        <label for="name" class="form-label col-md-3 col-form-label">App Name</label>
                                        <div class="col-md-9">
                                            <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $setting_basic->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label for="name" class="form-label col-md-3 col-form-label">App Short Name</label>
                                        <div class="col-md-9">
                                            <input type="text" name="short_name" placeholder="short_name" class="form-control" value="{{ $setting_basic->short_name }}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label for="email" class="form-label col-md-3 col-form-label">Email</label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="Email" name="email" class="form-control" value="{{ $setting_basic->short_name }}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label for="phone" class="form-label col-md-3 col-form-label">Phone</label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="Phone" name="phone" class="form-control" value="{{ $setting_basic->short_name }}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label for="email" class="form-label col-md-3 col-form-label">Address</label>
                                        <div class="col-md-9">
                                            <textarea rows="8" name="adddress" class="form-control">{{ $setting_basic->short_name }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-xl-4">
                                    <div class="form-group row">
                                        <label class="form-label col-md-3 col-form-label">Favicon</label>
                                        <div class="col-md-9">
                                            <input type="file" name="favicon" class="dropify" data-default-file="{{ asset('/images/settings/basic/'.$setting_basic->favicon) }}" accept="image/png, image/ico">
                                        </div>
                                    </div>
                                    <div class="form-group my-4 row">
                                        <label class="form-label col-md-3 col-form-label">Logo</label>
                                        <div class="col-md-9">
                                            <input type="file" class="dropify" name="logo" data-default-file="{{ asset('/images/settings/basic/'.$setting_basic->logo) }}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label class="form-label col-md-3 col-form-label">Dark Mode Logo</label>
                                        <div class="col-md-9">
                                            <input type="file" class="dropify" name="dark_mode_logo" data-default-file="{{ asset('/images/settings/basic/'.$setting_basic->dark_mode_logo) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary ">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form> 
                        
                    </div>
                    <div class="tab-pane fade" id="system" role="tabpanel" aria-labelledby="system-tab"> 
                        <form action="{{ route('backend.system-form-serialize') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $system_system->id }}">

                            
                            <div class="card">
                                <div class="card-header"> 
                                    <h4 class="card-title mb-0">Class Routine</h4> 
                                </div>
                                <div class="card-body"> 
                                    <div class="row justify-content-center">
                                        <div class="form-group mb-3 row">
                                            <div class="col-md-12">
                                                <label class="form-label"></label>
                                                <select id="time_diff" name="time_diff" class="form-control mb-0">
                                                    <option disabled="disabled" class="d-none">select_time</option>
                                                    <option value="10" {{ $system_system->time_diff == 10 ? 'selected': '' }} >10</option>
                                                    <option value="20" {{ $system_system->time_diff == 20 ? 'selected': '' }} >20</option>
                                                    <option value="30" {{ $system_system->time_diff == 30 ? 'selected': '' }} >30</option>
                                                    <option value="40" {{ $system_system->time_diff == 40 ? 'selected': '' }} >40</option>
                                                    <option value="50" {{ $system_system->time_diff == 50 ? 'selected': '' }} >50</option>
                                                    <option value="60" {{ $system_system->time_diff == 60 ? 'selected': '' }} >60</option>
                                                </select>
                                            </div>
                                            <div class="col-6 mt-4">
                                                <div>
                                                    <label class="form-label">Class Start Time</label>
                                                    <input type="time" name="start_time" class="form-control" 
                                                    value="{{ $system_system->start_time }}">
                                                </div>
                                            </div>
                                            <div class="col-6 mt-4">
                                                
                                                <label class="form-label">Class End Time</label>
                                                <input type="time" name="end_time" class="form-control"
                                                    value="{{ $system_system->end_time }}">
                                                
                                            </div>
                                            <div class="col-12 mt-4">
                                                <button type="submit" class="lang-btn btn btn-primary ">Update</button>
                                            </div>
                                        </div> 
                                    </div> 
                                    
                                </div>
                            </div>
                                
                            
                        </form>  
                    </div>
                    <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                         
                        <div id="website" class="tab-pane active show">
                            <div class="row justify-content-center">
                                <div class="col-xl-6 mb-3">
                                    <form action="{{ route('backend.paypal-payment-form') }}" method="POST">
                                        @csrf
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title  mb-0">Paypal Setting</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group mb-3 row">
                                                    <label for="name" class="form-label col-md-3 col-form-label">Live Mode</label>
                                                    <div class="col-md-9">
                                                        <label class="form-check form-switch">
                                                            <input type="hidden" name="live_mode"value="0">
                                                            <input type="checkbox" name="live_mode" class="form-check-input h-20 w-40" 
                                                            value="1" {{ $paypal->live_mode == 1 ? 'checked' : '' }} >
                                                        </label>
                                                    </div>
                                                </div>
                                                
                                                <input type="hidden" name="status" value="1">

                                                <div class="form-group mb-3 row">
                                                    <label for="name" class="form-label col-md-3 col-form-label">Publisher Key</label>
                                                    <div class="col-md-9">
                                                        <div>
                                                            <input type="text" name="paypal_key" placeholder="Enter paypal key" class="form-control" value="{{ $paypal->publisher_key }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label for="name" class="form-label col-md-3 col-form-label">Secret Key</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="paypal_secret" placeholder="Enter paypal secret" class="form-control" value="{{ $paypal->secret_key }}">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <div class="col offset-3">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-xl-6 mb-3">
                                    <form action="{{ route('backend.stripe-payment-form') }}" method="POST">
                                        @csrf
                                        <div class="card">
                                            <div class="card-header"> 
                                                <h4 class="card-title  mb-0">Stripe Setting</h4> 
                                            </div>
                                            <input type="hidden" name="status" value="2">

                                            <div class="card-body">
                                                <div class="form-group mb-3 row">
                                                    <label for="name" class="form-label col-md-3 col-form-label">Publisher Key</label>
                                                    <div class="col-md-9">
                                                        <div>
                                                            <input type="text" name="stripe_key" placeholder="Enter stripe key" class="form-control" value="{{ $stripe->publisher_key }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label for="name" class="form-label col-md-3 col-form-label">Secret Key</label>
                                                    <div class="col-md-9">
                                                        <div>
                                                            <input type="text" name="stripe_secret" placeholder="Enter stripe secret" class="form-control" value="{{ $stripe->secret_key }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <div class="col offset-3">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-xl-6 mb-3">
                                    <form action="{{ route('backend.razorpay-payment-form') }}" method="POST">
                                        @csrf
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title  mb-0">Razorpay Setting</h4>
                                            </div>
                                            <input type="hidden" name="status" value="3">

                                            <div class="card-body">
                                                <div class="form-group mb-3 row">
                                                    <label for="name" class="form-label col-md-3 col-form-label">Publisher Key</label>
                                                    <div class="col-md-9">
                                                        <div>
                                                            <input type="text" name="razorpay_key" placeholder="Enter razorpay key" class="form-control" value="{{ $razorpay->publisher_key }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label for="name" class="form-label col-md-3 col-form-label">Secret Key</label>
                                                    <div class="col-md-9">
                                                        <div>
                                                            <input type="text" name="razorpay_secret" placeholder="Enter razorpay secret" class="form-control" value="{{ $razorpay->secret_key }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <div class="col offset-3">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-xl-6 mb-3">
                                    <form action="{{ route('backend.paystack-payment-form') }}" method="POST">
                                        @csrf
                                        <div class="card">
                                            <div class="card-header"> 
                                                <h4 class="card-title mb-0">Paystack Setting</h4>
                                            </div>
                                            
                                            <input type="hidden" name="status" value="4">

                                            <div class="card-body">
                                                <div class="form-group mb-3 row">
                                                    <label for="name" class="form-label col-md-3 col-form-label">Publisher Key</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="paystack_key" placeholder="Enter paystack key" class="form-control" value="{{ $paystack->publisher_key }}">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label for="name" class="form-label col-md-3 col-form-label">Secret Key</label>
                                                    <div class="col-md-9">
                                                        <div>
                                                            <input type="text" name="paystack_secret" placeholder="Enter paystack secret" class="form-control" value="{{ $paystack->secret_key }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label for="name" class="form-label col-md-3 col-form-label">Merchant Email</label>
                                                    <div class="col-md-9">
                                                        <div>
                                                            <input type="text" name="paystack_email" placeholder="Enter paystack email" class="form-control" value="{{ $paystack->merchant_email }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <div class="col offset-3">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                            
                    </div>
                    
                </div> 
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $('.dropify').dropify();

    //routin-preview
    // $('#basicBtn').click(function(e) {

    //     var basicForm = new FormData(document.getElementById('basicForm'));
    //     // console.log(basicForm);
    //     $.ajax({
    //         url: "{{ route('backend.basic-form-serialize') }}",
    //         type: "POST",
    //         data: basicForm,
    //         cache:false,
    //         contentType: false,
    //         processData: false,
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         success: function(reponse) {

    //         }
    //     });

    // });
</script>
@endsection