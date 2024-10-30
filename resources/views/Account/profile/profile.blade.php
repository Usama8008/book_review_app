@extends('layout.app')
@section('main')
<div class="container">
    <div class="row my-5">
        @include('Account.profile.sidebar')
        <div class="col-md-9">
            @include('Account.message')
            <div class="card border-0 shadow">
                <div class="card-header  text-white">
                    Profile
                </div>
                <div class="card-body">
                    <form action="{{ route('account.updateProfile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" id="name" />
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" id="email"/>
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="image" class="form-label">Profile Image</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                            
                            <!-- Display current profile image or default image if none -->
                            @if ($user->image)
                                <img src="{{ asset('storage/' . $user->image) }}" class="img-fluid mt-4" alt="{{ $user->name }}" style="max-width: 150px; height: auto;">
                            @else
                                <img src="{{ asset('assets/images/default-profile.png') }}" class="img-fluid mt-4" alt="Default Profile" style="max-width: 150px; height: auto;">
                            @endif
                            
                            @error('image')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <button class="btn btn-primary mt-2">Update</button>
                    </form>
                              
                </div>
            </div>                
        </div>
    </div>       
</div>
@endsection