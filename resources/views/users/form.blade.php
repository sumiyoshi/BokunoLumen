<div>
    <input type="text" name="name" value="{{$user->name}}"/><br/>
    @include('parts.errors', ['errors' => $errors, 'key' => 'name'])
</div>
<div>
    <input type="text" name="mail" value="{{$user->mail}}"/>
    @include('parts.errors', ['errors' => $errors, 'key' => 'mail'])
</div>
<div>
    <input type="password" name="password" value="{{$user->password}}"/><br/>
    @include('parts.errors', ['errors' => $errors, 'key' => 'password'])
</div>