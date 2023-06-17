@extends('web.layouts.app', [
    'title' => config('app.links.contact.page'),
    'scripts' => 'pages.contact'
])

@section('content')
<!-- Contact Page Section -->
<section class="contact-page-section">
    <div class="patern-layer-one paroller" data-paroller-factor="0.40" data-paroller-factor-lg="0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-1.png)"></div>
    <div class="patern-layer-two paroller" data-paroller-factor="0.40" data-paroller-factor-lg="-0.20" data-paroller-type="foreground" data-paroller-direction="vertical" style="background-image: url(images/icons/icon-2.png)"></div>
    <div class="auto-container mt-5">
        <div class="inner-container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <h2>Get in touch</h2>
            </div>
            
            <!-- Contact Form -->
            <div class="contact-form">
            
                <!-- Profile Form -->
                <form method="post" action="sendemail.php" id="contact-form">
                    <div class="row clearfix">
                        
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <input type="text" name="username" placeholder="First Name*" required="">
                        </div>
                        
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <input type="text" name="lastname" placeholder="Last Name*" required="">
                        </div>
                        
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <input type="email" name="email" placeholder="Email Address*" required="">
                        </div>
                        
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <input type="text" name="phone" placeholder="Phone Number*" required="">
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <textarea class="" name="message" placeholder="Send Message"></textarea>
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group text-right">
                            <button class="theme-btn btn-style-three" type="submit" name="submit-form"><span class="txt">Send Message <i class="fa fa-angle-right"></i></span></button>
                        </div>
                        
                    </div>
                </form>
                    
            </div>
            
        </div>
        
        <!-- Contact Info Section -->
        <div class="contact-info-section">
            <div class="title-box">
                <h2>Contact Information</h2>
                <div class="text">Lorem Ipsum is simply dummy text of the printing <br> and typesetting industry.</div>
            </div>
            
            <div class="row clearfix">
                
                <!-- Info Column -->
                <div class="info-column col-lg-4 col-md-6 col-sm-12">
                    <div class="info-inner">
                        <div class="icon fa fa-phone"></div>
                        <strong>Phone</strong>
                        <ul>
                            <li><a href="tel:+1-123-456-7890">+1 (123) 456-7890</a></li>
                            <li><a href="tel:+1-123-456-7890">+1 (123) 456-7890</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Info Column -->
                <div class="info-column col-lg-4 col-md-6 col-sm-12">
                    <div class="info-inner">
                        <div class="icon fa fa-envelope-o"></div>
                        <strong>Email</strong>
                        <ul>
                            <li><a href="mailto:info@yourcompany.com">info@yourcompany.com</a></li>
                            <li><a href="mailto:infobootcamp@gmail.com">infobootcamp@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Info Column -->
                <div class="info-column col-lg-4 col-md-6 col-sm-12">
                    <div class="info-inner">
                        <div class="icon fa fa-map-marker"></div>
                        <strong>Address</strong>
                        <ul>
                            <li>Portfolio Technology 07, Capetown 12 Road, Chicago, 2436, USA</li>
                        </ul>
                    </div>
                </div>
                
            </div>
            
        </div>
        
    </div>
</section>
<!-- End Contact Page Section -->
@endsection