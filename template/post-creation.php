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
        <p  class="fw-bold fs-4 text-primary" >Destionations:</p>
        <div class="row">
            <label for="destination">Add destination:</label>
            <div class="col-6">
                <input type="text" class="form-control rounded-0" id="destination" name="destination" required>
            </div>
            <div class="col-6">
                <input class="btn btn-primary btn-lg rounded-0" type="submit" value="Add" name="Add" id="add" autocomplete="on">
            </div>
        </div>
        <div class="row">
            <ul class="list-group">
                <li class="list-group-item active" aria-current="true">fedfe</li>
                <li class="list-group-item">A second item</li>
                <li class="list-group-item">A third item</li>
                <li class="list-group-item">A fourth item</li>
                <li class="list-group-item">And a fifth one</li>
            </ul>
        </div>
    </div>

    <div class="col-12">
        <div class="col-md-3 d-grid pe-1 float-end">
            <input class="btn btn-primary btn-lg rounded-0" type="submit" value="Post" name="signup" id="post-submit" autocomplete="on">
        </div>
    </div>
</form>