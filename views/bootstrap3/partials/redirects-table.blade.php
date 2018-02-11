<div class="row">
    <div class="col-md-12">
        <table class="table table-responsive table-hover">
            <thead>
            <th>
                <a href="{{ route('seo-tools.index', [
                                                    'redirects-sort' => 'hits',
                                                    'redirects-sort-dir' => Request::get('errors-sort-dir') == 'asc' || !Request::get('errors-sort-dir') ? 'desc' : 'asc'
                                                    ]) }}"
                >
                    Source URL
                </a>
            </th>
            <th>
                <a href="{{ route('seo-tools.index', [
                                                    'redirects-sort' => 'last_hit',
                                                    'redirects-sort-dir' => Request::get('errors-sort-dir') == 'asc' || !Request::get('errors-sort-dir') ? 'desc' : 'asc'
                                                    ]) }}"
                >
                    Target URL
                </a>
            </th>
            <th>
                <a href="{{ route('seo-tools.index', [
                                                    'redirects-sort' => 'created_at',
                                                    'redirects-sort-dir' => Request::get('errors-sort-dir') == 'asc' || !Request::get('errors-sort-dir') ? 'desc' : 'asc'
                                                    ]) }}"
                >
                    Status Code
                </a>
            </th>
            <th>Created</th>
            <th>Manage</th>
            <th>Delete</th>
            </thead>
            <tbody>
            @foreach($redirects as $redirect)
                <tr>
                    <td><a href="{{ url() }}/{{ $redirect->path }}" target="_blank">{{ url() }}/{{ $redirect->path }}</a></td>
                    <td><a href="{{ $redirect->redirect_url }}" target="_blank">{{ $redirect->redirect_url }}</a></td>
                    <td>{{ $redirect->status_code }}</td>
                    <td>{{ $redirect->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{route('seo-tools.redirect.edit', $redirect->id)}}" class="btn btn-xs btn-success">Manage redirect</a>
                    </td>
                    <td>
                        <a class="btn btn-xs btn-danger">Delete redirect</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $redirects->render() !!}
    </div>
</div>