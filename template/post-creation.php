<form id="new-post-form" class="g-3 mt-4 ps-4 pe-4 needs-validation" method="POST" novalidate>
    <div class="row">
        <label for="email-username" class="form-label fw-bold fs-4 text-primary">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
        <div class="invalid-feedback">
        </div>
    </div>

    <div class="row mt-2">
        <label class="fw-bold fs-4 mb-1 text-primary" for="description">Description:</label>
        <textarea class="form-control" id="description" name="description" style="height: 100px" rows=11 cols=50 maxlength=250 required></textarea>
        <div class="invalid-feedback"></div>
    </div>

    <div class="row mt-2">
        <p class="fw-bold fs-4 text-primary">Destinations:</p>
        <div class="border border-light-subtle pt-1 pb-4">
            <div class="row pt-3">
                <div id="search-field-container" class="col-11">
                    <label class="fw-bold" for="destination">Add destination:</label>
                    <input name="destinations" list="destinations-suggests" class="form-control" type='text' id='search-field' autocomplete="off"/>
                    <datalist id="destinations-suggests">
                    </datalist>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-4">
                    <button class="btn btn-primary align-bottom" type="button" id="add-destination-button">Add</button>
                </div>
            </div>
            <div class="row mt-3" id="destinations-container">
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <p class="fw-bold fs-4 text-primary">Images:</p>
        <div class="border border-light-subtle pt-1 pb-4">
            <div class="row pt-3">
                <div class="col-11">
                    <label class="fw-bold form-label" for="images">Add image:</label>
                    <input id="images-field" class="form-control" type="file" id="formFileMultiple" multiple/>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-4">
                    <button class="btn btn-primary align-bottom" type="button" id="add-image-button">Add</button>
                </div>
            </div>
            <div class="row mt-3" id="images-container">
            </div>
        </div>
    </div>
    
    <div class="row mt-5 mb-5">
        <div class="col-7"></div>
        <div class="col-2">
            <img id="loading-icon" class="img-fluid" src="<?php echo UPLOAD_DIR."loading.gif";?>" hidden/>
        </div>
        <div class="col-3 d-grid pe-1 float-end">
            <input class="btn btn-primary btn-lg" type="submit" value="Post" name="post-submit" id="post-submit" required/>
        </div>
    </div>
</form>
