@extends('layout.app')
@section('main')
<div class="container">
    <div class="row my-5">
        @include('Account.profile.sidebar')
        <div class="col-md-9">
            @include('Account.message')
            <div class="card border-0 shadow">
                <div class="card-header  text-white">
                    Books
                </div>
                <div class="card-body pb-0">       
                    <div class="d-flex justify-content-between">
                        <a href="{{route('book.create')}}" class="btn btn-primary">Add Book</a>
                        <form action="{{route('book.index')}}" method="GET">
                        <div class="d-flex">
                            <input type="text" class="form-control " value="{{Request::get('keyword')}}" name="keyword" placeholder="search by Keyword">
                            <button type="submit" class="btn btn-primary ms-2">Search</button>
                            <a href="{{route('book.index')}}" class="btn btn-secondary ms-2">clear</a>
                        </div>
                    </form> 
                    </div>     
                    <table class="table  table-striped mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th width="150">Action</th>
                            </tr>
                            <tbody>
                                @if (!empty($books))
                                @foreach ($books as $book)
                                <tr>
                                    <td>{{$book->title}}</td>
                                    <td>{{$book->author}}</td>
                                    @if ($book->status==1)
                                    <td class="text-success">Active</td>
                                    @else
                                    <td class="text-danger">blocked</td>
                                    @endif
                                    
                                    <td>
                                        <a href="#" class="btn btn-success btn-sm"><i class="fa-regular fa-star"></i></a>
                                        <a href="{{ route('book.edit', $book->id) }}" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                                        
                                        <form action="{{ route('book.destroy', $book->id) }}" method="post" class="d-inline" onsubmit="return confirmDelete()">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                    <script>
                                        function confirmDelete() {
                                            return confirm('Are you sure you want to delete this book?');
                                        }
                                    </script>
                                </tr>
                                @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5">No Record Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </thead>
                    </table>   
                   {{$books->links('pagination::bootstrap-5')}}                 
                </div>
                
            </div>                 
        </div>
    </div>       
</div>
@endsection