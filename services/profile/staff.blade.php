<div class="tab-pane slide-left padding-20" id="tab2">
  <div class="row">

    <div class="col-md-5 b-r b-dashed b-grey">
      <div class="padding-30 m-t-50">
        <h2>Set up the Staff for this Service!</h2>
        <p>For Default every of your staff members can provide this service. If you would like to change this, you can do it right here.</p>
        <p class="small hint-text"></p>
      </div>
    </div>

    <div class="col-md-7 padding-30">

      <div class="row">
        <div class="col-sm-6">
          <div class="">
            <label class="inline"><h5>Who can provide this Service?</h5></label>
          </div>
        </div>
      </div>
      
      @foreach ($employees as $employee)
        <service-provider :employee="{{ $employee }}" :service="{{ $service }}">
            {{ $employee->name }}
        </service-provider>
      @endforeach
    </div>

  </div>
</div>