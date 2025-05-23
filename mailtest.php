<html>

<head>
    <meta charset="utf-8">
    <title>Mail Test</title>

</head>

<body>

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v22.0&appId=946257136654856"></script>


    <div class="container">
        <h1 class="text-center">Mail Test</h1>
        <div class="messages"></div>
        <form id="contact_form5" method="POST" action="">
            <div class="form-group">
                <label for="name">Name:</label> <input type="text" class="form-control" id="name" name="form_name"
                    required><br />
                <label for="name">Phone:</label><input type="text" class="form-control" id="phone" name="form_phone"
                    required><br />
                <label for="name">Bot:</label><input type="text" class="form-control" id="botcheck"
                    name="form_botcheck"><br />
                <button type="submit" class="btn btn-info" id="name">Submit</button>
            </div>
        </form>


        <div class="fb-page" data-href="https://www.facebook.com/sankareventsandcelebrations" data-tabs="timeline"
            data-width="" data-height="" data-small-header="false" data-adapt-container-width="true"
            data-hide-cover="false" data-show-facepile="true">

        </div>


        <script type="text/javascript" src="js/jquery-1.12.4.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                console.log($('#contact_form5').length);
                console.log("document ready");

                $('#contact_form5').submit(function (e) {
                    e.preventDefault();
                    console.log('Form submitted');

                    var form = $(this);
                    var formData = form.serialize();

                    $.ajax({
                        url: 'api/RequestCallBack',
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        beforeSend: function () {
                            $('.messages').html('<div>Sending...</div>');
                        },
                        success: function (response) {
                            console.log(response, "success", response.success == true);
                            var msg = response.message;
                            console.log("msg", msg);

                            if (response.success) {
                                $('.messages').html('<div style="color:green;">success: ' + msg + '</div>');
                            } else {
                                $('.messages').html('<div style="color:red;">fail: ' + msg + '</div>');
                            }

                            form.trigger("reset");
                        },
                        error: function (xhr) {
                            var err = xhr.responseJSON?.message || "An error occurred.";
                            $('.messages').html('<div style="color:red;"> error: ' + err + '</div>');
                        }
                    });

                    return false;
                });
            });
        </script>

</body>

</html>