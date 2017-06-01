<div class="tab-pane padding-20 active slide-left" id="tab1">
    <div class="row row-same-height">
        <div class="col-md-5 b-r b-dashed b-grey sm-b-b">
            <div class="padding-30 ">
                <br>

                <h2>Please give us some infos about your new Service!</h2>
                <p>Fill the form out to enter a new Product for your Customer.</p>
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

                <div class="form-group form-group-default required{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label>Service name</label>

                    <input
                            type="text"
                            class="form-control"
                            value="{{ old('name') ?? $service->name }}"
                            name="name"
                            required
                    >

                    @include ('errors.display', ['field' => 'name'])
                </div>

                <div class="form-group form-group-default required{{ $errors->has('price') ? ' has-error' : '' }}">
                    <label>Cost in Euro</label>

                    <input
                            type="number"
                            class="form-control"
                            placeholder=""
                            value="{{ old('price') ?? $service->price }}"
                            name="price"
                            required
                    >

                    @include ('errors.display', ['field' => 'price'])
                </div>

                <div class="form-group form-group-default required{{ $errors->has('duration') ? ' has-error' : '' }}">
                    <label>Time in Minutes</label>

                    <input
                            type="number"
                            class="form-control"
                            value="{{ old('duration') ?? $service->duration }}"
                            name="duration"
                    >

                    @include ('errors.display', ['field' => 'duration'])
                </div>

                <div class="form-group form-group-default{{ $errors->has('target') ? ' has-error' : '' }}">
                    <label>monthly bookings aim</label>

                    <input
                            type="text"
                            class="form-control"
                            value="{{ old('target') ?? $service->target }}"
                            name="target"
                    >

                    @include ('errors.display', ['field' => 'target'])
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
          <textarea
                  class="form-control"
                  id="description"
                  placeholder="A short description"
                  aria-invalid="false"
                  name="description"
          >{{ $service->description }}</textarea>

                    @include ('errors.display', ['field' => 'description'])
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