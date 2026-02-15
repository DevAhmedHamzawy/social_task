<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ConnectHub - Social Network</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .hero {
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .feature-card {
            transition: 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .footer {
            background: #212529;
            color: white;
            padding: 30px 0;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">ConnectHub</a>

            <div class="ms-auto">
                @auth
                    <a href="{{ route('home') }}" class="btn btn-success">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-success">Sign Up</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="display-4 fw-bold">Connect With The World</h1>
            <p class="lead mt-3">
                Share your moments, follow friends, and build your community.
            </p>

            @guest
                <a href="{{ route('register') }}" class="btn btn-light btn-lg mt-4 px-5">
                    Get Started
                </a>
            @endguest
        </div>
    </section>

    <!-- Features -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Why Choose ConnectHub?</h2>
                <p class="text-muted">Everything you need in one platform</p>
            </div>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card feature-card shadow-sm h-100 text-center p-4">
                        <h4 class="fw-bold">Share Posts</h4>
                        <p class="text-muted">
                            Upload text, images and videos and share your story.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card feature-card shadow-sm h-100 text-center p-4">
                        <h4 class="fw-bold">Follow Friends</h4>
                        <p class="text-muted">
                            Connect with people and stay updated with their lives.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card feature-card shadow-sm h-100 text-center p-4">
                        <h4 class="fw-bold">Private Messaging</h4>
                        <p class="text-muted">
                            Chat securely and instantly with your friends.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Call To Action -->
    <section class="bg-light py-5 text-center">
        <div class="container">
            <h3 class="fw-bold">Ready to join?</h3>
            <p class="text-muted">Create your free account today.</p>

            @guest
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5">
                    Join Now
                </a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <p class="mb-0">
                © {{ date('Y') }} ConnectHub. All rights reserved.
            </p>
        </div>
    </footer>

</body>

</html>
