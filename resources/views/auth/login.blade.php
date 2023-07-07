@section('title', 'Login')
<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head');
</head>

<body>
    <script src="{{ asset('') }}assets/static/js/initTheme.js"></script>
    <div class="container">
        <div class="row justify-content-center vh-100 align-items-center">
            <div class="col-lg-5 col-md-6 col-12">
                @if (Session::has('status'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <h3 class="mb-4">Manajemen Desa Kamasan</h3>
                            <h4>Login</h4>
                        </div>
                        <form action="{{ route('auth.authenticate') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="Username" class="form-label">Username</label>
                                        <input type="text" class="form-control" name="username">
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <div class="form-group">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
