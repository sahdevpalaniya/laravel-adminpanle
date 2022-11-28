<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4> {{ isset($page_title) ? $page_title : 'Page Title' }}</h4>
            <span class="ml-1">Datatable</span>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}"> {{ isset($back_page_title) ? $back_page_title : 'Page Title' }}</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">
                    {{ isset($page_title) ? $page_title : 'Page Title' }}</a></li>
        </ol>
    </div>
</div>
