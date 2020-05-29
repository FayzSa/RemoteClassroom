<div class="form-group">
        <label for="CustName">Name</label>
        <input type="text" name="Name" value="{{old('Name') ?? $course->name ?? "" }}" placeholder='Course Name' class='form-control'>
        </div>
        <p class="text-danger"> {{$errors->first('Name')}} </p>
        <div class="form-group">
        <label for="Description">Description</label>
        <textarea type="text" name="Description" value="" placeholder='Description' class='form-control' rows="6">{{old('Description') ??  $course->description ?? ""}} </textarea>
            </div>   <p class="text-danger"> {{$errors->first('Description')}} </p>
            <div class="custom-file ">
                <input type="file" class="custom-file-input" name="attach[]" id="validatedCustomFile" >
                <label class="custom-file-label" for="validatedCustomFile">Choose course file ...</label>
              </div>
              <p class="text-danger"> {{$errors->first('attach')}} </p>

        @csrf