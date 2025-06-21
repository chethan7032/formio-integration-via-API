<!DOCTYPE html>
<html>
<head>
    <title>Form Submissions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #2A7B9B;
background: linear-gradient(90deg, rgba(42, 123, 155, 1) 0%, rgba(87, 199, 133, 1) 50%, rgba(188, 214, 99, 1) 84%, rgba(237, 221, 83, 1) 100%);
            min-height: 100vh;
        }
        .submission-card {
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .submission-card:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body class="container py-5">
    <h2 class="mb-4 text-center">📝 Contact Form Submissions</h2>

    <form method="GET" action="{{ url('/submissions') }}" class="row mb-4">
        <div class="col-md-4">
            <input type="text" name="email" value="{{ request('email') }}" class="form-control" placeholder="Search by email">
        </div>
        <div class="col-md-4">
            <input type="date" name="date" value="{{ request('date') }}" class="form-control">
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    @if(count($submissions) === 0)
        <div class="alert alert-warning text-center">No submissions match your filter.</div>
    @else
        <div class="row g-4">
            @foreach($submissions as $submission)
                <div class="col-md-6 col-lg-4">
                    <div class="card submission-card border-primary h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $submission['data']['name'] ?? 'No Name' }}</h5>
                            <p class="card-text mb-1"><strong>Email:</strong> {{ $submission['data']['email'] ?? '-' }}</p>
                            <p class="card-text mb-2"><strong>Message:</strong> {{ $submission['data']['message'] ?? '-' }}</p>
                            <p class="text-muted small mb-0">
                                <strong>Submitted:</strong> 
                                {{ \Carbon\Carbon::parse($submission['created'])->format('Y-m-d H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-5 text-center">
            @if(request()->has('page') && count($submissions) >= 6)
                <a href="{{ url('/submissions') }}?page={{ request('page') + 1 }}&email={{ request('email') }}&date={{ request('date') }}" class="btn btn-outline-primary">Load More</a>
            @elseif(!request()->has('page') && count($submissions) >= 6)
                <a href="{{ url('/submissions') }}?page=2&email={{ request('email') }}&date={{ request('date') }}" class="btn btn-outline-primary">Load More</a>
            @endif
        </div>
    @endif
</body>
</html>
