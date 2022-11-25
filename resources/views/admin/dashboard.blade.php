      @extends('admin.layouts.app')
      @if (isset($page_title) && $page_title != '')
          @section('title', $page_title . ' | ' . config('app.name'))
      @else
          @section('title', config('app.name'))
      @endif
      @section('content')
          <div class="col-lg-3">
              <div class="card">
                
              </div>
          </div>
      @endsection
