@if(!empty($errors[$key]))
    @foreach($errors[$key] as $error)
        <div>{{$error}}<div>
    @endforeach
@endif