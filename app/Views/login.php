<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & OTP Confirmation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
          body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-image: url('https://img.freepik.com/premium-vector/abstract-colorful-gradient-background-combination-shades-arranged-plate_622214-20852.jpg?ga=GA1.1.1553320582.1730781172');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            background-attachment: fixed;
        }
        .container-box {
            position: relative;
            width: 90%;
            max-width: 600px;
            height: 80%;
            border: 2px solid #ccc;
            border-radius: 15px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            background-color: white;
            
        }

        .image-container {
            height: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #image1 {
            /* margin-top: 10px; */
            background-image: url('data:image/jpeg;base64,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');
           /* background-image: url('https://static.vecteezy.com/system/resources/previews/017/264/717/non_2x/man-using-social-media-applications-on-mobile-cell-phone-person-texting-messages-in-chat-apps-on-smartphone-vector.jpg'); */
            background-size: cover; 
            background-position: center;
            top:10px;
        }

        #image2 {
            background-image: url('https://st5.depositphotos.com/26727728/75057/i/450/depositphotos_750579524-stock-photo-business-center-street-konstitucijos-avenue.jpg');
            /* background-image: url('https://c8.alamy.com/comp/P9H22W/hand-painted-pink-watercolor-bottom-border-texture-with-soft-edges-isolated-on-the-white-background-backdrop-frame-usable-for-cards-wedding-invitati-P9H22W.jpg');  */
            background-size: cover; 
            background-position: center; 
            object-fit: contain;
        }

        .card {
            width: 90%;
            max-width: 350px;
            margin: auto;
            border-radius: 15px;
            position: absolute;
            top: 58%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.6);  /* Semi-transparent background */
            backdrop-filter: blur(10px);
        }

        .btn {
            border-radius: 50px;
            padding: 2px 4px;
            font-size: 14px;
        }

        .otp-input {
            text-align: center;
            font-size: 24px;
            letter-spacing: 10px;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    


    <?php if (session()->getFlashdata('success')): ?>
        <script type="text/javascript">
            toastr.success("<?= session()->getFlashdata('success'); ?>");
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <script type="text/javascript">
            toastr.error("<?= session()->getFlashdata('error'); ?>");
        </script>
    <?php endif; ?>

    <div class="container-box">
        <div class="image-container" id="image1"></div>
        <div class="image-container" id="image2"></div>

        <div class="card" id="login-card">
            <div class="card-body">
                <h5 class="card-title">Login</h5>
                <form id="login-form">
                    <div class="form-group">
                        <input type="text" name="phone" class="form-control" placeholder="Enter mobile number" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Send OTP</button>

                    <a href="javascript:void(0);" class="btn btn-danger btn-block" onclick="loginWithGoogle()">
                        Login with Google
                    </a>
                </form>
                <br><p>Don't have an account? <a href="/register"><button type="button">Register</button></a></p>
            </div>
        </div>

        <div class="card hidden" id="otp-card">
            <div class="card-body">
                <h5 class="card-title">Confirm OTP</h5>
                <form id="otp-form">
                    <div class="form-group">
                        <input type="text" name="otp" class="form-control otp-input" maxlength="6" placeholder="Enter OTP" required>
                        <input type="hidden" name="phone" id="phone-input">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Confirm</button>
                </form>
            </div>
        </div>
    </div>

  

    
    <script>
        

        function loginWithGoogle() {
            const googlePopup = window.open('<?= base_url('auth/googleLogin'); ?>', 'GoogleLogin', 'width=600,height=600');
            window.addEventListener('message', function(event) {
                if (event.data == 'UserLoginSuccess') {
                    if (googlePopup) {
                        googlePopup.close();
                    }
                    window.location.href = '/dashboard';
                }
            });
        }

        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const phone = document.querySelector('input[name="phone"]').value;

            $.ajax({
                url: 'login',
                method: 'POST',
                data: { phone: phone },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#login-card').addClass('hidden');
                        $('#otp-card').removeClass('hidden');
                        $('#phone-input').val(phone);
                        toastr.success('OTP sent successfully!');
                    } else {
                        toastr.error(response.message || 'Failed to send OTP');
                    }
                },
            });
        });
        document.getElementById('otp-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const otp = document.querySelector('input[name="otp"]').value;
            const phone = document.getElementById('phone-input').value;

            $.ajax({
                url: 'verifyotp',
                method: 'POST',
                data: {
                    otp: otp,
                    phone: phone
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        sessionStorage.removeItem('otpRetryCount');
                        window.location.href = '/dashboard';
                    } else {
                        let retryCount = parseInt(sessionStorage.getItem('otpRetryCount') || '0') + 1;
                        sessionStorage.setItem('otpRetryCount', retryCount.toString());

                        if (retryCount >= 3) {
                            sessionStorage.removeItem('otpRetryCount');
                            toastr.error('Maximum OTP attempts exceeded. Please try again.');
                            setTimeout(() => window.location.href = '/login', 2000);
                        } else {
                            toastr.warning(`Invalid OTP. ${3 - retryCount} attempts remaining.`);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('An error occurred. Please try again.');
                    console.error('Error:', error);
                }
            });
        });
    </script>
</body>
</html>
