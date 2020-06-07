<div class="container">
	<div class="row">
		<form role="form" id="contact-form" class="contact-form" action="/testupload" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="row ">
        <div class="col-md-4 custom-file">
      <label>Atachment :</label>
        <input  name="attachment[]" type="file" class="custom-file-input" id="inputGroupFile04"  data-show-upload="false" data-show-caption="false" multiple>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
        </form>
    </div>
</div>