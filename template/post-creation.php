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

    <div class="row mt-2">
        <p class="fw-bold fs-4 text-primary">Images:</p>
        <div class="border border-light-subtle pt-1 pb-4">
            <div class="row pt-3">
                <div class="col-11">
                    <label class="fw-bold form-label" for="images">Add image:</label>
                    <input id="images-field" class="form-control" type="file" id="formFileMultiple" multiple>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-4">
                    <button class="btn btn-primary align-bottom" type="button" id="add-image-button">Add</button>
                </div>
            </div>
            <div class="row mt-3" id="images-container">
                <!--<div class="row">
                    <div class="col-12 gy-4">
                        <div class="card">
                            <ul id="destinations-list" class="list-group list-group-flush  pt-3">
                                <li class="list-group-item list-group-item-action container-fluid">
                                    <div class="row">
                                        <div class="col-4">
                                            <img class="img-fluid" src="upload/icon.png"/>
                                        </div>
                                        <div class="col-8">
                                            <p class="fw-bold fs-7">do,gfguifjmuidtfjmuinfgtijuntfiunmtfiuj</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="col-12">
                                                <button id="trash-${lastIndex}" data-type="trash" class="btn btn-transparent float-end"  type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                    </svg>
                                                </button>
                                                <button id="chrevron-down-${lastIndex}" data-type="chrevron-down" class="btn btn-transparent float-end" type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </button>
                                                <button id="chrevron-up-${lastIndex}" data-type="chrevron-up" class="btn btn-transparent float-end" type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item list-group-item-action container-fluid pt-3">
                                    <div class="row">
                                        <div class="col-4">
                                            <img class="img-fluid" src="upload/group-travel.png"/>
                                        </div>
                                        <div class="col-8">
                                            <p class="fw-bold fs-7">do,gfguifjmuidtfjmuinfgtijuntfiunmtfiuj</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="col-12">
                                                <button id="trash-${lastIndex}" data-type="trash" class="btn btn-transparent float-end"  type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                    </svg>
                                                </button>
                                                <button id="chrevron-down-${lastIndex}" data-type="chrevron-down" class="btn btn-transparent float-end" type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </button>
                                                <button id="chrevron-up-${lastIndex}" data-type="chrevron-up" class="btn btn-transparent float-end" type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-9"></div>
        <div class="col-3 d-grid pe-1 float-end">
            <input class="btn btn-primary btn-lg" type="submit" value="Post" name="signup" id="post-submit" autocomplete="on" required/>
        </div>
    </div>
</form>
