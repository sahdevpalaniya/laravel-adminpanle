@extends('admin.layouts.app')
@if (isset($page_title) && $page_title != '')
    @section('title', $page_title . '|' . config('app.name'))
@else
    @section('title', '|' . config('app.name'))
@endif
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ isset($page_title) ? $page_title : 'Pagea title' }}</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form class="form-valide" action="" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    <select id="single-select" class="country">
                                        <option value="">Select Contry</option>
                                        @foreach ($contries as $contry)
                                            <option value="{{ $contry->id }}">{{ $contry->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select class="jquery-selector" id="state">
                                        <option value="">Select State</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select class="jquery-selector" id="city">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div>
                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                                <a href="{{ route('category_list') }}" class="btn btn-dark w-md">Cancel</a>
                            </div>
                        </form>
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
            $(".country").on('change', function() {
                var contry_id = $(this).val();
                $.ajax({
                    url: "{!! route('pincode.state') !!}" + '/' + contry_id,
                    type: 'post',
                    data: {
                        contry_id: contry_id,
                    },
                    dataType: 'json',
                    success: function(result) {
                        $.each(result.states, function(key, value) {
                            $('#state').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                })
            });

            $("#state").on('change', function() {
                var state_id = $(this).val();
                $.ajax({
                    url: "{!! route('pincode.city') !!}" + '/' + state_id,
                    type: 'post',
                    data: {
                        state_id: state_id,
                    },
                    dataType: 'json',
                    success: function(result) {
                        $.each(result.citys, function(key, value) {
                            $('#city').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                })
            });
        });
    </script>
@endsection
