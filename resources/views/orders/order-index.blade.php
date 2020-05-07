@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
          <h2>Manage Orders for {{ $resto->name }}</h2>
        </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-12">
          @if ($orders->count() > 0)
          <div class="d-flex justify-content-end mb-3">
          <a href="{{ route('resto.orders.add', $resto->id) }}" class="btn btn-sm btn-info">Add Order</a>
        </div>
        <manage-orders :orders="{{ json_encode($orders) }}"></manage-orders>
        {{-- <div class="table-responsive"> --}}
            {{-- <table class="table table-hover table-bordered table-striped">
              <thead>
                <tr>
                  <th>Order Id</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Details</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($orders as $order)
                    <tr>
                      <td>{{ $order->id }}</td>
                      <td>{{ $order->amount }}</td>
                      <td>{{ ($order->isComplete) ? 'completed' : 'incomplete' }}</td>
                      <td>
                        Name: {{ $order['order_details']['customer_name'] }}
                        <br>
                        Phone: {{ $order['order_details']['customer_phone'] }}
                        <br>
                        Address: {{ $order['order_details']['customer_address'] }}
                        <br>
                      </td>
                    </tr>
                  @endforeach
              </tbody>
            </table> --}}
            {{ $orders->render() }}
          @else
            <p>You don't have any orders yet!</p>
          @endif
        {{-- </div> --}}
      </div>
  </div>
</div>
@endsection
