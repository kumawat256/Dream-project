<!doctype html>
<html lang="en">
    <head>
        <title>home</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <link rel="stylesheet" href="{{url('assets/css/style.css')}}">

    </head>
    <body>

        @yield('content')

    <script src="{{url('assets/js/jquery.min.js')}}"></script>
    <script src="{{url('assets/js/popper.js')}}"></script>
    <script src="{{url('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{url('assets/js/main.js')}}"></script>
    <script src="{{url('assets/js/custom.js')}}"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    {{-- <script type="text/javascript">
        $(function () {
            
          var table = $('.data-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('dashboard') }}",
              columns: [
                  {data: 'id', name: 'id'},
                  {data: 'name', name: 'name'},
                  {data: 'email', name: 'email'},
                  {data: 'status', name: 'status'},
                  {data: 'created_at', name: 'created_at'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });
            
        });
      </script> --}}

    </body>
</html>