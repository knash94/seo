@extends($template)

@section($section)
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Redirect Manager</h1>
                </div>

                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">View errors</a></li>
                        <li><a data-toggle="tab" href="#menu1">View redirects</a></li>
                        <li><a data-toggle="tab" href="#menu2">Add redirect</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade {{ Request::get('tab') == 'errors' || !Request::get('tab') ? 'in active' : ''}}">
                            <h3>HTTP Errors</h3>
                            <p>Lists all 404 errors that have been recorded.</p>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-responsive">
                                        <thead>
                                            <th>URL</th>
                                            <th>
                                                <a href="{{ route('seo-tools.index', [
                                                    'errors-sort' => 'hits',
                                                    'errors-sort-dir' => Request::get('errors-sort-dir') == 'asc' || !Request::get('errors-sort-dir') ? 'desc' : 'asc'
                                                    ]) }}"
                                                >
                                                    Amount of errors
                                                </a>
                                            </th>
                                            <th>
                                                <a href="{{ route('seo-tools.index', [
                                                    'errors-sort' => 'last_hit',
                                                    'errors-sort-dir' => Request::get('errors-sort-dir') == 'asc' || !Request::get('errors-sort-dir') ? 'desc' : 'asc'
                                                    ]) }}"
                                                >
                                                    Last error
                                                </a>
                                            </th>
                                            <th>
                                                <a href="{{ route('seo-tools.index', [
                                                    'errors-sort' => 'created_at',
                                                    'errors-sort-dir' => Request::get('errors-sort-dir') == 'asc' || !Request::get('errors-sort-dir') ? 'desc' : 'asc'
                                                    ]) }}"
                                                >
                                                    First reported
                                                </a>
                                            </th>
                                            <th>Manage</th>
                                        </thead>
                                        <tbody>
                                            @foreach($errors as $error)
                                                <tr>
                                                    <td>{{ url() }}/{{ $error->path }}</td>
                                                    <td>{{ $error->hits }}</td>
                                                    <td>{{ $error->last_hit->diffForHumans() }}</td>
                                                    <td>{{ $error->created_at->diffForHumans() }}</td>
                                                    <td>
                                                        @if ($error->redirect)
                                                            <a class="btn btn-xs btn-success">Manage redirect</a>
                                                        @else
                                                            <a href="#" class="btn btn-xs btn-primary">Add redirect</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {!! $errors->render() !!}
                                </div>
                            </div>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <h3>Menu 1</h3>
                            <p>Some content in menu 1.</p>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <h3>Menu 2</h3>
                            <p>Some content in menu 2.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection