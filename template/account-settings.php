<?php 
    $id = $_SESSION["id"];
    $userDetails = ($dbh->getPublicUserDetails($id, $id))[0];
?>
<form>
    <div class="container-fluid">
        <div class="row my-3">
            <div class="col-4">
				<div class="ratio ratio-1x1">
					<div class="border d-flex align-items-center">
						<img id="v-image" src="profilePhotos/<?php echo $userDetails["photoPath"] ?>" class="img-fluid mx-auto align-middle profile-image-introduction" alt="User profile image">
					</div>
				</div>
            </div>
            <div class="col">
                <div class="">
                    <label for="u-image" class="form-label">Profile Image</label>
                    <input class="form-control" type="file" id="u-image">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label for="v-name" class="form-label">Name</label>
                <input id="v-name" type="text" class="form-control" placeholder="<?php echo $userDetails["name"] ?>" disabled readonly>
            </div>
            <div class="col mb-3">
                <label for="v-lastName" class="form-label">Last Name</label>
                <input id="v-lastName" type="text" class="form-control" placeholder="<?php echo $userDetails["lastName"] ?>" disabled readonly>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3 position-relative">
                <label for="u-userName" class="form-label">User Name</label>
                <input id="u-userName" name="User Name" type="text" class="form-control" placeholder="" value="<?php echo $userDetails["userName"] ?>" disabled>
                <div class="invalid-tooltip"></div>
            </div>
            <div class="col-auto d-flex align-items-end mb-3">
                <button id="u-userName-button" type="button" class="btn btn-light">
					<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="desktop-icon bi bi-pencil-square" viewBox="0 0 16 16">
						<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
						<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
					</svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="d-none desktop-icon bi bi-x-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
					<span>
						Edit
					</span>
				</button>
            </div>
            <div class="col-12">
                <div id="u-userName-feedback"><div class="invalid-feedback"></div></div>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3 position-relative">
                <label for="u-email" class="form-label">Email</label>
                <input id="u-email" type="email" type="text" class="form-control" placeholder="" value="<?php echo $userDetails["email"] ?>" disabled>
                <div class="invalid-tooltip"></div>
            </div>
            <div class="col-auto d-flex align-items-end mb-3">
                <button id="u-email-button" type="button" class="btn btn-light">
					<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="desktop-icon bi bi-pencil-square" viewBox="0 0 16 16">
						<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
						<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
					</svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="d-none desktop-icon bi bi-x-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
					<span>
						Edit
					</span>
				</button>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3 position-relative">
                <label for="u-psw" class="form-label">Password</label>
                <input id="u-psw" type="text" class="form-control" placeholder="" disabled>
                <div class="invalid-tooltip"></div>
            </div>
            <div class="col mb-3 position-relative">
                <label for="u-psw-confirm" class="form-label">Confirm password</label>
                <input id="u-psw-confirm" type="text" class="form-control" placeholder="" disabled>
                <div class="invalid-tooltip"></div>
            </div>
            <div class="col-auto d-flex align-items-end mb-3">
                <button id="u-psw-button" type="button" class="btn btn-light">
					<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="desktop-icon bi bi-pencil-square" viewBox="0 0 16 16">
						<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
						<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
					</svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="d-none desktop-icon bi bi-x-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
					<span>
						Edit
					</span>
				</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button id="u-apply-button" type="button" class="btn btn-light">
					Apply
				</button>
            </div>
        </div>
    </div>
</form>

