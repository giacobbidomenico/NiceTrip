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
						<img id="v-image" src="http://localhost/tecnologieweb/NiceTrip/profilePhotos/genericProfilePhoto.jpg" class="img-fluid" alt="...">
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
            <div class="col mb-3">
                <label for="u-userName" class="form-label">User Name</label>
                <input id="u-userName" type="text" class="form-control" placeholder="<?php echo $userDetails["userName"] ?>" disabled readonly>
            </div>
            <div class="col-auto d-flex align-items-end mb-3">
                <button id="u-userName-button" class="btn btn-light">
					<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="desktop-icon bi bi-pencil-square" viewBox="0 0 16 16">
						<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
						<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
					</svg>
					<span>
						Edit
					</span>
				</button>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label for="u-email" class="form-label">Email</label>
                <input id="u-email" type="text" class="form-control" placeholder="<?php echo $userDetails["email"] ?>" disabled readonly>
            </div>
            <div class="col-auto d-flex align-items-end mb-3">
                <button id="u-email-button" class="btn btn-light">
					<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="desktop-icon bi bi-pencil-square" viewBox="0 0 16 16">
						<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
						<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
					</svg>
					<span>
						Edit
					</span>
				</button>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label for="u-psw" class="form-label">Password</label>
                <input id="u-psw" type="text" class="form-control" placeholder="" disabled readonly>
            </div>
            <div class="col mb-3">
                <label for="u-psw-confirm" class="form-label">Confirm password</label>
                <input id="u-psw-confirm" type="text" class="form-control" placeholder="" disabled readonly>
            </div>
            <div class="col-auto d-flex align-items-end mb-3">
                <button id="u-psw-button" class="btn btn-light">
					<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="desktop-icon bi bi-pencil-square" viewBox="0 0 16 16">
						<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
						<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
					</svg>
					<span>
						Edit
					</span>
				</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button id="u-apply-button" class="btn btn-light">
					Apply
				</button>
            </div>
        </div>
    </div>
</form>

