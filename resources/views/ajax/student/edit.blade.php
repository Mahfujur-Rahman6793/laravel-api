@extends('layout.app')
@section('title', 'Edit Student')
@section('content')
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card col-md-9 shadow-lg">
            <div class="card-header">
                <h3>Create Student</h3>
            </div>
            <div class="card-body">
                <form id="student_details">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name : </label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $student->name) }}" placeholder="Enter Student Name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email : </label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email', $student->email) }}"placeholder="Enter Student Email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone : </label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ old('phone', $student->phone) }}"placeholder="Enter Student Phone" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label">Image : </label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">

                            @if ($student->image)
                                <p class="mt-2">Current Image:</p>
                                <img src="{{ asset('images/' . $student->image) }}" width="100" height="100"
                                    alt="Student Image">
                            @endif
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary float-end">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
    $(document).ready(function(){
        $('#student_details').submit(function(event) {
                event.preventDefault();

                var form = $('#student_details')[0];
                var studentData = new FormData(form);
                let fullUrl = "{{ url('/edit-student') }}/{{ $student->id }}";
                $.ajax({
                    url:fullUrl,
                    type: "POST",
                    data: studentData,
                    contentType: false,
                    processData: false,
                    success:function(data){
                        window.location.href = data.route_redirect;
                    },
                    error: function(e) {
                        console.error('Error creating student');
                    }
                });

        })
    })
</script>
@endsection
