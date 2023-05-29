<form>
    <div class="container-fluid">
        <div class="row">
            <div class="col mb-3">
                <label for="s-input" class="form-label">Search</label>
                <input id="s-input" type="text" class="form-control" placeholder="My sweet holiday!">
            </div>
            <div class="col-auto d-flex align-items-end mb-3">
                <button id="s-button" class="btn btn-light">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-search desktop-icon" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                    </svg>
                    <span class="d-none d-xl-inline">Search</span>
                </button>
            </div>
        </div>
    </div>
</form>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#feed" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Posts</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Users</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="feed" role="tabpanel" aria-labelledby="home-tab" tabindex="0"></div>
  <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="profile-tab" tabindex="0"></div>
</div>
