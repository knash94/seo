@extends($template)

@section($section)
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Redirect Manager</h1>
                </div>

                <div class="panel-body">
                    @if (session('seo-tools.message'))
                        <div class="form-group">
                            <div class="alert alert-success">
                                {{ session('seo-tools.message') }}
                            </div>
                        </div>
                    @endif

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">View errors</a></li>
                        <li><a data-toggle="tab" href="#menu1">View redirects</a></li>
                        <li><a data-toggle="tab" href="#menu2">Add redirect</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade {{ Request::get('tab') == 'errors' || !Request::get('tab') ? 'in active' : ''}}">
                            <h3>HTTP Errors</h3>

                            @include('seo-tools::bootstrap3.partials.errors-table')
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <h3>HTTP Redirects</h3>

                            @include('seo-tools::bootstrap3.partials.redirects-table')
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <h3>Add redirect</h3>

                            <form action="{{ route('seo-tools.redirect.store') }}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
                                    <label class="control-label" for="path">Base path</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">{{ url('/') }}/</div>
                                        <input class="form-control" name="path" type="text" id="path" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="target">Redirect to</label>
                                    <input class="form-control" name="redirect_url" type="text" id="target" placeholder="https://www.example.com/my-example-page" required>
                                    <span class="text-warning">* This must be the full url of where you are wanting to redirect to</span>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="status_code">Status code</label>
                                    <select name="status_code" class="form-control" required>
                                        <option disabled readonly selected>Please select..</option>
                                        <option value="301">301 (Permanent redirect)</option>
                                        <option value="302">302 (Temporary redirect)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Add redirect</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection