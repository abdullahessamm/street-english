<div class="form-group row">
    <label class="col-md-3 label-control" for="duration">Price</label>
    <div class="col-md-9">
        <input type="number" min="0" id="price" class="form-control" name="price" value="{{ $Course != null ? $Course->price : null }}" required>
    </div>
</div>