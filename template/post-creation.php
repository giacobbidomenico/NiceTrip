<form class="g-3 mt-4 ps-4 pe-4 needs-validation" method="POST" novalidate>
    <div class="row">
        <label for="email-username" class="form-label fw-bold fs-4 text-primary">Title</label>
        <input type="text" class="form-control" id="email-username" name="email-username" required>
        <div class="invalid-feedback">
        </div>
    </div>

    <div class="row mt-2">
        <label class="fw-bold fs-4 mb-1 text-primary" for="description">Description:</label>
        <textarea class="form-control" id="description" style="height: 100px"></textarea>
    </div>

    <div class="row mt-2">
        <p class="fw-bold fs-4 text-primary">Destinations:</p>
        <div class="border border-light-subtle pt-1 pb-4">
            <div class="row pt-3">
                <div id="search-field-container" class="col-11">
                    <label class="fw-bold" for="destination">Add destination:</label>
                    <input name="destinations" list="destinations-suggests" class="form-control" type='text' id='search-field' autocomplete="off" required/>
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
    
    <div class="row mt-5">
        <div class="col-9"></div>
        <div class="col-3 d-grid pe-1 float-end">
            <input class="btn btn-primary btn-lg" type="submit" value="Post" name="signup" id="post-submit" autocomplete="on" required/>
        </div>
    </div>
</form>
