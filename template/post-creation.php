<form class="g-3 mt-4 ps-4 pe-4" method="POST">
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
        <div class="row">
            <p class="fw-bold fs-4 text-primary">Destinations:</p>
            <div class="col-3">
                <label class="fw-bold" for="destination">Add destination:</label>
                <input class="form-control" type='text' id='search-field' autocomplete="on"/>
            </div>
            <div class="col-4">
                <label class="fw-bold" for="start-time">Start Time:</label>
                <input class="form-control" type='datetime-local' id='start-time' autocomplete="on"/>
            </div>
            <div class="col-4">
                <label class="fw-bold" for="end-time">End Time:</label>
                <input class="form-control" type='datetime-local' id='end-time' autocomplete="on"/>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-1">
                <button class="btn btn-primary" type="button" id="add-destination-button">Add</button>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-9"></div>
        <div class="col-3 d-grid pe-1 float-end">
            <input class="btn btn-primary btn-lg" type="submit" value="Post" name="signup" id="post-submit" autocomplete="on">
        </div>
    </div>
</form>
