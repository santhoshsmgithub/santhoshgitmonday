<?php include "admin/config/config.inc.php";
include 'require/header.php';
$length = 6; // Length of the random text
$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$text = '';

// Generate random text
for ($i = 0; $i < $length; $i++) {
    $text .= $characters[rand(0, strlen($characters) - 1)];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    global $db;
    // Retrieve form data
    $volunteer_first_name = $_POST['volunteer_first_name'];
    $volunteer_last_name = $_POST['volunteer_last_name'];
    $volunteer_email = $_POST['volunteer_email'];
    $volunteer_phone_number = $_POST['volunteer_phone_number'];
    $volunteer_address = $_POST['volunteer_address'];
    $volunteer_address2 = $_POST['volunteer_address2'];
    $volunteer_city = $_POST['volunteer_city'];
    $volunteer_state = $_POST['volunteer_state'];
    $volunteer_zip = $_POST['volunteer_zip'];
    $volunteer_qualification = $_POST['volunteer_qualification'];
    $prior_coaching_experience = $_POST['prior_coaching_experience'];
    $service = $_REQUEST['serid'];
    $event = $_REQUEST['eveid'];


    $resa = $db->prepare("INSERT INTO `volunteer_register` (service,event,volunteer_first_name, volunteer_last_name, volunteer_email, volunteer_phone_number, volunteer_address, volunteer_address2, volunteer_city, volunteer_state, volunteer_zip, volunteer_qualification, prior_coaching_experience) VALUES (?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $resa->execute(array($service, $event, $volunteer_first_name, $volunteer_last_name, $volunteer_email, $volunteer_phone_number, $volunteer_address, $volunteer_address2, $volunteer_city, $volunteer_state, $volunteer_zip, $volunteer_qualification, $prior_coaching_experience));




    echo "<script>alert('Volunteer registration has been created successfully');</script>";
}
?>

<!-- Page Title -->
<section class="page-title" style="background-image:url(assets/images/background/11.jpg)">
    <div class="auto-container">
        <div class="d-flex justify-content-center align-items-center flex-wrap">
            <div class="left-box">
                <!-- <div class="page-title_big">Volunteer Enroll</div> -->
                <h2 class="page-title_heading"><?php
                                                if (getevent('event_name', $_REQUEST['eveid']) != '') {
                                                    echo getservice('title', $_REQUEST['serid']) . ' - ' . getevent('event_name', $_REQUEST['eveid']);
                                                } else {
                                                    echo getservice('title', $_REQUEST['serid']);
                                                }
                                                ?></h2>
            </div>

        </div>
    </div>
</section>
<!-- End Page Title -->

<style>
    @media (max-width: 767px) {
        .display_view {
            display: none;
        }

        .page-title {
            padding: 40px !important;
        }
    }
</style>

<section class="location-one" id="contact" style="background-image:url(assets/images/background/5.jpg)">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="location-one_map-column col-lg-12 col-md-12 col-sm-12">
                <div class="sec-title title-anim">
                    <h2 class="sec-title_heading">Volunteer Registration</h2>
                </div>

                <div class="sec-title">
                    <!-- <h2 class="sec-title_heading">Description</h2> -->
                    <div class="sec-title_title" style="text-transform:none;line-height: 30px;"><?php
                                                                                                echo getservice('volunteer', $_REQUEST['serid']); ?></div>
                </div>

                <div class="contact-form">
                    <form action="#" method="post" autocomplete="off" id="student_info" onsubmit="return validateContactCaptcha() && validateCheckbox();">
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-12 form-group">
                                <label for="sec-title_title" class="label_title">First Name <span class="label_title_required"> *</span></label>
                                <input type="text" id="alpha_char" name="volunteer_first_name" placeholder="Enter first name" required="" pattern="^(?=.*[.])[A-Za-z\s.]+$" title="Add initial letter before or after name">
                                <!-- <span id="first-name-error" style="color: red; display: none;">Please enter a valid name (only letters and spaces allowed, no leading spaces).</span> -->
                                <span id="alpha_char_error" style="color: red;"></span>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 form-group">
                                <label for="sec-title_title" class="label_title">Last Name <span class="label_title_required"> *</span></label>
                                <input type="text" id="alpha_char_2" name="volunteer_last_name" placeholder="Enter last name" required="" pattern="^[A-Za-z\s]+$" title="Only alphabetic characters and spaces are allowed.">
                                <span id="last-name-error" style="color: red; display: none;">Please enter a valid name (only letters and spaces allowed, no leading spaces).</span>
                                <span id="alpha_char_2_error" style="color: red;"></span>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 form-group">
                                <label for="sec-title_title" class="label_title">Email <span class="label_title_required"> *</span></label>
                                <input type="email" id="email" name="volunteer_email" placeholder="Enter email" required="" pattern="^[\w._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$">
                                <span id="email_error" style="color: red;"></span>
                                <span id="email-error" style="color: red;"></span>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 form-group">
                                <label for="sec-title_title" class="label_title">Phone number <span class="label_title_required"> *</span></label>
                                <input type="tel" id="number_val" name="volunteer_phone_number" placeholder="Enter phone number" required="">
                                <span id="number_val_error" style="color: red;"></span>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <label for="sec-title_title" class="label_title">Address - Street Address <span class="label_title_required"> *</span></label>
                                <input type="text" name="volunteer_address" placeholder="Enter address - street address">
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <label for="sec-title_title" class="label_title">Street Address Line <span class="label_title_required"> *</span></label>
                                <input type="text" name="volunteer_address2" placeholder="Enter street address line ">
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12 form-group">
                                <label for="sec-title_title" class="label_title">City <span class="label_title_required"> *</span></label>
                                <input type="text" id="alpha_char_3" name="volunteer_city" placeholder="Enter city" required="" pattern="^[A-Za-z\s]+$" title="Only alphabetic characters and spaces are allowed.">
                                <span id="city-error" style="color: red; display: none;">Please enter a valid name (only letters and spaces allowed, no leading spaces).</span>
                                <span id="alpha_char_3_error" style="color: red;"></span>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12 form-group">
                                <label for="sec-title_title" class="label_title">State <span class="label_title_required"> *</span></label>
                                <input type="text" id="alpha_char_4" name="volunteer_state" placeholder="Enter state" required="" pattern="^[A-Za-z\s]+$" title="Only alphabetic characters and spaces are allowed.">
                                <span id="state-error" style="color: red; display: none;">Please enter a valid name (only letters and spaces allowed, no leading spaces).</span>
                                <span id="alpha_char_4_error" style="color: red;"></span>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12 form-group">
                                <label for="sec-title_title" class="label_title">Zip <span class="label_title_required"> *</span></label>
                                <input type="text" id="number_val_2" name="volunteer_zip" placeholder="Enter zip" required="">
                                <span id="number_val_2_error" style="color: red;"></span>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12 form-group">
                                <label for="sec-title_title" class="label_title">Qualification <span class="label_title_required"> *</span></label>
                                <input type="text" id="alpha_char_5" name="volunteer_qualification" placeholder="Enter qualification" required="" pattern="^[A-Za-z\s]+$" title="Only alphabetic characters and spaces are allowed.">
                                <span id="qualification-error" style="color: red; display: none;">Please enter a valid name (only letters and spaces allowed, no leading spaces).</span>
                                <span id="alpha_char_5_error" style="color: red;"></span>
                            </div>

                            <div class="col-lg-12 col-md-6 col-sm-4 form-group">
                                <label for="sec-title_title" class="label_title">Prior Volunteering Experience <span class="label_title_required"> *</span></label>
                                <textarea name="prior_coaching_experience" placeholder="Enter prior volunteering experience" required=""></textarea>
                                <!-- <input type="text" name="prior_coaching_experience" placeholder="Enter prior volunteering experience" required="">                                -->
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <br>
                                <!-- <input type="text" id="captchaText" name="ge_captcha" readonly value="<?php echo $text; ?>" required=""> -->
                                <div class="captcha-container">
                                    <span class="captcha-text" id="captchaText" name="g_captcha"><?php echo $text; ?></span>
                                </div>

                                <div class="button-container" style="justify-content: unset;">
                                    <button type="button" id="reloadCaptcha" class="reload-btn text-danger" onclick="reloadCaptcha()">
                                        <i class="fa-solid fa-arrow-rotate-right"></i> Reload
                                    </button>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                <label for="sec-title_title" class="label_title">Captcha <span class="label_title_required"> *</span></label>
                                <input type="text" required id="captchaInput" name="en_captcha" placeholder="Enter Captcha" required="">
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <!-- Button Box -->
                                <div class="button-box">
                                    <button class="btn-style-one theme-btn" type="submit">
                                        <div class="btn-wrap">
                                            <span class="text-one">submit now</span>
                                            <span class="text-two">submit now</span>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- <script>
    $(document).ready(function() {
        $("#parent_info").submit(function() {
            var a = $("#g_captcha").val();
            var b = $("#e_captcha").val();

            if (a != b) {
                alert("invalid captcha...");
                return false;
            } else {
                return true;
            }
        });

        $("#student_info").submit(function() {
            var a = $("#ge_captcha").val();
            var b = $("#en_captcha").val();

            if (a != b) {
                alert("invalid captcha...");
                return false;
            } else {
                return true;
            }
        });
    });
</script> -->

<script>
    document.getElementById('student_info').addEventListener('submit', function(event) {
        // Validation rules
        var validTextPattern = /^[A-Za-z\s]+$/; // Only letters and spaces

        // Form elements
        var firstNameInput = document.querySelector('input[name="volunteer_first_name"]');
        var lastNameInput = document.querySelector('input[name="volunteer_last_name"]');
        var cityInput = document.querySelector('input[name="volunteer_city"]');
        var stateInput = document.querySelector('input[name="volunteer_state"]');
        var qualificationInput = document.querySelector('input[name="volunteer_qualification"]');

        // Error elements (you can add these spans in your HTML with respective IDs)
        var firstNameError = document.getElementById('first-name-error');
        var lastNameError = document.getElementById('last-name-error');
        var cityError = document.getElementById('city-error');
        var stateError = document.getElementById('state-error');
        var qualificationError = document.getElementById('qualification-error');

        // Track validity
        var isValid = true;

        // First name validation
        if (!validTextPattern.test(firstNameInput.value)) {
            firstNameError.style.display = 'block';
            isValid = false;
        } else {
            firstNameError.style.display = 'none';
        }

        // Last name validation
        if (!validTextPattern.test(lastNameInput.value)) {
            lastNameError.style.display = 'block';
            isValid = false;
        } else {
            lastNameError.style.display = 'none';
        }

        // City validation
        if (!validTextPattern.test(cityInput.value)) {
            cityError.style.display = 'block';
            isValid = false;
        } else {
            cityError.style.display = 'none';
        }

        // State validation
        if (!validTextPattern.test(stateInput.value)) {
            stateError.style.display = 'block';
            isValid = false;
        } else {
            stateError.style.display = 'none';
        }

        // Qualification validation
        if (!validTextPattern.test(qualificationInput.value)) {
            qualificationError.style.display = 'block';
            isValid = false;
        } else {
            qualificationError.style.display = 'none';
        }

        // Prevent form submission if any field is invalid
        if (!isValid) {
            event.preventDefault();
        }
    });

    $(document).ready(function() {
        $('#student_info').on('submit', function(event) {
            var email = $('#email').val();
            var emailPattern = /^[\w._%+-]+@[A-Za-z0-9.-]+\.(com|co|org|in)$/;

            // Clear previous error message
            $('#email-error').text('');

            if (!emailPattern.test(email)) {
                $('#email-error').text('Please enter a valid email address (e.g., ram23@gmail.com)');
                event.preventDefault(); // Prevent the form from submitting
                return;
            }

        });
    });

    document.getElementById('email').addEventListener('input', function() {
        var email = this.value;
        var errorMessage = document.getElementById('email_error');

        // Pattern to validate email format allowing uppercase letters
        var pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (email === "") {
            errorMessage.textContent = "Email is required.";
        } else if (!pattern.test(email)) {
            errorMessage.textContent = "Please enter a valid email address.";
        } else {
            errorMessage.textContent = "";
        }
    });

    document.getElementById('number_val').addEventListener('input', function() {
        var value = this.value;
        var errorMessage = document.getElementById('number_val_error');

        // Pattern to match only digits
        var digitOnlyPattern = /^\d*$/;

        if (value === "") {
            errorMessage.textContent = "This field is required";
        } else if (!digitOnlyPattern.test(value)) {
            errorMessage.textContent = "Only integers are allowed.";
            this.value = value.replace(/\D/g, ''); // Remove non-digit characters
        } else {
            errorMessage.textContent = "";
        }
    });

    document.getElementById('number_val_2').addEventListener('input', function() {
        var value = this.value;
        var errorMessage = document.getElementById('number_val_2_error');

        // Pattern to match only digits
        var digitOnlyPattern = /^\d*$/;

        if (value === "") {
            errorMessage.textContent = "This field is required";
        } else if (!digitOnlyPattern.test(value)) {
            errorMessage.textContent = "Only integers are allowed.";
            this.value = value.replace(/\D/g, ''); // Remove non-digit characters
        } else {
            errorMessage.textContent = "";
        }
    });
</script>

<script>
    window.onload = function() {
        document.forms['student_info'].reset(); // Reset the form with the specified name
    };

    var currentCaptchaText = "<?php echo $text; ?>"; // Initially set to the server-side generated CAPTCHA

    $(document).ready(function() {
        $('#reloadCaptcha').click(function() {
            $.ajax({
                url: 'generate_captcha.php', // URL to regenerate the CAPTCHA
                type: 'GET',
                success: function(response) {
                    $('#captchaText').html(response); // Update the CAPTCHA text in the UI
                    currentCaptchaText = response.trim(); // Update the CAPTCHA value in JavaScript
                },
                error: function(xhr, status, error) {
                    console.error("Error reloading CAPTCHA:", status, error);
                }
            });
        });
    });

    function validateContactCaptcha() {
        var userInput = document.getElementById('captchaInput').value.trim(); // Get user input

        // Compare user input with the dynamically updated CAPTCHA text
        if (userInput === currentCaptchaText) {
            // If matched, allow form submission
            return true;
        } else {
            // If not matched, prevent form submission and display alert
            alert("Invalid CAPTCHA! Please enter the correct value.");
            return false;
        }
    }

function validateCheckbox() {
        const checkbox = document.getElementById('signature_checkbox');
        const errorSpan = document.getElementById('alpha_signature_error'); // Use the existing error span for the signature

        if (!checkbox.checked) {
            errorSpan.innerText = "You must agree to the consent before submitting the form.";
            return false; // Prevent form submission
        } else {
            errorSpan.innerText = ""; // Clear error message if checked
            return true; // Allow form submission
        }
    }
</script>

<?php include 'require/footer.php'; ?>