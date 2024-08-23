@extends('layouts.app')

@section('content')

@if(session()->has('message'))
    <div id="message_success" class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
<h3>Customer Detaills</h3>
<br>

    <div class="form-row">
      <div class="col-md-4 mb-3">
        <label for="validationServer01">Name</label>
        <span class="form-control is-valid "> {{$inquiryId->customer_name}} </span>

    </div>

      <div class="col-md-4 mb-3">
        <label for="validationServer02">Phone</label>
        <span type="text"  class="form-control is-valid">{{$inquiryId->phone}}</span>
      </div>

      <div class="col-md-4 mb-3">
        <label for="validationServer02">National Id</label>
        <span class="form-control is-valid">{{$inquiryId->national_id}} </span>
    </div>


      <div class="col-md-4 mb-3">
        <label for="validationServer02">Start Date</label>
        <span  class="form-control is-valid">{{$inquiryId->date_in}}</span>
      </div>

      <div class="col-md-4 mb-3">
        <label for="validationServer02">Pending Date</label>
        <span class="form-control is-valid">{{$inquiryId->date_pending}} </span>
      </div>


      <div class="col-md-4 mb-3">
        <label for="validationServer02">Out Date</label>
        <spant class="form-control is-valid">{{$inquiryId->date_out}} </spant>
      </div>


      <div class="col-md-3 mb-3">
        <label for="validationServer04">Code</label>
        <div class="form-control is-valid">
            <span >{{$inquiryId->code}}</span>

        </div>

      </div>

      <div class="col-md-3 mb-3">
          <label for="validationServer05">Inquiry Type</label>
          <div class="form-control is-valid"  >
              <span>{{$inquiryId->inquiry_type}}</span>

        </div>
      </div>


      <div class="col-md-3 mb-3">
        <label for="validationServer05">Address</label>
        <span class="form-control is-valid">{{$inquiryId->address}}</span>
      </div>


        <div class="col-md-2 mb-3">
          <label for="validationServer03">City</label>
          <div class="form-control is-valid"  >
              <span>{{$inquiryId->city}}</span>
            </div>
        </div>

    </div>

    <div class="form-group">
        <label for="recipient-name" class="col-form-label">Status</label>
        <div class="form-control is-valid">
            <span >{{$inquiryId->status}}</span>
      </div>

    </div>



    <div class="form-group">

        <label  for="validationServer01">Reason</label>
        <div class="form-control is-valid">{{$inquiryId->reason}}</div>

    </div>

          <div class="form-group mt-3">
              <a href="{{url('/')}}" class="btn btn-primary">Back</a>
          </div>
          <br>
    </div>


</div>
@endsection

