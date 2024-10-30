<div class="col-md-3">
    <div class="card border-0 shadow-lg">
        <div class="card-header  text-white">
            Hi, {{Auth::user()->name}} ({{Auth::user()->role}})                       
        </div>
        <div class="card-body">
            <div class="text-center mb-3">
                @if (Auth::user()->image)
                <img src="{{ asset('storage/' . Auth::user()->image) }}" class="img-fluid rounded-circle" alt="{{ Auth::user()->name }}" style="max-width: 150px; height: auto;">
            @else
                <img src="{{ asset('assets/images/default-profile.png') }}" class="img-fluid mt-4" alt="Default Profile" style="max-width: 150px; height: auto;">
            @endif                            
            </div>
            <div class="h5 text-center">
                <strong>{{Auth::user()->name}}</strong>
                <p class="h6 mt-2 text-muted"> {{ (Auth::user()->reviews->count() > 1) ? 
                                                            Auth::user()->reviews->count(). 'Reviews' : 
                                                            Auth::user()->reviews->count(). 'Review' }}</p>
            </div>
        </div>
    </div>
    <div class="card border-0 shadow-lg mt-3">
        <div class="card-header  text-white">
            Navigation
        </div>
        <style>
            .nav a {
                text-decoration: none; 
                padding: 10px 15px; 
                display: block;
                color: #333;
                border-radius: 4px;
                transition: color 0.3s;
            }

            .nav a:hover {
                color: #007bff !important; 
            }

            .nav a.active {
                color: #007bff !important; 
                font-weight: bold; 
            }
            .nav-item {
                margin-bottom: 5px;
            }

        </style>
       <div class="card-body sidebar">
        <ul class="nav flex-column">
            @if (Auth::user()->role == 'admin')
            <li class="nav-item">
                <a href="{{ route('book.index') }}" class="{{ request()->routeIs('book.index') ? 'active' : '' }}">Books</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('reviews.index') }}" class="{{ request()->routeIs('reviews.index') ? 'active' : '' }}">Reviews</a>
            </li>
            @endif
    
            <li class="nav-item">
                <a href="{{ route('account.profile') }}" class="{{ request()->routeIs('account.profile') ? 'active' : '' }}">Profile</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('Myreviews.index') }}" class="{{ request()->routeIs('Myreviews.index') ? 'active' : '' }}">My Reviews</a>
            </li>
            <li class="nav-item">
                <a href="change-password.html" class="{{ request()->is('change-password.html') ? 'active' : '' }}">Change Password</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('account.logout') }}" class="{{ request()->routeIs('account.logout') ? 'active' : '' }}">Logout</a>
            </li>
        </ul>
    </div>
    
        
    </div>
</div>