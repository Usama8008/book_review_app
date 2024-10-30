<footer class="bg-dark text-light py-5">
    <div class="container">
        <div class="row">
            <!-- About Section -->
            <div class="col-md-4">
                <h5 class="text-uppercase mb-4">About BookReviewApp</h5>
                <p>Discover insightful reviews of your favorite books. Join a community of book enthusiasts and contribute your thoughts and ratings. Your next read awaits!</p>
            </div>

            <!-- Quick Links Section -->
            <div class="col-md-4">
                <h5 class="text-uppercase mb-4">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{route('home')}}" class="text-light text-decoration-none">Home</a></li>
                    <li><a href="{{route('home')}}" class="text-light text-decoration-none">Books</a></li>
                    <li><a href="/contact" class="text-light text-decoration-none">Contact Us</a></li>
                </ul>
            </div>

            <!-- Newsletter Section -->
            <div class="col-md-4">
                <h5 class="text-uppercase mb-4">Subscribe to our Newsletter</h5>
                <form action="#" method="POST">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Enter your email" required>
                        <button class="btn btn-primary" type="submit">Subscribe</button>
                    </div>
                </form>
                <p>Get the latest book reviews and recommendations right in your inbox!</p>
            </div>
        </div>

        <!-- Social Media Links and Copyright -->
        <div class="row mt-4">
            <div class="col-md-6">
                <p class="mb-0">© 2024 BookReviewApp. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="#" class="text-light me-3"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-light"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>
</footer>

{{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
@yield('script')
</body>
</html>