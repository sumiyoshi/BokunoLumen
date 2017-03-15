<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mail">Mail
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="mail" class="form-control col-md-7 col-xs-12" name="mail" value="{{$user->mail}}">
        @include('parts.errors', ['errors' => $errors, 'key' => 'mail'])
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="name" class="form-control col-md-7 col-xs-12" name="name" value="{{$user->name}}">
        @include('parts.errors', ['errors' => $errors, 'key' => 'name'])
    </div>
</div>

<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_password">Password
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="password" id="user_password" class="form-control col-md-7 col-xs-12" name="password" value="{{$user->password}}">
        @include('parts.errors', ['errors' => $errors, 'key' => 'password'])
    </div>
</div>