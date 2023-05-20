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
        <div class="col-md-6 d-grid pe-1 float-end">
            <input type="button" class="btn btn-primary" alt="Submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"></path>
                </svg>
                Send
            </input>
            <!--<input class="btn btn-lg rounded-circle" type="image" src="<?php echo UPLOAD_DIR.'send_message.png'?>" alt="Submit" width="48" height="48">-->
            <!--<input class="btn btn-primary btn-lg rounded-0" type="submit" value="Sign Up" name="signup" id="sign-up-submit" autocomplete="on">-->
        </div>
    </div>
</form>