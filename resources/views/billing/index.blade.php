@extends('layout.mastar')
@section('title','Billing')
@section('content')
<form id="BillingForm">
    <div class="card product-section p-3">
        <h3>Billing</h3>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Customer Email</label>
                <input type="email" name="email" id="email" class="form-control " placeholder="Enter Customer Email">
            </div>
        </div>
        <div class="bill-section">
            <div class="row">
                <div class="col mb-3 products">
                    <label class="form-label">Product ID</label>
                    <select name="product_id[]" class="form-select">
                        <option value="">Select Product ID</option>
                        @if(count($products) > 0)
                        @foreach ($products as $product)
                            <option value="{{ $product->product_id }}">{{ $product->name }}</option>
                        @endforeach
                        @endif
                    </select>
                    {{-- <input type="text" name="product_id[]"  class="form-control" placeholder="Enter Product ID"> --}}
                </div>
                <div class="col mb-3">
                    <label class="form-label">Quantity</label>
                    <input type="text" name="quantity[]"  class="form-control" placeholder="Enter Quantity">
                </div>
                <a href="javascript:void(0)" class="delete"> <i class="menu-icon tf-icons bx bx-trash text-danger"></i></a>
            </div>
        </div>
        <button type="button" class="btn btn-success add">Add</button>
    </div>
    <div class="card denomination-section p-3 mt-3">
        <h3>Denomination</h3>
            <div class="col-md-6 mb-3">
                <label  class="form-label">500</label>
                <input type="number" min="0" name="five_hundred" id="five_hundred"  class="form-control" >
            </div>
            <div class="col-md-6 mb-3">
                <label  class="form-label">50</label>
                <input type="number" min="0" name="fifty" id="fifty"  class="form-control" >
            </div>
            <div class="col-md-6 mb-3">
                <label  class="form-label">20</label>
                <input type="number" min="0" name="twenty" id="twenty"  class="form-control" >
            </div>
            <div class="col-md-6 mb-3">
                <label  class="form-label">10</label>
                <input type="number" min="0" name="ten" id="ten"  class="form-control" >
            </div>
            <div class="col-md-6 mb-3">
                <label  class="form-label">5</label>
                <input type="number" min="0" name="five" id="five"  class="form-control" >
            </div>
            <div class="col-md-6 mb-3">
                <label  class="form-label">2</label>
                <input type="number" min="0" name="two" id="two"  class="form-control" >
            </div>
            <div class="col-md-6 mb-3">
                <label  class="form-label">1</label>
                <input type="number" min="0" name="one" id="one"  class="form-control" >
            </div>
            <div class="col-md-6 mb-3">
                <label  class="form-label">Cash Paid By Customer</label>
                <input type="text" name="cash"  class="form-control" placeholder="Enter Cash Paid By Customer">
            </div>
            <div class="d-flex align-items-center justify-content-end">
                <button type="button" class="btn btn-dark cancel">Cancel</button>
                <button type="submit" class="btn btn-success" id="btn-submit">Generate Bill</button>
            </div>
    </div>
</form>
@endsection
@push('css')
<style>
    .add{
        float: right;
    }
    .delete {
        position: absolute;
    }
    .delete i{
        float: right;
    }
    .add{
        width: fit-content;
    }
    .cancel{
        margin-right: 10px;
    }
</style>
@endpush
@push('js')
<script>
$(document).ready(function () {
    var product_id = $('.products').html();
    $('.add').click(function(){
        let html = `        
        <div class="row">
            <div class="col mb-3">
                ${product_id}
            </div>
            <div class="col mb-3">
                <label class="form-label">Quantity</label>
                <input type="text" name="quantity[]"  class="form-control" placeholder="Enter Quantity">
            </div>
            <a href="javascript:void(0)" class="delete"> <i class="menu-icon tf-icons bx bx-trash text-danger"></i></a>
        </div>`;
        $('.bill-section').append(html);
    });
    $(document).on('click','.delete',function(){
        if($('.delete').length > 1)
        {
            $(this).parent().remove();
        }else{
            notifyWarning('Atleast one product is required');
        }
    });
    

    $('#BillingForm').validate({
        rules: {
            email: {
                required: true
            },
            five_hundred: {
                require_at_least_one: true
            },
            fifty: {
                require_at_least_one: true
            },
            twenty: {
                require_at_least_one: true
            },
            ten: {
                require_at_least_one: true
            },
            five: {
                require_at_least_one: true
            },
            two: {
                require_at_least_one: true
            },
            one: {
                require_at_least_one: true
            },
            cash: {
                required: true
            }
        },
        errorPlacement: function(error, element) {
            if (element.hasClass("select2-hidden-accessible")) {
                error.insertAfter(element.siblings('span.select2'));
            } else if (element.hasClass("floating-input")) {
                element.closest('.form-floating-label').addClass("error-cont").append(
                    error);
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            loadButton("#btn-submit");
            let formData = new FormData(form);
            $.ajax({
                type: "POST",
                url: "{{ route('billing.generate') }}",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(data) {
                    loadButton("#btn-submit");
                    if (data.success == 1) {
                        // notifySuccess(data.message);
                        window.location.href = `/generated-bill/${data.id}`
                    }else {
                        if (data.error && data.error != "") {
                            notifyWarning(data.error[0]);
                        } else {
                            notifyWarning(data.message);
                        }
                    }
                }
            })
        }
    })
})    
</script> 
@endpush
