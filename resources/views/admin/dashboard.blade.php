      @extends('admin.layouts.app')
      @if (isset($page_title) && $page_title != '')
          @section('title', $page_title . ' | ' . config('app.name'))
      @else
          @section('title', config('app.name'))
      @endif
      @section('content')
          <div class="col-lg-3">
              <div class="card">
                  <div class="card-body">
                      <h4 class="card-title">Sweet Message</h4>
                      <div class="card-content">
                          <div class="sweetalert mt-5">
                              <button class="btn btn-info btn sweet-message">Sweet Message</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      @endsection
