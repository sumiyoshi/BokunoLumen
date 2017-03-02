@if(!empty($errors[$key]))
    @foreach($errors[$key] as $error)
        <div class="alert">{{$error}}</div>
    @endforeach
@endif