@extends($template)

@section($section)
    <div class="container">
        <div class="row">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h1 class="panel-title">Delete redirect</h1>
                </div>

                <div class="panel-body">
                    <h2 class="text-center text-danger">Are you sure that you want to delete this redirect?</h2>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="{{ route('seo-tools.redirect.destroy', [$httpRedirect->id]) }}" class="btn btn-danger form-control">Yes, delete redirect</a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{ route('seo-tools.index') }}" class="btn btn-default form-control">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection