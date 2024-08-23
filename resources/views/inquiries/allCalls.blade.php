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
<div style="display: flex;justify-content: right;align-items: right;">
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" id="myInput" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">{{__('view.search')}}</button>
    </form>

</div>
    <div >
        <a class="btn btn-success" href="{{url('calls/create')}}">{{__('view.create')}}</a>
    </div>

<div class="continer">


    <table id="myTable" class="table  table-hover" style="width:100%">
        <thead>
            <tr>
                <th>{{__('view.agent')}}</th>
                <th>{{__('view.name')}}</th>
                <th>{{__('view.phone')}}</th>
                <th>{{__('view.phone2')}}</th>
                <th>{{__('view.primary')}}</th>
                <th>{{__('view.dateIn')}}</th>
                <th>{{__('view.PendingDate')}}</th>
                <th>{{__('view.dateOut')}}</th>
                <th>{{__('view.code')}}</th>
                <th>{{__('view.code2')}}</th>
                <td>{{__('view.address')}}</td>
                <td>{{__('view.address2')}}</td>
                <td>{{__('view.city')}}</td>
                <td>{{__('view.stauts')}}</td>
                <td>{{__('view.details')}}</td>
                <td>{{__('view.update')}}</td>
            </tr>
        </thead>
        <tbody>
           @foreach($inquiries as $inquiry)
           <tr data-id="{{ $inquiry->id }}">
                <td>{{$inquiry->user->name}}</td>
                <td>{{$inquiry->customer_name}}</td>
                <td>{{$inquiry->phone}}</td>
                <td>{{$inquiry->phone2}}</td>
                <td>{{$inquiry->national_id}}</td>
                <td>{{$inquiry->date_in}}</td>
                <td>{{$inquiry->date_pending}}</td>
                <td>{{$inquiry->date_out}}</td>
                <td>{{$inquiry->code}}</td>
                <td>{{$inquiry->code2}}</td>
                <td>{{$inquiry->address}}</td>
                <td>{{$inquiry->address2}}</td>
                <td>{{$inquiry->city}}</td>
                <td>{{$inquiry->status}}</td>

                <td><a class="btn btn-primary" href="{{route('calls.edit',$inquiry->id)}}">{{__('view.details')}}</a></td>

                <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal{{$inquiry->id}}">{{__('view.update')}}</button></td>
            </tr>
            <div class="modal fade" id="exampleModal{{$inquiry->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif class="modal-title" id="exampleModalLabel">{{__('input.data')}}</h5>
                      <button  @if(app()->getLocale() == 'ar') style="margin:0px; " @endif type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="margin: 5px " aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" action="{{route('calls.update',$inquiry->id)}}">
                        @method("PUT")
                        @csrf
                        <div class="form-group">
                          <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif  for="recipient-name" class="col-form-label">{{__('input.customerName')}}</label>
                          <input type="text"  value="{{$inquiry->customer_name}}" name="customer_name" class="form-control">
                        </div>



                        <div class="form-group">
                          <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="recipient-name" class="col-form-label">{{__('input.phone')}}</label>
                          <input type="text"  value="{{$inquiry->phone}}" name="phone" id="number"  class="form-control">
                        </div>

                        <div class="form-group">
                          <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="recipient-name" class="col-form-label">{{__('input.phone2')}}</label>
                          <input type="text"  value="{{$inquiry->phone2}}" name="phone2" id="number2"  class="form-control">
                        </div>



                        <div class="form-group">
                          <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="recipient-name" class="col-form-label">{{__('input.nationalid')}}</label>
                          <input type="text"  value="{{$inquiry->national_id}}"  name="national_id" class="form-control" id="nationalid" >

                        </div>



                        <div class="form-group">
                          <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="recipient-name" class="col-form-label">{{__('input.dateIn')}}</label>
                          <input type="date"   value="{{$inquiry->date_in}}" name="date_in" class="form-control">
                        </div>



                        <div class="form-group">
                          <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="recipient-name" class="col-form-label">{{__('input.InquiryDate')}}</label>
                          <input type="date"  value="{{$inquiry->date_pending}}" name="date_pending" class="form-control">
                        </div>



                        <div class="form-group">
                          <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="recipient-name" class="col-form-label">{{__('input.dateout')}}</label>
                          <input type="date"  value="{{$inquiry->date_out}}" name="date_out" class="form-control">
                        </div>


                        <div class="form-group">
                          <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="recipient-name" class="col-form-label">{{__('input.InquiryType')}}</label>
                          <select  name="inquiry_type"  class="custom-select form-control"  >
                              <option value="{{$inquiry->inquiry_type}}" >{{$inquiry->inquiry_type}}</option>

                            @foreach ($InqueryType as $data)
                                <option value="{{$data->type}}" >{{$data->type}}</option>
                            @endforeach
                        </select>

                        </div>


                        <div class="form-group">
                          <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="recipient-name" class="col-form-label">{{__('input.Address')}}</label>
                          <input type="text"  value="{{$inquiry->address}}" name="address" class="form-control">
                        </div>

                        <div class="form-group">
                          <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="recipient-name" class="col-form-label">{{__('input.Address2')}}</label>
                          <input type="text"  value="{{$inquiry->address2}}" name="address2" class="form-control">
                        </div>


                        <div class="form-group">
                            <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="recipient-name" class="col-form-label">{{__('input.City')}}</label>
                            <select  name="city"  class="custom-select form-control"  >
                                <option selected>{{$inquiry->city}}</option>

                               @foreach ($inquiries as $data)
                               <option value="{{$data->city}}" >{{$data->city}}</option>
                              @endforeach
                          </select>

                        </div>


                        <div class="form-group">
                            <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="recipient-name" class="col-form-label">{{__('input.Status')}}</label>
                            <select  name="status"  class="custom-select form-control"  >
                                <option selected>{{$inquiry->status}}</option>
                                <option value="Pending">{{__('input.Pending')}}</option>
                                <option value="NoAnsower">{{__('input.NoAnsower')}}</option>

                                <option value="Cancelled">{{__('input.Cancelled')}}</option>
                                <option value="Postponed">{{__('input.Postponed')}}</option>
                                <option value="Credit">{{__('input.Credit')}}</option>

                                <option value="Done">{{__('input.Done')}}</option>

                          </select>

                        </div>

                        <div class="form-group">
                            <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="recipient-name" class="col-form-label">{{__('input.Code')}}</label>
                            <select  name="code"  class="custom-select form-control"  >

                                <option selected>{{$inquiry->code}}</option>

                                <option value="none" >None</option>
                               @foreach ($codes as $code)
                               <option value="{{$code->code}}" >{{$code->code}}</option>
                              @endforeach
                          </select>

                        </div>


                        <div class="form-group">
                            <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="recipient-name" class="col-form-label">{{__('input.Code2')}}</label>
                            <select  name="code2"  class="custom-select form-control"  >
                                <option selected>{{$inquiry->code2}}</option>

                                <option value="none" >None</option>
                               @foreach ($codes as $code)
                               <option value="{{$code->code}}" >{{$code->code}}</option>
                              @endforeach
                          </select>

                        </div>

                        <div class="form-group">
                            <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="recipient-name" class="col-form-label">{{__('input.journey')}}</label>
                            <input type="text" id="journey"  value="{{$inquiry->journey}}" name="journey" class="form-control">
                          </div>

                        <div class="form-group">
                            <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="recipient-name" class="col-form-label">{{__('input.journey2')}}</label>
                            <input type="text" id="journey2"  value="{{$inquiry->journey2}}" name="journey2" class="form-control">
                          </div>



                        <div class="form-group">
                            @if (!empty($inquiry->reason))
                            <label @if(app()->getLocale() == 'ar') style="display:flex;justify-content: right;align-items: center; " @endif for="validationServer01">{{__('input.note')}}</label>
                            <textarea  type="textarea" name="reason" class="form-control"   autocomplete="off" placeholder="Reason" required>{{$inquiry->reason}}</textarea>

                            @endif


                        </div>



                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('input.close')}}</button>
                          <button type="submit" class="btn btn-primary">{{__('input.update')}}</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
                @endforeach

        </tbody>
        <tfoot>
            <tr>
            </tr>

        </tfoot>
    </table>
    <div class="d-flex justify-content-center">
        {{$inquiries->links()}}

    </div>

</div>

@endsection


