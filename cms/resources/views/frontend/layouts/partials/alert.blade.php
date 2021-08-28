@if(isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $err)
                <li>{{$err}}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('message'))
    <div class="alert alert-info">
        {!! session('message') !!}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {!! session('error') !!}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {!! session('success') !!}
    </div>
@endif