<div class="form-group row">
    <label class="col-md-3 label-control" for="price">Price</label>
    <div class="col-md-9">
        <input type="number" min="0" pattern="[0-9]+" id="price" class="form-control" name="price" value="{{ isset($onlineCourse->coupon) ? $onlineCourse->coupon->price : null }}" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 label-control" for="discount">Price after Discount</label>
    <div class="col-md-9">
        <input type="number" min="0" pattern="[0-9]+" id="discount" class="form-control" name="discount" value="{{ isset($onlineCourse->coupon) ? $onlineCourse->coupon->discount : null }}" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 label-control" for="coupon">Coupon</label>
    <div class="col-md-9">
        <input type="text" id="coupon" class="form-control" name="coupon" value="{{ isset($onlineCourse->coupon) ? $onlineCourse->coupon->coupon : null }}" required>
    </div>
</div>