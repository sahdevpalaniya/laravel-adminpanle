{{-- @extends('admin.layouts.app')
@if (isset($page_title) && $page_title != '')
    @section('title', $page_title . '|' . config('app.name'))
@else
    @section('title', '|' . config('app.name'))
@endif
@section('content') --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ isset($page_title) ? $page_title : 'Pagea title' }}</h4>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form class="form-valide" action="{{ route('store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    @if (isset($category))
                                        <input type="hidden" name="id" id="id" value="{{ $category->id }}">
                                    @endif
                                    <label class="form-label">Category
                                        Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="category_name" id="category_name"
                                        value="{{ isset($category) ? $category->category_name : old('category_name') }}">
                                    @error('category_name')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Category
                                        Price<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="category_price" id="category_price"
                                        value="{{ isset($category) ? $category->category_price : old('category_price') }}">
                                    @error('category_price')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">Category
                                        Quantity<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="category_quantity"
                                        id="category_quantity"
                                        value="{{ isset($category) ? $category->category_quantity : old('category_quantity') }}">
                                    @error('category_quantity')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Category
                                        Status<span class="text-danger">*</span></label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" value="1"
                                            {{ isset($category) && $category->status != 0 ? 'checked' : 'checked' }}>
                                        <label class="form-check-label" for="1">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" value="0"
                                            {{ isset($category) && $category->status == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="0">Deactive</label>
                                    </div>
                                </div>
                            </div><br>

                            <div>
                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                                <a href="{{ route('category_list') }}" class="btn btn-dark w-md">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    {{-- @endsection --}}
