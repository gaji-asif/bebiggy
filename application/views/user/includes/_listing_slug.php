<div class="col-xl-6">
    <div class="submit-field">
        <h5>Slug <span class='text-danger'>*</span></h5>
        <input type="text" id="listings_slug" name="slug" value="<?php if (isset($listing_data[0]['slug'])) echo $listing_data[0]['slug']; ?>" class="with-border mb-0 required" placeholder="slug"  required>
        <small id="emailHelp" class="form-text text-muted">Slug must be unique but you can edit it,if it is exists then random number added at end.</small>
    </div>
</div>