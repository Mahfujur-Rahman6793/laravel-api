<!DOCTYPE html>
<html>

<head>
    <title>Location Dropdowns</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>



    <div class="container mt-5">
        <h2>Select Location</h2>
        <div class="mb-3 col-md-6">
        <label for="city" class="form-label">City</label>
        <select id="city" class="form-select">
            <option value="">Select City</option>
        </select>
    </div>

    <div class="mb-3 col-md-6">
        <label for="district" class="form-label">District</label>
        <select id="district" class="form-select">
            <option value="">Select District</option>
        </select>
    </div>

    <div class="mb-3 col-md-6">
        <label for="thana" class="form-label">Thana</label>
        <select id="thana" class="form-select">
            <option value="">Select Thana</option>
        </select>
    </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ route('cities') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#city').empty();
                    $('#city').append('<option value="">Select City</option>');
                    $.each(data, function(key, value) {
                        $("#city").append(`<option value="${value.id}">${value.name}</option>`);
                    });

                }
            })
            $("#city").change(function() {
                var cityId = $(this).val();
                if (cityId) {
                    let fullUrl = "{{ url('/api/districts') }}/" + cityId;
                    $.ajax({
                        url: fullUrl,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $("#district").empty();
                            $("#district").append(`<option value="">Select district</option>`)
                            $.each(data, function(key, value) {
                                $("#district").append(
                                    `<option value="${value.id}">${value.name}</option>`
                                    );
                            });
                        }
                    })
                }

            })

            $("#district").change(function() {
                var districtId = $(this).val();
                console.log(districtId);

                if (districtId) {
                    let fullUrl = "{{ url('api/thanas') }}/" + districtId;
                    $.ajax({
                        url: fullUrl,
                        type: "GET",
                        dataType: "json",

                        success: function(data) {
                            $("#thana").empty();
                            $("#thana").append(`<option value="">Select Thana</option>`);
                            $.each(data, function(key, value) {
                                $("#thana").append(
                                    `<option value="${value.id}">${value.name}</option>`
                                    )
                            });
                        }
                    })
                }
            })
        })
    </script>



</body>

</html>
