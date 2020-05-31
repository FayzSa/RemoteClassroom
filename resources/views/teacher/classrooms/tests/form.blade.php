<div class="form-group">
        <label for="Title">Title</label>
        <input type="text" name="Title" value="{{old('Title') ?? $test->title ?? "" }}" placeholder='Test Title' class='form-control'>
        </div>
        <p class="text-danger"> {{$errors->first('Title')}} </p>
        
        <div class="form-group">
        <label for="Description">Description</label>
        <textarea type="text" name="Description" value="" placeholder='Description' class='form-control' rows="6">{{old('Description') ??  $test->description ?? ""}} </textarea>
            </div>   <p class="text-danger"> {{$errors->first('Description')}} </p>
            <div class="form-group">
            <label for="Delay">Delay</label>
            <input type="text" name="Delay" value="{{old('Delay') ?? $test->delay ?? "" }}" placeholder='Test Delay by days' class='form-control'>
            </div>
            <p class="text-danger"> {{$errors->first('Delay')}} </p>

            
            <div class="custom-file form-group">
                <input type="file" class="custom-file-input" name="attach[]" id="validatedCustomFile" >
                <label class="custom-file-label" for="validatedCustomFile">Choose Test File ...</label>
              </div>
              <p class="text-danger"> {{$errors->first('attach')}} </p>

        @csrf