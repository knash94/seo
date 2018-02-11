@extends($template)

@section($section)
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Managing {{ url() }}/{{ $error->path }}</h1>
                </div>

                <div class="panel-body">
                    <form action="{{ route('seo-tools.error.update', $error->id) }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="control-label" for="path">Base path</label>
                            <input class="form-control" type="text" value="{{ url() }}/{{ $error->path }}" id="path" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="target">Redirect to</label>
                            <input class="form-control" name="redirect_url" type="text" value="{{ $error->redirect ? $error->redirect->redirect_url : '' }}" id="target" placeholder="https://www.example.com/my-example-page" required>
                            <span class="text-warning">* This must be the full url of where you are wanting to redirect to</span>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="status_code">Status code</label>
                            <select name="status_code" class="form-control" required>
                                <option disabled readonly selected>Please select..</option>
                                <option value="301" {{ $error->redirect && $error->redirect->status_code == 301 ? 'selected' : '' }}>301 (Permanent redirect)</option>
                                <option value="302" {{ $error->redirect && $error->redirect->status_code == 301 ? 'selected' : '' }}>302 (Temporary redirect)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6 col-sm-4">
                                    <button class="btn btn-success form-control" type="submit">
                                        Save changes
                                    </button>
                                </div>

                                <div class="col-xs-6 col-sm-2">
                                    <a class="btn btn-danger form-control" href="{{ route('seo-tools.index') }}">
                                        Discard change
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection