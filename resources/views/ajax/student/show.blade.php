@extends('layout.app')
@section('title', 'Show Student')
@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="table-responsive col-md-9">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="student_data">

            </tbody>

        </table>
    </div>

</div>

@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $.ajax({
            url:"{{route('fetch-student')}}",
            type: "GET",
            contentType: false,
            processData: false,
            success:function(data){
                $("#student_data").html(data);

            }
        })
    })
</script>
@endsection
