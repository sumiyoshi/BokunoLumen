@if(!empty($errors[$key]))
    @foreach($errors[$key] as $error)
        <div class="error-massage">{{$error}}</div>
    @endforeach
@endif