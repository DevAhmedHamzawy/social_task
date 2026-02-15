<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>Control Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
            font-family: system-ui;
        }

        .panel-title {
            font-weight: bold;
            margin-bottom: 25px;
        }

        .card-link {
            text-decoration: none;
            color: inherit;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            transition: .2s;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .section-title {
            font-weight: bold;
            margin: 30px 0 15px;
            color: #555;
        }
    </style>
</head>

<body>

    <div class="container py-5">

        <h2 class="panel-title text-center">🚀 Social Network Control Panel</h2>

        {{-- Profile --}}
        <div class="section-title">👤 Profile</div>
        <div class="row g-3">
            <div class="col-md-4">
                <a href="{{ route('profile.edit') }}" class="card-link">
                    <div class="card card-hover p-3">Edit Profile</div>
                </a>
            </div>
        </div>

        {{-- Users --}}
        <div class="section-title">🧑‍🤝‍🧑 Users</div>
        <div class="row g-3">
            <div class="col-md-4">
                <a href="{{ route('users.index') }}" class="card-link">
                    <div class="card card-hover p-3">All Users</div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('users.search') }}" class="card-link">
                    <div class="card card-hover p-3">Search Users</div>
                </a>
            </div>
        </div>

        {{-- Friends --}}
        <div class="section-title">🤝 Friends</div>
        <div class="row g-3">
            <div class="col-md-4">
                <a href="{{ route('friends.list') }}" class="card-link">
                    <div class="card card-hover p-3">Friends List</div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('friend.pending') }}" class="card-link">
                    <div class="card card-hover p-3">Pending Requests</div>
                </a>
            </div>
        </div>

        {{-- Posts --}}
        <div class="section-title">📝 Posts</div>
        <div class="row g-3">
            <div class="col-md-4">
                <a href="{{ route('posts.index') }}" class="card-link">
                    <div class="card card-hover p-3">All Posts</div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('posts.create') }}" class="card-link">
                    <div class="card card-hover p-3">Create Post</div>
                </a>
            </div>
        </div>

        {{-- Other --}}
        <div class="section-title">⚡ Other</div>
        <div class="row g-3">
            <div class="col-md-4">
                <a href="{{ route('home') }}" class="card-link">
                    <div class="card card-hover p-3">Home</div>
                </a>
            </div>
        </div>

    </div>

</body>

</html>
