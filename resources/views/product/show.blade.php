@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="row gy-1">
                    <div class="col-6 text-start">
                        <h2>Show Product</h2>
                    </div>
                    <div class="col-6 text-end">
                        <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
                    </div>
                </div>
            </div>

            <div class="card p-2">

                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="code" class="form-label">Code:</label>
                                <input disabled type="text" class="form-control" id="code" name="code" placeholder="Code" value="{{ $product->code }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input disabled type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $product->name }}">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description:</label>
                                <textarea class="form-control date" id="description" name="description" placeholder="Description">{{ $product->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="category" class="form-label">Category:</label>
                                <input disabled type="text" class="form-control" id="category" name="category" placeholder="Category" value="{{ $product->category }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="selling_price" class="form-label">Selling Price:</label>
                                <input disabled type="text" class="form-control" id="selling_price" name="selling_price" placeholder="selling_price" value="{{ $product->selling_price }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="special_price" class="form-label">Special Price:</label>
                                <input disabled type="text" class="form-control" id="special_price" name="special_price" placeholder="special_price" value="{{ $product->special_price }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Product Status:</label>
                                <select name="status" id="status" class="form-control">
                                    <?php
                                    $selected = "";
                                    ?>
                                    @foreach($product_status as $value => $label)
                                    <?php
                                    $selected = ($product->status == $value) ? "selected" : "";
                                    ?>
                                    <option {{ $selected }} value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Is Delivery Available:</label>
                                <?php
                                $checked = ($product->is_delivery_available == 1) ? "checked" : "";
                                $notchecked = ($product->is_delivery_available == 0) ? "checked" : "";
                                ?>
                                <div class="form-check">
                                    <input disabled type="radio" name="is_delivery_available" id="status_active" value="1" class="form-check-input disabled" {{ $checked }}>
                                    <label for="status_active" class="form-check-label">Available</label>
                                </div>
                                <div class="form-check">
                                    <input disabled type="radio" name="is_delivery_available" id="status_inactive" value="0" class="form-check-input disabled" {{ $notchecked }}>
                                    <label for="status_inactive" class="form-check-label">Not Available</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="product_image" class="form-label">Product Image:</label>
                                <br>
                                <div class="row">
                                    @if($product->image_path != "")
                                    <div class="col-lg-1">
                                        <img src="{{url('images')}}\{{$product->image_path}}" alt="Uploaded Image" width="200">
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Product Attributes:</label>

                                <table id="pro_attr_table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Value</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody id="attBody">

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <input disabled type="hidden" name="pro_attr_array" id="pro_attr_array" value="{{$attributes_json}}">
                </form>

            </div>
        </div>
    </div>
</div>


@endsection

@section("scripts")
<script>
    var product_attributed_array = [];

    $(document).ready(function() {
        product_attributed_array = <?php echo $attributes_json ?>;
        console.log(product_attributed_array);
        draw_table();
    });

    var add_attr = () => {
        var att_name = $("#att_name").val();
        var att_value = $("#att_value").val();
        if (att_name != "" && att_value != "") {
            product_attributed_array.push({
                att_name: att_name,
                att_value: att_value
            });
            draw_table();
        } else {
            alert("Please add Attribute name and value.")
        }
    }

    var remove_attr = (att_name) => {
        product_attributed_array = product_attributed_array.filter(function(item) {
            return item.att_name !== att_name;
        });
    };

    var remove_attr_by_index = (index) => {
        if (index >= 0 && index < product_attributed_array.length) {
            product_attributed_array.splice(index, 1);
            draw_table();
        }
    };

    var draw_table = () => {
        if (product_attributed_array.length > 0) {
            var tableBody = $('#pro_attr_table tbody');
            tableBody.empty(); // Clear existing rows

            product_attributed_array.forEach(function(item, index) {
                var row = $('<tr>');
                row.append($('<td>').text(item.att_name));
                row.append($('<td>').text(item.att_value));
                tableBody.append(row);
            });
            $("#pro_attr_array").val(JSON.stringify(product_attributed_array));
        }
    }
</script>
@endsection