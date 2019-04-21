@extends($template)

@section($section)
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Viewing {{ url('/') }}/{{ $httpError->path }}</h1>
                </div>

                <div class="panel-body">
                    <table class="table table-responsive table-hover">
                        <thead>
                        <th>Requested</th>
                        <th>User Agent</th>
                        <th>Ip address</th>
                        <th>Referral URL</th>
                        </thead>
                        <tbody>
                        @foreach ($httpError->requests as $request)
                            <tr>
                                <td title="{{ $request->created_at }}">{{ $request->created_at->diffForHumans() }}</td>
                                <td>{{ $request->user_agent }}</td>
                                <td>{{ $request->ip_address }}</td>
                                <td>{{ $request->previous_url ?: 'N/A' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <a href="{{ route('seo-tools.index') }}" class="btn btn-primary">Go back</a>
                </div>
            </div>
        </div>
    </div>
@endsection