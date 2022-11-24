<!DOCTYPE html>
<html>
<head>
    <title>Category List Pdf</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>

  
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Category Price</th>
            <th>Category Quantity</th>
            <th>Category Created_At</th>

        </tr>
        @foreach($categorys as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->category_name }}</td>
            <td>{{ $category->category_price }}</td>
            <td>{{ $category->category_quantity }}</td>
            {{$created=isset($category->created_at) ? date('d/m/Y',strtotime($category->created_at)) : '-'}}
            <td>{{$created }}</td>
        </tr>
        @endforeach
    </table>
  
</body>
</html>