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
                            <h3>Menu 2</h3>
                            <p>Some content in menu 2.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection