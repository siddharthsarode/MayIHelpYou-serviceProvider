<div class="profile-info">
    <div class="info-box lg-pad-b">
        <div class="top-section">
            <h2 class="heading">Personal Information</h2>
            <span class="edit-btn">Edit</span>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="dash-form ">
            <div class="dash-form-group">
                <div class="form-element">
                    <input class="form-input" type="text" name="user-name" id="user-name"
                        value="<?php if (isset($row['user_name'])) echo $row['user_name']; ?>"
                        placeholder="Enter Full Name" disabled required />
                </div>
                <input type="submit" name="save_name" class="button save-btn" value="SAVE">
            </div>
            <div class="form-element">
                <label class="form-label" for="user-name">Your Gender</label>
                <div class="radio-container">
                    <div class="radio-div">
                        <input type="radio" name="g" id="male" class="radio-btn" checked> <label for="male"
                            class="gender-label" disabled>Male</label>
                    </div>
                    <div class="radio-div">
                        <input type="radio" name="g" id="female" class="radio-btn"> <label for="female"
                            class="gender-label" disabled>Female</label>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Edit Email -->
    <div class="info-box lg-pad-b" id="email-address">
        <div class="top-section">
            <h2 class="heading">Email Address</h2>
            <span class="edit-btn">Edit</span>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="dash-form ">
            <div class="dash-form-group">
                <div class="form-element">
                    <input class="form-input" type="email" name="user-email" id="user-email"
                        value="<?php if (isset($row['user_email'])) echo $row['user_email']; ?>"
                        placeholder="Email Address" disabled required />
                </div>
                <input type="submit" name="save_email" id="nameEdit" class="button save-btn" value="SAVE">
            </div>
        </form>
    </div>
    <!-- Edit Mobile Number -->
    <div class="info-box lg-pad-b" id="mobile-number">
        <div class="top-section">
            <h2 class="heading">Mobile Number</h2>
            <span class="edit-btn">Edit</span>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="dash-form ">
            <div class="dash-form-group">
                <div class="form-element">
                    <input class="form-input" type="number" name="user-mobile" id="user-mobile"
                        value="<?php if (isset($row['user_mobile_no'])) echo $row['user_mobile_no']; ?>"
                        placeholder="Mobile Number" disabled required />
                </div>
                <input type="submit" name="save_number" class="button save-btn" value="SAVE">
            </div>
        </form>
    </div>
</div>