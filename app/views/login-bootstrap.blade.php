@extends('template-bootstrap')
@section('section')
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Login</h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                <form name="sentMessage" id="contactForm" novalidate="" method="post">
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Id</label>
                            <input type="number" class="form-control" placeholder="Id" id="name" required="" data-validation-required-message="Please enter your id." aria-invalid="false" name="contestant_id" min="1" max="400">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Keystone</label>
                            <input type="text" class="form-control" placeholder="Keystone" id="phone" required="" data-validation-required-message="Please enter your keystone." aria-invalid="false"  name="keystone" minlength="8">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <br>
                    <div id="success"></div>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <button type="submit" class="btn btn-success btn-lg">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection