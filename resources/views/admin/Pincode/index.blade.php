@extends('admin.layouts.app')
@if (isset($page_title) && $page_title != '')
    @section('title', $page_title . ' | ' . config('app.name'))
@else
    @section('title', config('app.name'))
@endif
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="card-title mb-4">{{ isset($page_title) ? $page_title : 'Page Title' }}</h4>
                        </div>
                        <div class="col-lg-6 text-right">
                            <a href="{{ route('pincode.create') }}" class="float-end">
                                <button type="button" class="btn btn-primary">create</button>
                            </a>
                        </div>
                    </div>
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="dataTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Pincode</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Contry</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
