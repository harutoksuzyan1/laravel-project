@extends('layouts.app')

@section('content')
<div class="container-fluid container-fixed-lg bg-white">
  <!-- START PANEL -->
  <div class="panel panel-transparent">
    <div class="panel-heading">
      <div class="panel-title"><h4>Your Services</h4>
      </div>
      <div class="pull-right">
       <div class="col-xs-12">
        <div class="col-xs-6">
        <input type="text" id="search-table" class="form-control pull-right" placeholder="Search">
        </div>
          <button id="show-modal" class="btn btn-primary btn-cons">
            <i class="fa fa-plus"></i> Add Service
          </button>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <table class="table table-hover demo-table-dynamic table-responsive-block" id="tableWithSearch">
        <thead>
          <tr>
            <th>Service Name</th>
            <th>Duration</th>
            <th>Price</th>
            <th>Activity</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($services as $service)
          <tr>
            <td class="v-align-middle">
              <p>{{ ucfirst($service->name) }}</p>
            </td>
            <td class="v-align-middle">
              <p>{{ $service->duration }} min</p>
            </td>
            <td class="v-align-middle">
              <p>{{ $service->price }}&euro;</p>
            </td>
            <td class="v-align-middle">
                  <div class="btn-group">
                  <a href="{{ action('ServicesController@show', $service->id) }}"
                     class="btn btn-success"
                  >
                    <i class="fa fa-pencil"></i>
                  </a>

                  <a class="btn btn-success" onclick="event.preventDefault(); document.getElementById('destroy-service-form-{{ $service->id }}').submit();">
                    <i class="fa fa-trash-o"></i>
                  </a>

                  <form id="destroy-service-form-{{ $service->id }}"
                        action="{{ action('ServicesController@destroy', $service->id) }}"
                        method="POST"
                        style="display: none;"
                  >
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                  </form>
                </div>
             </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <!-- END PANEL -->
</div>

@include ('app.services.modals.add_service')
@endsection

@section ('scripts')
<script src="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/datatables.responsive.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/lodash.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables.js') }}"></script>
@endsection