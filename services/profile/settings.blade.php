<div class="tab-pane slide-left padding-20" id="tab3">
  <div class="row row-same-height">
    <div class="col-md-5 b-r b-dashed b-grey ">
      <div class="padding-30">
        <br>

        <h2>We would like to know something about this product!</h2>
        <p>To get good statistics, please enter your Aims for this product at th fields below.</p>
        <p class="small hint-text"></p>
      </div>
    </div>

    <div class="col-md-7">
      <form
        class="padding-30"
        method="POST"
        action="{{ action('ServicesController@update', $service->id) }}"
      >
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
         
        <div class="form-group  form-group-default">
          <label>monthly bookings aim</label>
          <input type="text" class="form-control" value="{{ $service->target }}" name="target">
        </div>

        <div class="form-group  form-group-default">
          <label>Buffer Time before this service in minutes</label>
          <input type="text" class="form-control" value="{{ $service->buffer_before }}" name="buffer_before">
        </div>

        <div class="form-group  form-group-default">
          <label>Buffer Time after this service in minutes</label>
          <input type="text" class="form-control" value="{{ $service->buffer_after }}" name="buffer_after">
        </div>

        <div class="form-group">
          <button
            type="submit"
            class="btn btn-primary btn-cons btn-animated from-left fa fa-clock-o pull-right"
          >
            <span>Save</span>
          </button>
        </div>
      </form>
    </div>

  </div>
</div>