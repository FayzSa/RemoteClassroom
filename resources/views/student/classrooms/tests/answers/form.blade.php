<div data-aos="fade-left" data-aos-delay="200" class="form-group">
        <label class="text-white font-bold" for="Title">Title : </label>
        <input type="text"  name="Title" value="{{old('Title') ?? $answer->title ?? "" }}" placeholder='Test Title' class='form-control'>
        </div>
        <p class="text-danger"> {{$errors->first('Title')}} </p>

        <div  data-aos="fade-left" data-aos-delay="200"class="form-group">
        <label class="text-white font-bold" for="Description">Description : </label>
        <textarea type="text"  name="Description"  placeholder='Description' class='form-control' rows="6">{{old('Description') ??  $test->description ?? ""}} </textarea>
            </div>   <p class="text-danger"> {{$errors->first('Description')}} </p>


            <div class="custom-file form-group" d>

                <label class="custom-file-label py-2 btn btn-circle icon-download mx-auto " id="downloadfile" for="validatedCustomFile">Choose answer File
                </label>
                <input type="file" class="custom-file-input"  name="attach[]" id="validatedCustomFile" >
              </div>
              <p class="text-danger"> {{$errors->first('attach')}} </p>

        @csrf
