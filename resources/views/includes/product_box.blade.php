<div class="card">
    <div class="card-body">

        <div class="row border-bottom">
            <div class="col-sm-5 bg-light p-2"><b>SKU</b></div>
            <div class="col-sm-7 p-2">{{ $product->sku }}</div>
        </div>
        <div class="row border-bottom">
            <div class="col-sm-5 bg-light p-2"><b>Name</b></div>
            <div class="col-sm-7 p-2">{{ $product->name }}</div>
        </div>
        <div class="row border-bottom">
            <div class="col-sm-5 bg-light p-2"><b>Description</b></div>
            <div class="col-sm-7 p-2">{{ $product->description }}</div>
        </div>
    </div>
</div>