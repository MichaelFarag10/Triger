@extends('layouts.app')

@section('content')

@if(session()->has('message'))
    <div id="message_success" class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
@if(session()->has('error'))
    <div id="message_success" class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif
    <h3 @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif >{{__('input.CreateanewCustomer')}}</h3>
    <br>
<form method="POST" action="{{route('calls.store')}}">
    @csrf
    <div class="form-row">
      <div class="col-md-4 mb-3">
        <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="validationServer01">{{__('input.customerName')}}</label>
        <input type="text" name="customer_name" value="{{ old('customer_name') }}" class="form-control @error('customer_name') is-invalid @enderror"   autocomplete="off" placeholder="Name" required>

        @error('customer_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

      <div class="col-md-4 mb-3">
        <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="validationServer02">{{__('input.phone')}}</label>
        <input type="text"  name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror"  autocomplete="off" id="number" placeholderp ="Phone" required>

        @error('phone')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="col-md-4 mb-3">
        <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="validationServer02">{{__('input.phone2')}}</label>
        <input type="text"  name="phone2"  value="{{ old('phone2') }}" class="form-control @error('phone2') is-invalid @enderror"  autocomplete="off" id="number2" placeholder="Phone 2">

        @error('phone2')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="col-md-4 mb-3">
        <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="validationServer02">{{__('input.nationalid')}}</label>
        <input type="text" name="national_id"  value="{{ old('national_id') }}" class="form-control @error('national_id') is-invalid  @enderror" autocomplete="off" id="nationalid" placeholder="National ID" required>

        @error('national_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>


      <div class="col-md-4 mb-3">
        <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="validationServer02">{{__('input.dateIn')}}</label>
        <input type="date" name="date_in"  value="{{ old('date_in') }}"  class="form-control @error('date_in') is-invalid @enderror"  >

        @error('date_in')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
      </div>

      <div id="pending" onchange="codeshow();" class="col-md-4 mb-3">
        <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="validationServer02">{{__('input.InquiryDate')}}</label>
        <input id="pendinginput"   value="{{ old('date_pending') }}"  type="date" name="date_pending" class="form-control">
      </div>


      <div class="col-md-4 mb-3">
        <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="validationServer02">{{__('input.dateout')}}</label>
        <input type="date" name="date_out" value="{{ old('date_out') }}" class="form-control">
      </div>


      <div class="col-md-3 mb-3">
          <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="validationServer05">{{__('input.InquiryType')}}</label>
          <select id="sel" onchange="intype();addresstype();" name="inquiry_type"  class="custom-select form-control  @error('inquiry_type') is-invalid  @enderror"  >
                <option selected>Select Menu</option>

                @foreach ($inquiries as $data)
                <option value="{{$data->type}}" >{{$data->type}}</option>
                @endforeach
           </select>

            @error('inquiry_type')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
      </div>



        <div class="col-md-4 mb-3">
          <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="validationServer01">{{__('input.job')}}</label>
          <input type="text" name="job"  value="{{ old('job') }}"   class="form-control @error('job') is-invalid @enderror"   autocomplete="off" placeholder="Job" required>

          @error('job')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
      </div>


      <div class="col-md-3 mb-3">
        <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="validationServer05">{{__('input.Address')}}</label>
        <input type="text" name="address"  value="{{ old('address') }}" class="form-control @error('address') is-invalid @enderror"   autocomplete="off" placeholder="Address">
        @error('address')
          <div class="alert alert-danger">{{ $message }}</div>
       @enderror
      </div>

      <div class="col-md-3 mb-3" style="display: none;" id="address2">
        <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="validationServer05">{{__('input.Address2')}}</label>
        <input type="text" name="address2" value="{{ old('address2') }}" class="form-control @error('address2') is-invalid @enderror"   autocomplete="off" placeholder="Address Tow">
        @error('address2')
          <div class="alert alert-danger">{{ $message }}</div>
       @enderror
      </div>


        <div class="col-md-2 mb-3">
          <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="validationServer03">{{__('input.City')}}</label>
          <select name="city" class="custom-select form-control @error('city') is-invalid @enderror"  >
              <option selected>Select Menu</option>
               @foreach ($cities as $city)

              <option value="{{$city->name}}">{{$city->name}}</option>
              @endforeach

            </select>
            @error('city')
             <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-2 mb-3">
          <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="validationServer03">{{__('input.Status')}}</label>
          <select id="cho" onchange="showhiednn();"  name="status" class="custom-select form-control @error('status') is-invalid @enderror"  >
              <option selected>Select Menu</option>

              <option value="Pending">{{__('input.Pending')}}</option>
              <option value="NoAnsower">{{__('input.NoAnsower')}}</option>

              <option value="Cancelled">{{__('input.Cancelled')}}</option>
              <option value="Postponed">{{__('input.Postponed')}}</option>
              <option value="Credit">{{__('input.Credit')}}</option>

              <option value="Done">{{__('input.Done')}}</option>


            </select>
            @error('status')
             <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div id="code" style="display: none;" class="col-md-3 mb-3">
            <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="validationServer04">{{__('input.Code')}}</label>
            <select class="custom-select form-control" name="code">
                <option selected>none</option>
                @foreach ($codes as $code)

                <option value="{{$code->code}}">{{$code->code}}</option>
                @endforeach

              </select>

          </div>
        <div id="code2" style="display: none;" class="col-md-3 mb-3">
            <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="validationServer04">{{__('input.Code2')}}</label>
            <select class="custom-select form-control" name="code2">
                <option selected>none</option>
                @foreach ($codes as $code)

                <option value="{{$code->code}}">{{$code->code}}</option>
                @endforeach

              </select>

          </div>

        <div id="hied" style="display: none" class="col-md-4 mb-3">
            <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif  for="validationServer01">{{__('input.note')}}</label>
            <textarea  type="textarea" name="reason" class="form-control @error('reason') is-invalid @enderror"   autocomplete="off" placeholder="Reason" required> </textarea>

            @error('reason')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="col-md-4 mb-3">
            <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="validationServer01">{{__('input.product')}}</label>
            <input type="text" name="product" value="{{ old('product') }}" class="form-control @error('product') is-invalid @enderror"   autocomplete="off" placeholder="product" required>

            @error('customer_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>



    </div>

        <div class="form-group mt-3">
            <button @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="btn btn-primary" type="submit">{{__('input.Create')}}</button>
        </div>
        <br>
        </div>

</form>
</div>
@endsection

