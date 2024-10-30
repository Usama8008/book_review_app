@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> {{session('success')}}
  </div>
@endif

@if (session('error'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Error!</strong> {{session('error')}}
  </div>
@endif

<script>
    // Dismiss alert after 5 seconds
    setTimeout(function() {
        let alertElements = document.querySelectorAll('.alert');
        alertElements.forEach(function(alert) {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 3000);
</script>

