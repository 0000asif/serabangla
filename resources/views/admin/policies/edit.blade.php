@extends('admin.masterAdmin')
@section('content')

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3>Edit {{ ucfirst($policy->type) }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.policies.update', $policy->type) }}" method="POST">
                @csrf
                @method('PUT')
                <textarea id="policyContent" name="content">{{ old('content', $policy->content) }}</textarea>
                <button type="submit" class="btn btn-success mt-3">Update</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    if (!window.editorInitialized) {
        ClassicEditor.create(document.querySelector('#policyContent')).catch(console.error);
        window.editorInitialized = true;
    }
});
</script>

@endsection