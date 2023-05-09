<div class="form-group row">
    <label class="col-md-3 label-control" for="duration">Price</label>
    <div class="col-md-9">
        <input type="number" min="0" pattern="[0-9]+" id="price" class="form-control" name="price" value="{{ isset($Course->discount) ? $Course->discount->price : null }}" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 label-control" for="discount">Discount</label>
    <div class="col-md-9">
        <input type="number" min="0" pattern="[0-9]+" id="discount" class="form-control" name="discount" value="{{ isset($Course->discount) ? $Course->discount->discount : null }}" required>
    </div>
</div>
