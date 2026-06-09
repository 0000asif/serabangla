<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $policy->title ?? 'Policy' }}</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }

        .policy-card {
            border-radius: 10px;
            border: none;
        }

        .policy-content h2,
        .policy-content h3 {
            margin-top: 25px;
            font-weight: bold;
        }

        .policy-content p {
            margin-bottom: 15px;
            line-height: 1.8;
        }

        .policy-content ul {
            padding-left: 20px;
        }

        .back-btn {
            padding: 10px 35px;
        }
    </style>
</head>

<body>
    @php
    use App\Models\Setting;
    $settings = Setting::first();
    @endphp

    <div class="container py-5">

        {{-- Page Header --}}
        <div class="text-center mb-4">
            <h1 class="fw-bold">{{ $settings->site_title }} -
                @if ($policy->type == 'terms')
                Terms And Condition
                @else
                Privacy Policy
                @endif
            </h1>

            @if($policy->updated_at)
            <p class="text-muted">
                সর্বশেষ আপডেট: {{ $policy->updated_at->format('d M, Y') }}
            </p>
            @endif
        </div>

        {{-- Policy Card --}}
        <div class="card shadow-sm policy-card">
            <div class="card-body p-4 policy-content">

                {{-- Dynamic Policy Content --}}
                {!! $policy->content !!}

            </div>
        </div>

        {{-- Back Button --}}
        <div class="text-center mt-4">
            <a href="{{ url('/') }}" class="btn btn-primary back-btn">
                হোমে ফিরে যান
            </a>
        </div>

    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>