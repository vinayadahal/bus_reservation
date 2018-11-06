<!doctype html>
<html lang="en" class="no-js">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <title>
            <g:layoutTitle default="Grails"/>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <asset:stylesheet href="application.css"/>
    <g:layoutHead/>
</head>

<body id="container">
    <div class="menu_wrap">
        <div class="menu">
            <div class="logo">
                <a href="#">
                    <i class="fa fa-bus"></i> <span class="logo_text">Bus Reservation</span>
                </a>
            </div>
            <ul>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url(); ?>travel_agency">Travel Agencies</a></li>
                <li><a href="<?php echo base_url(); ?>member">Login</a></li>
                <!--                    <li class="dropdown-menu-li" id="side_drp_wrap" style="float: right;">
                                                <a href="javascript:void();" id="side_drp_down">
                                                    About <i class="fa fa-angle-down" style="font-weight: bold"></i>
                                                </a>
                                                <ul id="side_drp_list">
                                                    <li><a href="http://google.com">Objectives</a></li>
                                                    <li><a href="http://google.com">Chairmain's Message</a></li>
                                                    <li><a href="http://google.com">About Us</a></li>
                                                </ul>
                                            </li>-->
            </ul>

            <div class="search_area">
                <form method="get" action="<?php echo base_url() ?>show_ticket/">
                    <input type="text" placeholder="Search Ticket" class="form-elements search_box" name="keyword"/>
                    <button class="btn_submit search_btn" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>

            <div class="shrinked_menu">
<!--                <ol>
                    <li><a href="void(0);"><i class="fas fa-bars fa-3x"></i></a></li>
                </ol>-->
                <button onclick="mobile_menu();"><i class="fas fa-bars fa-3x"></i></button>
            </div>
        </div>
    </div>
    <div class="mobile_menu" id="mobile_menu">
        <ul>
            <li><g:link controller="Public" action="index">Home</g:link></li>
                <li><a href="#">Travel Agencies</a></li>
                <li><a href="member">Login</a></li>
            </ul>
        </div>
        <div class="content_wrap" id="content_wrap">
        <g:layoutBody/>
    </div>
    

    <div class="footerWrap" id="footerWrap">
        <div class="footerLinkWrap">
            <div class="footerLink">
                <i class="fa fa-bus fa-5x"></i> <span style="font-size: 24px;">Bus Reservation</span>
                <br/>
                <br/>
                © Copyright 2018 Bus Reservation. All Rights Reseverd. Privacy and Policy.
            </div>

            <div class="footerLink">
                <ul>
                    <li><h4>This Site</h4></li>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Travel Agencies</a></li>
                    <li><a href="#">Available Routes</a></li>
                    <li><a href="#">Popular Routes</a></li>
                </ul>
            </div>

            <div class="footerLink">
                <ul>
                    <li><h4>Other</h4></li>
                    <li><a href="javascript:void(0)" onclick="loadForm('Suggestion');">Gallery</a></li>
                    <li><a href="javascript:void(0)" onclick="loadForm('Suggestion');">Suggestion</a></li>
                    <li><a href="javascript:void(0)" onclick="loadForm('Feedback');">Feedback</a></li>
                </ul>
            </div>

            <div class="footerLink">
                <ul>
                    <li><h4>Follow us</h4></li>
                    <li><a href="https://www.facebook.com/"><span class="footerIcon fb">Facebook</span></a></li>
                    <li><a href="https://twitter.com/"><span class="footerIcon tw">Twitter</span></a></li>
                    <li><a href="https://plus.google.com/"><span class="footerIcon gp">Google +</span></a></li>
                    <li><a href="https://www.linkedin.com/"><span class="footerIcon in">Linked In</span></a></li>
                </ul>
            </div>
        </div>
    </div>
<asset:javascript src="application.js"/>
</body>
</html>
