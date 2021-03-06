@extends($template)

@section($section)
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Managing {{ url('/') }}/{{ $httpError->path }}</h1>
                </div>

                <div class="panel-body">
                    <form action="{{ route('seo-tools.error.update', $httpError->id) }}" method="post">

                        @if (isset($errors) && $errors->all())
                            <div class="form-group">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="control-label" for="path">Base path</label>
                            <input class="form-control" type="text" value="{{ url('/') }}/{{ $httpError->path }}" id="path" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="target">Redirect to</label>
                            <input class="form-control" name="redirect_url" type="text" value="{{ $httpError->redirect ? $httpError->redirect->redirect_url : '' }}" id="target" placeholder="https://www.example.com/my-example-page" required>
                            <span class="text-warning">* This must be the full url of where you are wanting to redirect to</span>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="status_code">Status code</label>
                            <select name="status_code" class="form-control" required>
                                <option disabled readonly selected>Please select..</option>
                                <option value="301" {{ $httpError->redirect && $httpError->redirect->status_code == 301 ? 'selected' : '' }}>301 (Permanent redirect)</option>
                                <option value="302" {{ $httpError->redirect && $httpError->redirect->status_code == 302 ? 'selected' : '' }}>302 (Temporary redirect)</option>
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