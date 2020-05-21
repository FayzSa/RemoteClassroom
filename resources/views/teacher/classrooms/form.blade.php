<div class="form-group">
        <label for="ClassName">Class Name</label>
        <input type="text" name="ClassName" value="{{old('ClassName') ?? $class->className ?? ''}}" placeholder='Class Name' class='form-control'>
        </div>
        <p> {{$errors->first('ClassName')}} </p>
        <div class="form-group">
        <label for="invitCode">Invite Code</label>
        <input type="text" name="invitCode" placeholder='Invite Code' value='{{old("invitCode") ?? $class->invitCode ?? ''}}' class='form-control'>
        </div>
        <p> {{$errors->first('invitCode')}} </p>
        @csrf