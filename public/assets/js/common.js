$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var table;
function createDatatable(url, columns) {
    table = $('#dataTable').DataTable({
        ajax: {
            data: function (d) {
                d._token = $('meta[name="csrf-token"]').attr('content');
            },
            url: url,
            type: 'POST',
        },
        serverSide: true,
        processing: true,
        aaSorting: [[0, "desc"]],
        columns: columns,
    });
}

function reload() {
    table.ajax.reload("null", false);
}

function aaa(icon,title,text){
    Swal.fire({
    icon: icon,
    title: title,
    text: text,
  });
}
$(document).on('click', '.btnDelete', function () {
    var id = $(this).data('id');
    var url = $(this).data('url');
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    id: id,
                    "_token": $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
            }).done(function (data) {
                if (data == true) {
                    aaa('success','Record Deleted Successfully','Success')
                } else {
                    
                }
                reload();
            }).fail(function (jqXHR, status, exception) {
                if (jqXHR.status === 0) {
                    error = 'Not connected.\nPlease verify your network connection.';
                } else if (jqXHR.status == 404) {
                    error = 'The requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    error = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    error = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    error = 'Time out error.';
                } else if (exception === 'abort') {
                    error = 'Ajax request aborted.';
                } else {
                    error = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                Toast.fire({ icon: 'error', title: error })
            });
        }
    })
});

