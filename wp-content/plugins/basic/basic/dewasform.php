<?php
// if (!empty($_POST)) {
// 	global $wpdb;
// 	$table2 = $wpdb->prefix . 'users';
// 	$table3 = $wpdb->prefix . 'usermeta';
// 	$table = $wpdb->prefix . 'basic';
// 	$nicename = $_POST['first_name'];
// 	$username = get_username("$nicename");
// 	$email = $_POST['email'];
// 	$usrreg = date("Y-m-d h:i:s");
// 	$password = md5($_POST['password']);
// 	$nicename = $_POST['first_name'];

// Data For Basic Table...

// $data = array(

// 	'registrationtype' => $_POST['registration_type'],
// 	'rainathonruntype' => $_POST['single_ranathon_type'],
// 	'indoremarathonruntype' => $_POST['combo_ranathon'],
// 	'registrationfee' => $_POST['amount'],
// 	'email' => $_POST['email'],
// 	'password' => md5($_POST['password']),
// 	'clinic' => $_POST['clinic_name'],
// 	'firstname' => $_POST['first_name'],
// 	'middlename' => $_POST['middle_name'],
// 	'lastname' => $_POST['last_name'],
// 	'mobile' => $_POST['mobile'],
// 	'dob' => $_POST['datofbirth'],
// 	'bloodgroup' => $_POST['blood_group'],
// 	'gender' => $_POST['gender'],
// 	't-shirt_size' => $_POST['tshirt_size'],
// 	'emergencyname' => $_POST['emergency_name'],
// 	'emergencycontact' => $_POST['emergency_contact'],
// 	'district' => $_POST['district'],
// 	'address' => $_POST['address'],


// );
// $format = array(
// 	'%s',
// 	'%s',
// 	'%s',
// 	'%s',
// 	'%s',
// 	'%s',
// 	'%s',
// 	'%s',
// 	'%s',
// 	'%s',
// 	'%s',
// 	'%s',
// 	'%s',
// 	'%s',
// 	'%s',
// 	'%s',
// 	'%s',
// 	'%s',
// 	'%s'
// );

// Email Check....
// $check = $wpdb->query("SELECT user_email FROM $table2 WHERE user_email='" . $email . "'");
// if ($check != 0) {
// 	echo "<script>alert('Email Already Exist');

// 	window.location.href = '';</script>";
// } else {
// 	$xyz = array('a:1:{s:13:"administrator";b:1;}');
// 	$wpcap = implode($xyz);

// user Registration Query...

// 		$sql = "INSERT INTO $table2 (user_login, user_pass, user_nicename, user_email, user_registered, display_name, user_status) VALUES ('$username', '$password', '$nicename', '$email', '$usrreg', '$nicename', '0')";
// 		$success = $wpdb->query($sql);
// 		$getid = $wpdb->insert_id;
// 		$sql2 = "INSERT INTO $table3 (user_id, meta_key, meta_value) VALUES ( '$getid','wp_capabilities', '$wpcap' )";
// 		$success2 = $wpdb->query($sql2);
// 		$sql3 = "INSERT INTO $table3 (user_id, meta_key, meta_value) VALUES ('$getid', 'wp_user_level', '10')";
// 		$success3 = $wpdb->query($sql3);
// 		$basic = $wpdb->insert($table, $data, $format);

// 		if ($success || $success2 || $success3 || $basic) {

// 			echo "<script>alert('Data has been save');</script>";
// 			echo "<script>alert('Your Unique User Name Is . $username');
// 			window.location.href = '';
// 			</script>";
// 		}
// 	}
// } else {
?>
<!-- HTML Form  -->
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet" type="text/css" />
<style>
    .error {
        color: red;
    }
</style>
<br>
<hr>
<h2 align="center">Dewas Run Registration</h2>
<hr>
<div class="container" align="center">
    <form action="" id="form" name="form" method="POST">
        <div class="info_section_2 info_sec_new">
            <div class="user_input clearfix">

                <div class="info_section_heading runner_head_single">
                    <h5>Name And Address </h5>
                </div>
                <div class="hr_register">
                    <hr class="info_sec_rule">
                </div>
                <div class="user_input">
                    <label for="">Name: <span>*</span></label><br>
                    <input class="single_line half_input" placeholder="First Name" value="" type="text" name="first_name" id="first_name" style="width:50%;margin-bottom:30px;">
                    <input class="single_line half_input" placeholder="Middle Name" value="" type="text" name="middle_name" id="middle_name" style="width:50%;margin-bottom:30px;">
                    <input class="single_line half_input" placeholder="Last Name" value="" type="text" name="last_name" id="last_name" style="width:50%;margin-bottom:30px;">
                </div>
                <div class="user_input_field" style="width:50%;">
                    <label for="" style="color: #803692;">Email:<span>*</span></label>
                    <input class="single_line half_input" placeholder="Email ID" value="" type="text" name="email" id="email" style="width:100%;margin-bottom:30px;">
                </div>
                <div class="user_input_field">
                    <label for="">Mobile: <span>*</span></label><br>
                    <input class="single_line half_input" placeholder="Mobile" value="" type="text" name="mobile" id="mobile" style="width:50%;margin-bottom:30px;">
                </div>
                <div class="user_input_field">
                    <label for="">District: <span>*</span></label><br>
                    <select class="single_line half_input" name="district" id="district" style="width:50%;margin-bottom:30px;">
                        <option value="indore">Indore</option>
                    </select>
                </div>
                <div class="user_input_field">
                    <label for="">Address: <span>*</span></label><br>
                    <textarea class="single_line half_input" placeholder="Address" type="text" value="" name="address" id="address" cols="54" rows="1" style="width:50%;margin-bottom:30px;"></textarea>
                </div>
            </div>

            <div class="user_input clearfix">
                <div class="info_section_heading runner_head_single">
                    <h5>Personal Information</h5>
                </div>
                <div class="hr_register">
                    <hr class="info_sec_rule">
                </div>
                <div class="user_input_field">
                    <label for="">Gender: <span>*</span></label><br>
                    <select class="single_line half_input second_info_new" type="text" name="gender" id="gender" style="width:50%;margin-bottom:30px;">
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="user_input_field">
                    <label for="">Date of Birth: <span>*</span></label><br>
                    <input type="text" id="datofbirth" placeholder="yyyy-mm-dd" value="01/01/2004" name="datofbirth" readonly style="width:50%;margin-bottom:30px;">
                </div>
                <div class="user_input_field ">
                    <label for="">Blood Group:<span>*</span></label><br>
                    <select class="single_line half_input" type="text" name="blood_group" id="blood_group" style="width:50%;margin-bottom:30px;">
                        <option value="">Select</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                </div>
            </div>

            <div class="user_input clearfix">
                <div class="info_section_heading runner_head_single">
                    <h5>Race Information</h5>
                </div>
                <div class="hr_register">
                    <hr class="info_sec_rule">
                </div>

                <div class="user_input_field" style="width: 100%;margin-bottom: 30px;">
                   </div>
                <div class="user_input_field" >
                    <label for="">Race Category : <span>*</span></label><br>
                    <select class="single_line single_ranathon_type" name="single_ranathon_type" id="runcat" style="width:50%;margin-bottom:30px;" required>
                        <option value="">Select</option>
                        <option value="5k" id="5kr" name ="5kr"  get_price="250"> 5k </option>
                        <option value="10k" id="10kr" name ="10kr" get_price="350"> 10k </option>
                    </select>
                </div>
                <div class="user_input_field fees_section user_input_field hide" id="indoreshow">
                    <label for="">Registration Fee: </label><br>
                    <input type="text" name="amount" value="" id="amount" readonly style="width:50%;margin-bottom:30px;"> <i class="fa fa-inr" aria-hidden="true"></i>
                </div>

                <div class="user_input_field tshirt_size_section">
                    <label for="">T-Shirt Size: <span>*</span></label><br>
                    <select class="single_line half_input" type="text" name="tshirt_size" id="tshirt_size" style="width:50%;margin-bottom:30px;">
                        <option value="">Select</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                </div>
            </div>
            <div class="user_input submit_div clearfix">
                <input type="submit" name="user_reg_submit" class="" id="user_reg_submit" value="Submit">
            </div>
            <div class="regFormErrors"></div>
        </div>
    </form>
</div>


<?php
//}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        // Registration Type

        $("#runcat").change(function() {

            if ($('#5kr').click()) {
            $('input[name=amount]').val('250');
            }
            else if($("#10kr").click()) {

                $('input[name=amount]').val('350');
            }
            else {
                $('input[name=amount]').val('Select race');
            }


        });
        
    });

    // Date of Birth picker and validation
    var d = new Date();
    var year = d.getFullYear() - 18;
    $(function() {
        $("#datofbirth").datepicker({
            changeYear: true,
            changeMonth: true,
            yearRange: '1920:' + year + '',
            defaultDate: d
        });
        d.setFullYear(year);
    });

    var event_year = d.getFullYear() + 1;
    $(function() {
        $("#event_date").datepicker({
            changeYear: true,
            changeMonth: true,
            yearRange: '2022:' + event_year + '',
            defaultDate: d
        });
        d.setFullYear(event_year);
    });
</script>

<script>
    // Validation... 
    $(document).ready(function() {
        $("#form").validate({

            rules: {
                registration_type: 'required',

                first_name: {
                    required: true,
                    minlength: 2
                },

                last_name: {
                    required: true,
                    minlength: 2
                },

                email: {
                    required: true,
                    email: true,
                    maxlength: 255,
                },
                datofbirth: {
                    required: true,

                },

                blood_group: 'required',
                gender: 'required',
                tshirt_size: 'required',
                mobile: {
                    required: true,
                    number: true,
                    maxlength: 10,
                    minlength: 10,
                },

                emergency_name: {
                    required: true,
                    minlength: 2
                },

                emergency_contact: {
                    required: true,
                    number: true,
                    maxlength: 10,
                    minlength: 10,
                },

                district: 'required',
                address: 'required',

            },
            messages: {

                registration_type: 'Please Select One ',

                first_name: {
                    required: 'Enter First Name',
                    minlength: 'Enter Atleast 2 Charecters',
                },
                last_name: {
                    required: 'Enter Last Name',
                    minlength: 'Enter Atleast 2 Charecters',
                },
                email: 'Enter a valid email',
                datofbirth: 'Enter Date Of Birth',
                blood_group: 'Enter Blood Group',
                gender: 'Select Gender',
                tshirt_size: 'Select T-shirt Size',
                mobile: {
                    required: 'Enter Mobile Number',
                    minlength: 'Please Enter A Valid (10 Digit) Number',
                    maxlength: 'Please Enter A Valid (10 Digit) Number',
                },
                emergency_name: {
                    required: 'Please enter Emergency Name ',
                    minlength: 'Enter Atleast 2 Charecters',
                },
                emergency_contact: {
                    required: 'Enter Emergency Contact Number',
                    minlength: 'Please Enter A Valid (10 Digit) Number',
                    maxlength: 'Please Enter A Valid (10 Digit) Number',
                },
                district: 'Enter District',
                address: 'Enter Address',
            },

            submitHandler: function(form) {
                form.submit();
            }


        });
    });
</script>

<script>



</script>