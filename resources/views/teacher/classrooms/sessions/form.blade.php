<div class="form-group">
        <label for="Day">Day</label>
        <input type="text" name="Day" value="{{old('Day') ?? $session->day ?? "" }}" placeholder='Day in this month' class='form-control'>
        </div>
        <p class="text-danger"> {{$errors->first('Day')}} </p>
        
        <div class="Hour-group">
          <label for="Hour">Hour</label>
          <input type="text" name="Hour" value="{{old('Hour') ?? $session->hour ?? "" }}" placeholder='Example 18:30' class='form-control'>
          </div>
          <p class="text-danger"> {{$errors->first('Hour')}} </p>
          
        <div class="form-group">
        <label for="Subject">Subject of Session</label>
        <textarea type="text" name="Subject" value="" placeholder='Subject' class='form-control' rows="6">{{old('Subject') ??  $session->subject ?? ""}} </textarea>
            </div>   <p class="text-danger"> {{$errors->first('Subject')}} </p>
      

        @csrf