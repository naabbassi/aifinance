@extends('layout')
@section('title')
    AIF :: Withdraw
@endsection 
@section('content')
    <div class="section">
        <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Withdraw Request</h4>
                        </div>
                        <div class="card-body">
                            <div class="section-title p-2">Available amount to withdraw: <span class="text-success">{{ number_format($available, 2) }}$</span></div>
                            {{-- start accordion --}}
                            <div  id="accordion" class="pt-2">
                                <div class="accordion">
                                  <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="false">
                                    <h4> <i class="fas fa-donate"></i> &nbsp; Withdraw to Deposit</h4>
                                  </div>
                                  <div class="accordion-body collapse " id="panel-body-1" data-parent="#accordion">
                                      <h5 class="section-title pb-4">Withdraw To Deposit</h5>
                                    <form method="POST" action="/finance/withdraw_deposit">
                                        @csrf
                                        <div class="row">
                                          <div class="form-group col-12 col-md-6">
                                            <label for="name">Amount : USD</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                  <div class="input-group-text">$</div>
                                                </div>
                                                <input type="number" name="amount" class="form-control"  placeholder="Amount in usd">
                                              </div>
                                              <small class="form-text text-success ">Minimum amount to deposit is 250$</small>
                                                @error('amount')
                                                   <small class="form-text text-danger ">The amount must be at least 250$ to deposit</small>
                                                @enderror
                                          </div>
                                          <div class="form-group col-12 col-md-6">
                                                <label >Annotation</label>
                                                <textarea name="description" class="form-control"  cols="30" rows="5"  style="min-height:100px"></textarea>
                                                <small class="form-text text-primary ">You can write an annotation.</small>
                                              </div>
                                        </div>   
                                        <div class="form-group">
                                          <button type="submit" class="btn btn-primary">
                                            Send Request
                                          </button>
                                        </div>
                                      </form>
                                  </div>
                                </div>
                                <div class="accordion">
                                  <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-2">
                                    <h4> <i class="fas fa-wallet"></i> &nbsp; Withdraw to Wallet</h4>
                                  </div>
                                  <div class="accordion-body collapse" id="panel-body-2" data-parent="#accordion">
                                      <h5 class="section-title pb-4">Withdraw To Wallet</h5>
                                  <form method="POST" action="/finance/withdraw_wallet">
                                      @csrf
                                      <div class="row">
                                        <div class="form-group col-12 col-md-6">
                                          <label for="name">Amount : USD</label>
                                          <div class="input-group mb-2">
                                              <div class="input-group-prepend">
                                                <div class="input-group-text">$</div>
                                              </div>
                                              <input type="number" name="amount" class="form-control"  placeholder="Amount in usd">
                                            </div>
                                            <small class="form-text text-success ">Minimum amount to withdraw is 50$</small>
                                              @error('amount')
                                                 <small class="form-text text-danger ">The amount must be at least 50$ to deposit</small>
                                              @enderror
                                        </div>
                                        <div class="form-group col-12 col-md-6">
                                            <label>Wallet:</label>
                                            <select class="form-control selectric" name="wallet">
                                              @foreach ($wallets as $item)
                                                 <option value={{$item->id}}>{{$item->title}}</option>
                                              @endforeach
                                            </select>
                                            <small class="form-text text-primary ">Just be sure that the wallet address is correct</small>
                                          </div>
                                        <div class="form-group col-12 col-md-12">
                                              <label >Annotation</label>
                                              <textarea name="description" class="form-control"  cols="10" rows="5" style="min-height:100px"></textarea>
                                              <small class="form-text text-primary ">You can write an annotation.</small>
                                            </div>
                                      </div>   
                                      <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                          Send Request
                                        </button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>

                            {{-- end accordion --}}
                            {{-- start table --}}
                            <div class="section-title p-2">Withdraws History &nbsp;&nbsp; <span class="badge badge-secondary pull-right">   Total Withdraw Amount : {{$sum}} $</span></div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th>Transaction</th>
                                      <th>Amount</th>
                                      <th>Type</th>
                                      <th>Due Date</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($withdraws as $indexKey => $item)
                                        <tr>
                                            <td>{{date_format($item->created_at,'my')}}{{strtoupper($item->type)}}-{{$item->id}}</td>
                                            <td class="align-middle">{{$item->amount}}$</td>
                                            <td >
                                              @if($item->deposit_id > 0)
                                                  <span class="badge badge-info">Deposit</span>
                                              @endif  
                                              @if($item->wallet_id > 0)
                                                  <span class="badge badge-success">Wallet</span>
                                              @endif  
                                            </td>
                                            <td>{{ date_format($item->created_at,'d M Y')}}</td>
                                            <td>
                                              @if($item->status)
                                                  <span class="badge badge-success">Approved</span>
                                              @else
                                                  <span class="badge badge-warning">Pending</span>
                                              @endif  
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" data-toggle="dropdown" class="btn btn-light" aria-expanded="false"> ⋮ </a>
                                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, -6px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <a href="#" class="dropdown-item has-icon text-info" id="deleteItem" data-id="{{$item->id}}"><i class="far fa-eye"></i> Details</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="#" class="dropdown-item text-warning has-icon"  onclick="setIssueId('{{$item->id}}')"><i class="fas fa-exclamation"></i> Report an issue</a>
                                                    </div>
                                                  </div>
                                            </td>
                                          </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                                {!! $withdraws->render() !!}
                              </div>

                        </div>
                    </div>
                </div>
        </div>
    </div>

            <!-- Issue Modal modal -->
<div class="modal fade issue-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Report an issue</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form onsubmit="event.preventDefault(); submitIssueForm();">
            <div class="form-group row">
              <label class="col-form-label">Tell us about the issue :</label>
              <textarea class="summernote" id="issueMessage" rows="10" style="height:100px;" placeholder="Tell us about issue"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send request</button>
            <button type="reset" class="btn btn-primary ml-2" data-dismiss="modal" aria-label="Close">Cancel</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
<script>
      //issue form
      var IssueItemId=0;
      function setIssueId(e){
        this.IssueItemId = e;
        $('.issue-modal').modal('show');
      }
      function submitIssueForm(e){
        $.ajax({
        method: "POST",
          data:{
            '_token': '{{csrf_token()}}',
            id: this.IssueItemId,
            type:'w',
            message:document.getElementById('issueMessage').value
          },
        url: "{{ route('home') }}/issue/submit",
        }).done(function(result) {
          if(result){
            $('.issue-modal').modal('hide');
            if(result == 'true'){
                swal('Report the issue', 'Your issue reqistered successfully', 'success');
            } else {
                swal('Report the issue', result, 'info');
            }
          } else{
            swal('Report the issue', 'Opps! apparently something went wrong', 'info');
          }
         })
      }
</script>
@endsection