<div class="form-group row">
    <label class="col-md-3 label-control" for="book">
        Book Google Drive Link
    </label>
    <div class="col-md-9">
        <input type="url" id="book" class="form-control" name="book" {{ $book_id == null ? 'required' : null }}>
    </div>
</div>