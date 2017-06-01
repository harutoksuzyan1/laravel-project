<div class="modal fade slide-up disable-scroll in" id="addNewAppModal" tabindex="-1" role="dialog" aria-labelledby="addNewAppModal" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content-wrapper">
      <div class="modal-content">
      <div class="modal-header clearfix ">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
        </button>
        <h4 class="p-b-5"><span class="semi-bold">New</span> Service</h4>
      </div>
      <div class="modal-body">
        <p class="small-text">Create a new Service using this form, make sure you fill them all</p>
        
        <form role="form" method="POST" action="{{ action('ServicesController@store') }}">
          {{ csrf_field() }}

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group form-group-default">
                <label>Service Name</label>
                <input id="staffName" type="text" class="form-control" placeholder="Service Name" name="name">
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group form-group-default">
                <label>Duration in Minutes</label>
                <input id="staffEmail" type="text" class="form-control" placeholder="Duration of Service in Minutes" name="duration">
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group form-group-default">
                <label>Price in Euro</label>
                <input id="staffEmail" type="text" class="form-control" placeholder="Price in Euro" name="price">
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group form-group-default">
                <label>Service Description</label>
                <input id="staffEmail" type="text" class="form-control" placeholder="A short description of your service" name="description">
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button id="add-app" type="submit" class="btn btn-primary btn-cons">Add</button>
            <button class="btn btn-alert" data-dismiss="modal">Close</button>
          </div>
       </form>
      </div>
    </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>