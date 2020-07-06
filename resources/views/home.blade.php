@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Auth::user()->role != 1) {{-- if not admin --}}
                        You are logged in!
                        <br>
                        Your API Token is : <span>{{ Auth::user()->api_token }}</span>
                    @else
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="" method="get">
                                            <label for="">Filter by partner:</label>
                                            <select name="by_partner">
                                                <option value="all" @if(Request::get('by_partner') == 'all') selected @endif>All</option>
                                                @foreach($partners as $partner)
                                                    <option value="{{ $partner->id }}" @if(Request::get('by_partner') == $partner->id) selected @endif>{{ $partner->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="">Filter by date/time:</label>
                                            <input type="datetime-local" name="by_datetime" value="{{ Request::get('by_datetime') }}">
                                            <input type="submit">
                                            <input type="reset">
                                        </form>
                                        <br>
                                        <h4 class="card-title">Total <span class="badge badge-secondary">{{ count($apiRequests) }}</span> Request served</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <form action="" method="get">
                            <h4>Show Recent
                                <select name="show" onchange="this.form.submit()">
                                    <option value="30" @if(Request::get('show') == 30) selected @endif>30</option>
                                    <option value="50" @if(Request::get('show') == 50) selected @endif>50</option>
                                    <option value="100" @if(Request::get('show') == 100) selected @endif>100</option>
                                </select> 
                                Request:
                            </h4>
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Requester</th>
                                    <th>Endpoint</th>
                                    <th>Method</th>
                                    <th>Ip</th>
                                    <th>Status Code</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($apiRequests) > 0)
                                    @foreach($apiRequests as $apiRequest)
                                        <tr>
                                            <td>{{ $apiRequest->id }}</td>
                                            <td>{{ $apiRequest->user->name }}</td>
                                            <td>{{ $apiRequest->url }}</td>
                                            <td>{{ $apiRequest->method }}</td>
                                            <td>{{ $apiRequest->ip_address }}</td>
                                            <td>{{ $apiRequest->status_code }}</td>
                                            <td>{{ $apiRequest->created_at->format('d-m-y h:i:s') }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>No Request Served</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
