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
                <div class="col-lg-12">
                    <div class="block">
                        <div class="title"><strong class="d-block">Create New {{ $title }}</strong></div>
                        <div class="block-body">
                            <form action="{{ url('store_book') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="form-control-label">Book Title</label>
                                    <input type="text" name="title" placeholder="Book Title"
                                        class="form-control" required>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label class="form-control-label">Book Category</label>
                                        <select name="book_category" class="form-control" required>
                                            <option value="">Choose Category</option>
                                            @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->cat_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col">
                                        <label class="form-control-label">Author Name</label>
                                        <input type="text" name="author_name" placeholder="Author Name"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Book Description</label>
                                    <textarea class="form-control" name="description" id="" cols="30" rows="4"></textarea>
                                </div>

                                <div class="row">

                                    <div class="form-group col">
                                        <label class="form-control-label">Book Price</label>
                                        <input type="number" name="price" class="form-control">
                                    </div>

                                    <div class="form-group col">
                                        <label class="form-control-label">Quantity</label>
                                        <input type="number" name="quantity" class="form-control">
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group col">
                                        <label class="form-control-label">Book Image</label>
                                        <input type="file" name="book_image" class="form-control">
                                    </div>
                                    <div class="form-group col">
                                        <label class="form-control-label">Author Image</label>
                                        <input type="file" name="author_image" class="form-control">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Create" class="btn btn-primary">
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
