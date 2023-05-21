<form class="row g-3 needs-validation mt-4" method="POST" novalidate>
    <div class="col-12">
        <label for="email-username" class="form-label fw-bold fs-4 text-primary">Title</label>
        <input type="text" class="form-control rounded-0" id="email-username" name="email-username" required>
        <div class="invalid-feedback">
        </div>
    </div>

    <div class="col-12">
        <label class="fw-bold fs-4 mb-1 text-primary" for="description">Description:</label>
        <textarea class="form-control" id="description" style="height: 100px"></textarea>
    </div>
    
    <div class="col-12">
        <div class="row">
            <p  class="fw-bold fs-4 text-primary" >Destinations:</p>
        </div>
        <div class="row">
            <div class="col-4 ps-4">
                <label class="fw-bold" for="destination">Add destination:</label>
                <div class="input-group">
                    <input type="text" class="form-control" aria-label="Text input with checkbox">
                    <input class="btn btn-primary" type="submit" value="Post" name="signup" id="post-submit" autocomplete="on">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8 pt-4 ps-4">
                <ul class="list-group">
                    <li class="list-group-item" aria-current="true">fedfe</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                    <li class="list-group-item">A fourth item</li>
                    <li class="list-group-item">And a fifth one</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="col-md-3 d-grid pe-1 float-end">
            <input class="btn btn-primary btn-lg" type="submit" value="Post" name="signup" id="post-submit" autocomplete="on">
        </div>
    </div>
</form>