@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Pages</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ul>
    </div>
    <section class="no-padding-top">
        <div class="container-fluid">
            <div>
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <div class="row">
                <!-- Basic Form-->
                <div class="col-lg-5">
                    <div class="block">
                        <div class="title"><strong class="d-block">Create New {{ $title }}</strong></div>
                        <div class="block-body">
                            <form action="{{ url('add_category') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="form-control-label">Category Name</label>
                                    <input type="text" name="category" placeholder="Category Name" class="form-control"
                                        required>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Create" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="block margin-bottom-sm" style="background: gray-100">
                        <div class="title"><strong>{{ $title }} Table</strong></div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->cat_title }}</td>
                                            <td>
                                                <div class="mb-2">
                                                    <a href="{{ url('edit_category/' . $item->id) }}"
                                                        class="btn btn-info btn-sm mr-2"><i class="fa fa-pencil"
                                                            style="color: white"></i></a>
                                                    <a href="{{ url('delete_category/' . $item->id) }}"
                                                        class="btn btn-warning btn-sm mr-2"
                                                        onclick="confirmation(event)"><i
                                                            class="fa fa-trash" style="color: white"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
    </section>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>

    <script>
        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            swal({
                title: "Are you sure to delete this?",
                text: "You will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = urlToRedirect;
                    }
                });
        }
    </script>
@endsection
