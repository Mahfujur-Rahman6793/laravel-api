<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div class="container">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif

        <h3>Add product</h3>
        <div class="box-body">
            <form action="{{route('add-product')}}" method="post">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Model</th>
                                <th>Company</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="product-container">
                            <tr class="more-product">
                                <td>
                                    <div class="form-control">
                                        <input type="text" name="name[]" class="form-control" placeholder="Product Name">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-control">
                                        <input type="text" name="model[]" class="form-control" placeholder="Product Model">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-control">
                                        <input type="text" name="company[]" class="form-control" placeholder="Product Company">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-control">
                                        <input type="text" name="price[]" class="form-control" placeholder="Product Price">
                                    </div>
                                </td>
                                <td>
                                    <a role="button" class="btn btn-danger remove-btn">X</a>
                                </td>

                            </tr>

                        </tbody>
                        <tfoot>
                                <tr>
                                    <td colspan="5">
                                        <a role="button" class="btn btn-warning" id="btn_add_product">Add More</a>
                                    </td>

                                </tr>
                                </tfoot>

                    </table>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </div>
            </form>

        </div>
        .

        <template id="template-product">
             <tr class="more-product">
                                <td>
                                    <div class="form-control">
                                        <input type="text" name="name[]" class="form-control" placeholder="Product Name" required>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-control">
                                        <input type="text" name="model[]" class="form-control" placeholder="Product Model" required>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-control">
                                        <input type="text" name="company[]" class="form-control" placeholder="Product Company" required>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-control">
                                        <input type="text" name="price[]" class="form-control" placeholder="Product Price" required>
                                    </div>
                                </td>
                                <td>
                                    <a role="button" class="btn btn-danger remove-btn" >X</a>
                                </td>

                            </tr>
        </template>
    </div>

    <script>
        $(document).ready(function(){
            $('#btn_add_product').click(function(e){
                e.preventDefault();
                var moreProducts = $('#template-product').html();
                $('#product-container').append(moreProducts);


            });
            $(document).on('click', '.remove-btn', function(e){
                e.preventDefault();
                $(this).closest('.more-product').remove();
            });

        })
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
