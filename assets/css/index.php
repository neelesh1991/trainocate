body{ background: #f5f5f5; font-size: 14px; color: #555; font-family: 'Roboto', sans-serif;}
body h1, body h2, body h3, body h4, body h5, body h6{ margin: 0 0 40px; color: #252525; text-transform: uppercase;}
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a{ color: #252525;}

p a{ color: #636363;}
p a:hover{ text-decoration:underline; outline: none;}
p{ letter-spacing: normal; margin: 0 0 40px; line-height: 23px; font-size: 16px; color: #636363;}

a{ color: #555; text-decoration: none; outline: none; display: block;}
a:hover, a:focus, a:active { outline: none; text-decoration: none;}

.row.no-gutters{ margin-right: 0; margin-left: 0;}
.row.no-gutters > [class^="col-"],
.row.no-gutters > [class*=" col-"]{ padding-right: 0; padding-left: 0;}

img{ max-width: 100%;}
iframe{ border: 0; width: 100%;}

button{ background: none;}

blockquote{ padding: 0; border: 0;}

label { color: #7f7f7f; display: block; font-weight: 400; margin: 0;}

textarea{ border-radius: 0!important; resize: none;}
textarea,
input[type="text"],
input[type="password"],
input[type="datetime"],
input[type="datetime-local"],
input[type="date"],
input[type="month"],
input[type="time"],
input[type="week"],
input[type="number"],
input[type="email"],
input[type="url"],
input[type="search"],
input[type="tel"],
input[type="color"],
input,
.form-control{ border: 0; height: 66px; width: 100%; border-radius: 0; color: #252525; font-weight: 400; width: 100%; background: none;
padding: 10px 0; font-size: 16px; line-height: 1.9; box-shadow: none;
-webkit-transition: all 0.28s ease;
transition: all 0.28s ease;}
.form-group{ position: relative; margin: 0 0 30px;}
.form-group .control-label{ position: absolute; top: 30px; pointer-events: none; font-size: 16px;
-webkit-transition: all 0.28s ease;
transition: all 0.28s ease;}
.form-group .bar{ position: relative; border-bottom: 1px solid #ccc; display: block;}
.form-group .bar::before{ content: ''; height: 2px; width: 0; left: 50%; bottom: -1px; position: absolute; z-index: 2;
-webkit-transition: left 0.28s ease, width 0.28s ease;
transition: left 0.28s ease, width 0.28s ease;}
select{ border-bottom: 1px solid #ccc!important;}
select:focus{ box-shadow: none!important;}
/****** Theme Reset Style ***********************************************************
*********************************************************** Theme Reset Style ******/

/****** Global Elements ***********************************************************
*********************************************************** Global Elements ******/
h3{ font-weight: 300; font-style: 24px;}

.main-heading-holder{ text-align: center;}
.main-heading{ display: inline-block; padding: 0 0 10px;}
.main-heading h2{ line-height: 35px; position: relative; padding: 0 28px; text-transform: capitalize; display: inline-block;
font-size: 39px; font-weight: 500; margin: 0 0 40px;}
.main-heading h2::before,
.main-heading h2::after{ content: ":::"; position: absolute; top: 0;}
.main-heading h2::before{ left: 100%;}
.main-heading h2::after{ right: 100%;}
.main-heading p{ font-size: 18px; font-weight: 300; line-height: 18px; margin: 0;}
.main-heading.style-2 h2{ text-align: left; padding-left: 0; margin: 0;}
.main-heading.style-2.add-p h2{ margin: 0 0 40px;}
.main-heading.h-white h2::before,
.main-heading.h-white h2::after{ color: #fff;}
.main-heading.style-2 h2::after{ display: none;}

.btn{ min-width: 220px; height: 60px; line-height: 60px; font-size: 14px; padding: 0 40px; border-radius: 3px; text-transform: uppercase; position: relative;
overflow: hidden;}
.btn.full-width{ width: 100%;}
.btn i{ margin: 0 0 0 10px;}
.btn.blue{ color: #fff; border: 0;}
.btn.blue:hover{ box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23); color: #fff!important;
opacity: 0.9;}
.btn.blank{ background: none; color: #fff; border: 1px solid #fff;}
.btn.blank:hover{ color: #fff;}
.btn.blank.dark{ border-color: #252525; color: #252525;}
.btn.blank.dark:hover{ color: #fff;}
.btn.sm{ height: 40px; line-height: 40px; padding: 0 20px; min-width: 100px;}
.circle-btn{ height: 50px; width: 50px; line-height: 50px; text-align: center; border-radius: 100%; font-size: 20px; color: #fff;
box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);}
.circle-btn:hover{ color: #fff;}
.btn.orange{ background:#FFA500;}
.btn.white{ background: #fff;}
.ripple{ position: absolute; background: rgba(0,0,0,.25); border-radius: 100%; transform: scale(0.2); opacity:0; pointer-events: none;
-webkit-animation: ripple .75s ease-out;
-moz-animation: ripple .75s ease-out;
animation: ripple .75s ease-out;}
@-webkit-keyframes ripple{ from{ opacity:1;} to{ transform: scale(2); opacity: 0;}}
@-moz-keyframes ripple{ from{ opacity:1;} to{ transform: scale(2); opacity: 0;}}
@keyframes ripple{ from{ opacity:1;} to{ transform: scale(2); opacity: 0;}}

/*.pagination-holder{ text-align: center;}*/
.pagination-holder ul{ margin: 0px 0 0;}
.pagination-holder ul li a{ height: 30px; line-height: 30px; width: 30px; border-radius: 100%!important; text-align: center;
padding: 0; border: transparent; box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);}
.pagination-holder ul li:first-child a,
.pagination-holder ul li:last-child a{ border: 1px solid #cdcdcd; background: none; box-shadow: none;}
.pagination-holder ul li{ margin: 0 0 0 7px !important; float: left;padding-top:10px;}
.pagination-holder ul li:first-child{ margin: 0;}
.pagination-holder ul li a:hover{ color: #fff!important;}
.pagination > li > a, .pagination > li > span{
	color: #252525;
}
.tc-breadcrumb ul{ display: inline-block;}
.tc-breadcrumb li{ float: left; color: #656565; font-family: 'Lato', sans-serif;}
.tc-breadcrumb li a{ float: left; font-weight: bold;}
.tc-breadcrumb li::before{ float: left; line-height: 22px; content: "\f111"; font-family: fontawesome; margin: 0 10px; font-size: 7px;}
.tc-breadcrumb li:first-child::before{ display: none; margin: 0;}

.social-icons{ overflow: hidden;}
.social-icons li{ float: left; margin: 0 0 0 10px;}
.social-icons li:first-child{ margin: 0;}
.social-icons li a{ height: 40px; line-height: 40px; text-align: center; width: 40px; border-radius: 100%; border-radius: 100%;
border: 1px solid rgba(255,255,255,0.2); color: rgba(255,255,255,0.2);}
.social-icons li a:hover{ color: #fff;}

.countdown{ margin: 0 0 20px; display: inline-block; overflow: hidden;}
.countdown li{ text-align: center; float: left; margin: 0 0 0 30px!important;}
.countdown li:first-child{ margin: 0!important;}
.countdown li span{ background: #fff; color: #252525; border-radius: 2px; font-size: 30px; padding: 30px 15px;
display: block; border: 1px solid #ebebeb; overflow: hidden; margin: 0 0 20px;}
.countdown li {
    color: #c1c1c1;
    font-size: 10px;
    text-transform: uppercase;
}
.countdown-one
{ margin: 0 0 20px; display: inline-block; overflow: hidden;}
.countdown-one
 li{ text-align: center; float: left; margin: 0 0 0 30px!important;}
.countdown-one
 li:first-child{ margin: 0!important;}
.countdown-one
 li span{ background: #fff; color: #252525; border-radius: 3px; font-size: 30px; padding: 30px 15px;
display: block; border: 1px solid #ebebeb; overflow: hidden; margin: 0 0 20px;}
.countdown-one
 li {
    color: #c1c1c1;
    font-size: 10px;
    text-transform: uppercase;
}
.rating-stars li{ float: left; margin: 0 0 0 7px;}
.rating-stars li:first-child{ margin: 0}
.rating-stars li i{ color: #f0bf2d;}

.tags-list,
.tags-list li
.meta-post li{ float: left; margin: 0 0 0 10px; color: #8f8f8f; font-family: 'Lato', sans-serif;}
.tags-list li,
.meta-post li{ float: left; margin: 0 0 0 10px;}
.tags-list li:first-child,
.meta-post li:first-child{margin: 0;}
.tags-list li i,
.meta-post li i{ margin: 0 10px 0 0; color: #8f8f8f;}
.meta-post li,
.meta-post li i{ color: #b6b6b6;}

.overlay-dark{ position: relative;}
.overlay-dark::before,
.overlay-dark::before{ content: ""; position: absolute; left: 0; top: 0; width: 100%; height: 100%;
background: rgba(0,0,0,0.5); z-index: -1;}

.position-center-center{ left: 50%; position: absolute; top: 50%;
-webkit-transform: translate(-50%, -50%);
-moz-transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
transform: translate(-50%, -50%);}
.position-center-x{ position: absolute; top: 50%;
-webkit-transform: translate(0, -50%);
-moz-transform: translate(0, -50%);
-ms-transform: translate(0, -50%);
transform: translate(0, -50%);}
.position-center-y{ left: 50%; position: absolute;
-webkit-transform: translate(-50%, 0);
-moz-transform: translate(-50%, 0);
-ms-transform: translate(-50%, 0);
transform: translate(-50%, 0);}
.p-absolute{ position: absolute;}
.p-relative{ position: relative;}

.z-index-2{ z-index: 2;}

.font-italic{ font-style: italic}
.font-lato{ font-family: 'Lato', sans-serif;}
.font-pt-serif{font-family: 'PT Serif', serif;}

.white-bg{ background: #fff;}
.gray-bg{ background: #f5f5f5;}
.text-white{ color: #fff;}
.font-bold{ font-weight: bold;}
.text-left{ text-align: left;}
.text-right{ text-align: right;}
.d-inline-block{ display: inline-block;}
.d-block{ display: block;}
.h-white h1,
.h-white h2,
.h-white h3,
.h-white h4,
.h-white h5,
.h-white h6{ color: #fff;}
.p-white p{ color: #fff;}
.h-m-0 h1,
.h-m-0 h2,
.h-m-0 h3,
.h-m-0 h4,
.h-m-0 h5,
.h-m-0 h6{ margin: 0;}
.p-m-0 p{ margin: 0;}
.h-white h1 a,
.h-white h2 a,
.h-white h3 a,
.h-white h4 a,
.h-white h5 a,
.h-white h6 a{ color: #fff;}
.p-white p{ color: #fff;}
.h-m-0 h1 a,
.h-m-0 h2 a,
.h-m-0 h3 a,
.h-m-0 h4 a,
.h-m-0 h5 a,
.h-m-0 h6 a{ margin: 0;}
.p-m-0 p a{ margin: 0;}

.navbar-brand{ height: auto; width: auto; padding: 0;}
.tc-padding-top{ padding-top: 75px;}
.tc-padding-bottom{ padding-bottom: 75px;}
.tc-padding{ padding: 20px 0;}
.tc-margin{ margin: 75px 0;}
.tc-margin-top{ margin-top: 80px;}
.tc-margin-bottom{ margin-bottom: 80px;}

.btn-list{ margin: 0; padding: 0; list-style: none;}
.btn-list li{ float: left; margin: 0 0 0 30px; width: 46%;}
.btn-list li:first-child{ margin: 0;}

.overlay{ position: absolute; left: 0; top: 0; height: 100%; width: 100%;}
ul{ margin: 0; padding: 0; list-style: none;}

.m-0{ margin: 0!important;}
.p-0{ padding: 0!important;}
.border-0{ border: 0!important;}
.m-lef-0{ margin-left: 0;}
.m-right-0{  margin-right: 0;}

.w-100-pre{ width: 100%;}
.h-100-pre{ height: 100%;}

.hash-layout{ float: left; width: 100%;}
.f-bold{ font-weight: bold;}

.z-depth-1{ box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);}
.z-depth-2{ box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);}
.z-depth-3{ box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);}
.z-depth-4{ box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);}
.z-depth-5{ box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);}

.black-bg-pattren{ background: url(../images/black-bg-pattren.jpg) repeat;}
.blue-bg-pattren{ background: url(../images/blue-bg-pattren.jpg) repeat;}
.tc-hover{ box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24); border-radius: 3px;}
.tc-hover:hover{ box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);}
/****** Global Elements ***********************************************************
*********************************************************** Global Elements ******/

/****** Home Page 1 ***********************************************************
*********************************************************** Home Page 1 ******/
.wrapper{ position: relative;}

/********* Header *********/

/* Top Bar */
.top-bar{ padding: 5px 0;line-height: 2}
.address-list-top ul li{ float: left; color: rgba( 255,255,255,0.6);}
.address-list-top ul li i{ margin: 0 10px 0 0;}
.address-list-top ul li::before{ content: "|"; margin: 0 15px; float: left;}
.address-list-top ul li:first-child::before{ display: none;}

.login-option{ float: right;}
.login-option a{ color: rgba( 255,255,255,0.6);}
.login-option a i{ margin: 0 0 0 10px;}
.login-form .modal-content > img{
	display: inline-block;
}
/* Nav */
.nav-holder{ position: relative; background: #fff;}
.menu-link-holder{ display: none;}

.logo{ padding: 5px 0; float: left;}

.search-nd-cart{ float: right; padding: 39.5px 0;}
.search-nd-cart li{ float: left; margin: 0 0 0 30px; padding: 0 0 0 30px; border-left: 1px solid #e5e5e5;}
.search-nd-cart li:last-child{ border: 0; padding: 0;}
.search-nd-cart li a{ font-size: 18px; color: #ccc;}
.cart a{ position: relative;}
.add-cart-no{ height: 15px; width: 15px; text-align: center; line-height: 15px; font-size: 9px; color: #fff;
display: block; font-style: normal; border-radius: 100%; position: absolute; right: -7px; top: -7px;}

/* Login Modal */
.login-form .modal-dialog{ margin: 0;}
.login-form .modal-content{ width: 320px; padding: 30px; text-align: center;}
.login-form .modal-content > img{ margin: 0 0 40px;}
.login-form .modal-content h4{ font-size: 18px; margin: 0 0 30px; font-weight: 300;}
.login-form .btn-list li:last-child{ margin: 0 0 0 70px;}
.remeber-nd-forget{ padding: 30px 0 50px; overflow: hidden; width: 100%;}
.remeber-nd-forget a{ font-size: 14px; color: #959595; font-style: italic;}
.login-form .social-icons-2 > span{ text-transform: uppercase; color: #252525; display: inline-block; margin: 0 0 20px;}
.login-form .social-icons-2 ul li a{ color: #cccccc;}
.login-form .btn.dark{ border-color: #ccc; color: #959595;}

/* Search Field */
.search-field{ margin: 8px 0 0 20px; position: relative;}
.search-box{ position: absolute; top: 150%; opacity: 0; visibility: hidden; width: 200px; right: 0; z-index: 1;}
.search-box button{ position: absolute; top: 0; right: 0; background: none; border:0; width: 40px; height: 100%;}
.on-click{ top: 110%; opacity: 1; visibility: visible;}

#searching{ opacity:0.0; position:absolute; top: 0; width:0%; height:100%; left:50%; z-index:100; overflow:hidden;
-webkit-transition: all 300ms ease;
-moz-transition: all 300ms ease;}
#searching.active{ opacity:1.0; width:100%; top:0%; left:0%; border-radius:0; background: rgba(0,0,0,0.1);}
#searchThis{ width:100%; background-color:#fff; border-radius:1px; z-index:101;}
#searchThis input{ width:calc(100% - 55px); height:100px; padding: 0 30px; font-size: 25px;}
#closeSearch{ position:absolute; top:0; right:0; width:100px; height:100px; text-align:center; line-height:100px;
cursor:pointer; color:#FFF; font-size:2em;}
#searchResults{ position:absolute; top:55px; left:0; width:100%; height:calc(100% - 55px);}
#searchResults a{display:block; background: #fff; padding:6px 15px; text-decoration:none; font-size:1.1em; color:#333;}
.link{ padding:10px; text-align:center; text-transform:uppercase; cursor:pointer; margin-top:0%;}

/* Nav List */
.nav-list{ float: right;}
.nav-list ul li{ float: left;}
.nav-list > ul > li > a{ position: relative; font-size: 16px; font-weight: 500; text-transform: uppercase; color: #363636; padding: 38.4px 20px;}
.nav-list > ul > li > a::before{ content: ""; position: absolute; bottom: 0; left: 0; width: 0; opacity: 0; border-bottom: 3px solid;
visibility: hidden;}
.nav-list > ul > li.active > a::before,
.nav-list > ul > li > a:hover::before{ width: 100%; opacity: 1; visibility: visible;}

/* Dropdown */
.nav-list ul li > ul{ list-style: none; margin: 0; padding: 0; top: 120%; transform: scale(0.9); border-radius: 0 0 4px 4px; position: absolute; width: 200px;
visibility: hidden; opacity: 0; background: #fff; z-index: 100; border-bottom: 3px solid;
-webkit-box-shadow: inset 0px 2px 3px 0px rgba(50, 50, 50, 0.24);
-moz-box-shadow: inset 0px 2px 3px 0px rgba(50, 50, 50, 0.24);
box-shadow: inset 0px 2px 3px 0px rgba(50, 50, 50, 0.24);}
.nav-list ul li ul li{ position: relative; float: none; border-bottom: 1px solid #e8e8e8;}
.nav-list ul li ul li:last-child{ border: 0;}
.nav-list ul li ul li a{ width: 100%; position: relative; color: #363636; padding: 15px 30px; font-size: 14px; text-transform: uppercase; text-align: left;}
.nav-list ul li ul li a:hover{ background: rgba(0,0,0,0.1);}
.nav-list ul li.dropdown-icon > a::after{ content: "\f107"; font-family: fontawesome; position: absolute; margin: 0 0 0 10px;}
.nav-list ul li ul li.dropdown-icon > a::after{ content: "\f105"; margin: 0 0 0 40px;}
.nav-list ul li ul li a i{ color: #666; position: absolute; right: 10px; top: 50%; margin: -7px 0 0;}
.nav-list ul li:hover > ul{ visibility: visible; opacity: 1; top: 100%; transform: scale(1);}
.triple-eff{ position: relative; overflow: hidden;}
/* Sub Menu */
.nav-list ul li > ul li ul{ left: 110%; top: 0!important;}
.nav-list ul li ul li:hover > ul{ visibility: visible; opacity: 1; left: 100%;}

/* Responsive Menu */
.r-nav-logo{ text-align: center; padding: 0 0 40px; border-bottom: 1px solid rgba(0,0,0,0.1);}
.responive-nav{ background: #fff; padding: 40px 0; overflow: auto;}
.respoinve-nav-list li a{ padding: 20px 30px; border-bottom: 1px solid rgba(255,255,255,0.1);}
.respoinve-nav-list li a:hover{ background: rgba(0,0,0,0.1);}
.respoinve-nav-list > li:last-child > a{ border-bottom: 0;}
.respoinve-nav-list li ul{ margin: 0 0 0 30px;}
.respoinve-nav-list li ul li a{ padding: 15px; margin: 0 0 0 30px;}
.responsive-btn{ display: block; padding: 10px 0; position: absolute; bottom: -30px; z-index: 1; right: 50px;}

/* Banner */
.caption .btn-list{ display: inline-block;}
.delay-1{ animation-delay: 0.4s;}
.delay-2{ animation-delay: 0.6s;}
.delay-3{ animation-delay: 0.8s;}
.delay-4{ animation-delay: 1s;}
.delay-5{ animation-delay: 1.2s;}
.delay-6{ animation-delay: 1.4s;}
.delay-7{ animation-delay: 1.6s;}
.caption h1{ font-size: 40px; margin: 0 0 40px; font-weight: 300; text-transform: uppercase;}
.caption p{ margin: 0 0 50px;}
.carousel-indicators{ position: absolute; left: 50%; margin: 0 0 0 -130px; width: auto; bottom: 30px;}
.carousel-indicators li,
.carousel-indicators li.active{ height: 5px; width: 70px; background: rgba(255,255,255,0.5); border-radius: 0; border: 0; float: left; margin: 0 0 0 10px;}
.carousel-indicators li:first-child{ margin: 0;}
.carousel-indicators li.active{ background: #fff;}

/********* Main Content *********/

/* Why Chose Us */
.why-chose-us{ background: #005D9B;}
.facts-column{ padding: 20px; background: #fff; position: relative; border-radius: 4px;}
.facts-column{ padding: 20px; background: #fff; position: relative; border-radius: 4px;}
.facts-column h4{ font-weight: 300; opacity: 0.6; margin: 30px 0; font-size: 16px;}
.facts-column strong{ font-size: 36px; font-weight: 300; line-height: 26px;}
.facts-column i{ font-size: 40px; position: absolute; top: 32px; right: 20px; color: #cecece;}
.facts-column i img{ width:75px;}
.facts-column:hover i{ font-size: 50px;}

/* Our Courses */
.our-courses{ border-top: 20px solid;}
.course-column{ border-radius: 4px; overflow: hidden;}
.course-detail{ overflow: hidden; padding: 40px 30px; background: #fff;}
.course-detail h3{ text-transform: capitalize; }
.date{ color: #959595; font-style: italic; font-size: 14px; display: block; margin: 0 0 30px;}
.date i{ margin: 0 10px 0 0; font-size: 12px;}
.course-detail .btn{ text-transform: capitalize;}

/* Video Section */
.video-section{ height: 700px; position: relative;}
.video-section img{ width: 100%;}
.video-section::before{ z-index: 1;}
.video-title-holder{ position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 2; text-align: center;}
.video-titel h3{ font-weight: normal; font-size: 60px; font-weight: 300; color: #fff; margin: 0;}
.video-titel h3 i{ font-size: 70px; color: #fff; margin: 0 50px}
.youtube { background-position: center; background-repeat: no-repeat; position: relative; display: block; overflow: hidden; transition: all 200ms ease-out;
cursor: pointer; height: 100%;  width: 100%; position: absolute; left: 0; top: 0;}

/* Events */
.event-column{ position: relative; overflow: hidden; margin: 0 0 30px; border-radius: 4px;}
.event-detail{ padding: 30px; background: #fff; bottom: 0; width: 100%; top: auto; height: 100px;}
.event-detail h4{ margin: 0 0 30px; text-transform: capitalize;}
.event-detail ul{ opacity: 0; visibility: hidden;}
.event-detail ul li{ margin: 0 0 15px; font-size: 16px; color: #959595; font-weight: 300;}
.event-detail ul li:last-child{ margin: 0;}
.event-detail ul li i{ margin: 0 10px 0 0;}
.event-detail .circle-btn{ position: absolute; top: -20px; right: 30px;}
.event-column:hover .circle-btn{
-webkit-transform: rotate(-45deg);
-moz-transform: rotate(-45deg);
-ms-transform: rotate(-45deg);
-o-transform: rotate(-45deg);}
.event-column:hover img{ margin: -30px 0 30px;
-webkit-filter: blur(2px);
-moz-filter: blur(2px);
-o-filter: blur(2px);
-ms-filter: blur(2px);
filter: blur(2px);}
.event-column:hover{ box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 22px rgba(0, 0, 0, 0.14);}
.event-column:hover .event-detail{ height: 190px;}
.event-column:hover .event-detail ul{ visibility: visible; opacity: 1; }

/* Testimonial */
.testimonial{ text-align: center; }
.testimonil-slider li{ text-align: center;}
.testimonil-slider li span{ display: inline-block; font-size: 24px; font-weight: 300; color: #fff; margin: 0 0 30px;
line-height: 20px;}
.testimonil-slider li p{ font-size: 57px; color: #fff; font-weight: 300; line-height: 70px; margin: 0 0 20px;}

.testimonil-thumnails{ display: inline-block;}
.testimonil-thumnails a{ float: left; margin: 0 0 0 15px; border-radius: 100%; overflow: hidden;}
.testimonil-thumnails a:first-child{ margin: 0; }
.testimonil-thumnails a.active{ transform: scale(1.2);}

/* Blog */
.blog-column{ border-radius: 4px; overflow: hidden;}
.tranding-post .blog-detail::before{ content: "\f02e"; position: absolute; top: -6px; left: 30px; font-family: fontawesome; font-size: 20px;}
.blog-column:hover{ box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);}
.blog-column:hover img{ transform: scale(1.1);}
.blog-detail{ padding: 40px 30px; background: #fff; position: relative;}
.meta-post{ overflow: hidden; margin: 0 0 20px;}
.meta-post li{ float: left; margin: 0 0 0 30px; font-style: italic;}
.meta-post li:first-child{ margin: 0;}
.meta-post li i{ margin: 0 10px 0 0;}
.blog-detail h3{ font-weight: 300; font-size: 30px; text-transform: capitalize;}
.blog-detail p{  font-weight: 300; font-size: 16px; line-height: 27px;}
.blog-detail-btm .btn:hover{ border-color: #252525; color: #252525;}

.like-nd-comment{ float: right; padding: 10px 0 0;}
.like-nd-comment li{ float: left; margin: 0 0 0 10px; color: #ccc;}
.like-nd-comment li:first-child{ margin: 0;}
.like-nd-comment li i{ margin: 0 5px 0 0; font-size: 20px;}

.blog-column .circle-btn{ position: absolute; top: -20px; right: 30px; background: #8bc34a;}
.circle-btn.music{ background: #03a9f4;}

/* Client Logo */
.client-logo{ background: #ebebeb;}


/********* Footer *********/
.footer{ background: #252525;}
.footer-column{ padding: 20px 0;}

/* Footer Columns */
.f-column-widget h4{ font-weight: 18px; position: relative; color: #fff; display: inline-block;
padding: 0 10px 0 0; margin: 0 0 15px;}
.f-column-widget h4::before{ content: ":::"; position: absolute; left: 100%;}
.address-widget{ color: #959595;}
.address-widget p{ margin: 0 0 20px; color: #959595;}
.address-list li{ margin: 0 0 10px;}
.address-list li i{ margin: 0 10px 0 0;}
.address-widget .social-icons{ margin: 30px 0 0;}

/* Courses List */
.courses-list-link li{ float: left; width: 50%; margin: 0 0 15px; position: relative; padding: 0 0 0 12px;}
.courses-list-link li::before{ content: "\f111"; font-family: fontawesome; position: absolute; left: 0; font-size: 5px; top: 50%;
margin: -4px 0 0;}
.courses-list-link li a{ color: #959595;}
.course-detail .btn:hover{ border-color: #252525; color: #252525;}

/* Newslatter */
.newslatter p{ font-size: 14px; color: #959595;}
.newslatter input{ height: 50px; line-height: 50px; padding: 0 15px;}
.newslatter .form-control{ background: rgba(255,255,255,0.1); color: #959595;}

/* Instagram Gallery */
.instagram-gallery ul{ margin: 0 0 0 -10px;}
.instagram-gallery ul li{ float: left; margin: 0 0 10px 10px;}
.instagram-gallery ul li:hover a img{ transform: scale(1.1);}
.instagram-gallery > a{ font-size: 12px; color: #959595;}
.instagram-gallery > a i{ margin: 0 5px 0 0;}

/* Sub Footer */
.sub-footer{ padding: 5px 0; background: #005D9B;}
.sub-footer p{ float: left; margin: 0; font-size: 12px; color: #c2c2c2; text-transform: uppercase;}
.sub-footer-nav{ float: right;padding-top:3px;}
.sub-footer-nav li{ float: left;}
.sub-footer-nav li::before{ content: "|"; margin: -2px 10px; float: left; color: #c2c2c2;}
.sub-footer-nav li:first-child::before{ display: none;}
.sub-footer-nav li a{ float: left; color: #c2c2c2; font-size: 12px; text-transform: uppercase;}
/****** Home Page 1 ***********************************************************
*********************************************************** Home Page 1 ******/
.et_pb_promo_description{
padding-bottom: 20px;
text-align: center;
}

.et_pb_promo_description .btn{
   border-radius: 8px;
    font-size: 14px;
    height: 40px;
    line-height: 40px;
    min-width: 145px;
    overflow: hidden;
    padding: 0 10px;
    position: relative;
    text-transform: uppercase;
    border: 2px solid #005d9b;
    font-weight: 500;
}
.carousel-inner .btn
{
 font-weight: 500;
}
.et_pb_promo_description .btn:hover, .carousel-inner .btn:hover{
  background: #464646 !important;
  border-color: #fff !important;
  font-weight: 500;
}

.et_pb_promo_description h2, .et_pb_promo_description h3 {
    font-weight: bold !important;
    letter-spacing: 2px !important;
    color: #fff;
    text-align: center;
}

/****** Home Page 2 ***********************************************************
*********************************************************** Home Page 2 ******/
.nav-holder.style-2{ background: #fff;}
.nav-holder.style-2 .search-nd-cart{ padding: 36.5px 0;}

/* About Us */
.about-us{ position: relative;}
.about-us::before{ content: ""; position: absolute; top: 0; width: 100%; height: 310px;}
.about-us-inner{ margin: 0 0 50px;}
.about-text{ background: #fff; padding: 30px 30px 30px; border-radius: 4px; overflow: hidden;}
.about-text h3{ font-weight: 300;}
.about-video{ position: relative;}
.about-text .btn:hover{ border-color: #252525; color: #252525;}

.facts-column.style-2,
.facts-column.style-2 h4,
.facts-column.style-2 i{ color: rgba(255,255,255,0.8);}

.facts-column.color-1{ background: #03a9f4;}
.facts-column.color-2{ background: #009688;}
.facts-column.color-3{ background: #8bc34a;}

/* Team */
.team-column{ text-align: center;}
.team-img{ overflow: hidden; margin: 0 0 30px;}
.team-img img{ border-radius: 100%; }
.team-detail h3{ font-weight: 300; margin: 0 0 15px; text-transform: capitalize;}
.team-detail span{ font-size: 16px; font-weight: 300; font-style: italic; margin: 0 0 15px; display: block;}

.social-icons-2 ul{ display: inline-block;}
.social-icons-2 ul li{ float: left; margin: 0 0 0 20px;}
.social-icons-2 ul li:first-child{ margin: 0;}
.social-icons-2 ul li a{ font-size: 20px;}

/* Gallery H0lder */
.gallery .main-heading{ padding: 0 0 30px;}

.filter-tags-holder{ margin: 0 0 80px;}
.filter-tags-holder ul{ margin: 0 0 -4px; padding: 0; list-style: none; display: inline-block;}
.filter-tags-holder ul li{ float: left; margin: 0 0 0 20px;}
.filter-tags-holder ul li:first-child{ margin: 0;}
.filter-tags-holder ul li a{ color: #141414; font-size: 18px; font-weight: 300; padding: 5px 15px; border-bottom: 3px solid transparent;}
.filter-tags-holder ul li a.selected{ border-bottom: 3px solid;}

.gallery-figure{ overflow: hidden; position: relative;}
.gallery-figure img{ width: 100%;}
.gallery-figure .overlay{ visibility: hidden; opacity: 0; left: -100%;}
.gallery-figure:hover .overlay{ visibility: visible; opacity: 1; left: 0;}
.gallery-figure .overlay a{ height: 50px; width: 50px; line-height: 50px; text-align: center; background: #fff;}

.more-load-btn{ text-align: center; padding: 22px 0; background: #f5f5f5;}
.more-load-btn a{ font-size: 25px; color: #ccc; display: inline-block;}

/* Services */
.service-column{ position: relative; padding-left: 75px; margin: 0 0 60px;}
.service-column h3{ font-weight: 300; margin: 0 0 20px; text-transform: capitalize;}
.service-column p{ color: #636363; font-size: 16px; font-weight: 300; line-height: 30px; margin: 0;}
.service-icon{ position: absolute; left: 0; top: -15px; line-height: 0; font-size: 45px;}

/* Contact */
#contact-form .btn{ margin: 80px 0 0;}
#contact-form .btn:hover{ color: #252525; border-color: #252525;}

/* Footer style-2 */
.footer.style-2 .address-widget p{ font-weight: 300; line-height: 30px; font-size: 24px; color: #fff;}
.footer.style-2 .address-list li{ color: #fff;}
.footer.style-2 .newslatter p{ color: #fff;}
.footer.style-2 .newslatter .form-group{ margin: 0;}
.footer.style-2 .newslatter .form-group .btn{ position: absolute; right: 0; background: #fff; top: 0; border-radius: 0;}
.footer.style-2 .newslatter .form-group input{ height: 60px; line-height: 60px; border: 1px solid #fff; background: none;}
.footer.style-2 .sub-footer{ background: #252525;}
/****** Home Page 2 ***********************************************************
*********************************************************** Home Page 2 ******/

/****** Home Page 3 ***********************************************************
*********************************************************** Home Page 3 ******/

/* Banner */
.content-banner{ position: relative;}
.content-banner > img{ width: 100%;}
.layer-holder{ position: absolute; left: 0; top: 0; height: 100%; width: 100%;}
.banner-tags{ position: absolute; cursor: pointer;}
.tags-1{ left: 200px; top: 80px;}
.tags-2{ right: 200px; top: 40px;}
.tags-3{ left: 0; bottom: 100px;}
.tags-4{ right: 0; bottom: 200px;}
.tags-5{ right: 400px; bottom: -40px;}
.banner-tags .overlay h6{ margin: 0; position: absolute; bottom: 0; padding: 10px; font-size: 14px; color: #fff;
text-transform: uppercase;}
.banner-tags:hover img{ transform: scale(1.1);}
.banner-3-caption{ text-align: center;}
.banner-3-caption h3{ margin: 0; font-size: 24px; font-weight: bold; text-transform: uppercase;
letter-spacing: 40px; color: #fff;}
.banner-3-caption h1{ font-size: 120px; color: #fff; font-weight: bold;}
.scroll-down{ height: 70px; width: 70px; border-radius: 100%; border: 2px solid #fff; color: #fff;
text-align: center; line-height: 70px; font-size: 20px; margin: 130px 0 0 0;}
.scroll-down:hover{ color: #fff;}

/* Our Courses Style 2 */
.our-courses.style-2{ border: 0;}

/* Facts Style 2 */
.facts.style-2{ background: #252525;}
.facts.style-2 .facts-column{ text-align: center; background: none;}
.facts.style-2 .facts-column i{ position: static; margin: 0 0 10px;}
.facts.style-2 .facts-column h4{ color: #fff;}
.facts.style-2 .facts-column strong{ font-size: 72px; font-weight: 100; color: #fff;}
.facts.style-2 .icon-color-1 i{ color: #03a9f4;}
.facts.style-2 .icon-color-2 i{ color: #009688;}
.facts.style-2 .icon-color-3 i{ color: #8bc34a;}
.facts.style-2 .icon-color-4 i{ color: #ffc107;}
.facts.style-2 .facts-column:hover i{ font-size: 40px;}

/* Event Style 2 */
.comming-events.style-2{ background: #005D9B; position: relative;}
.comming-events.style-2::before,
.comming-events.style-3::before{ content: ""; position: absolute; left: 0; bottom: 0; width: 100%; height: 137px; background: #f5f5f5;}
.event-row{ background: #fff; position: relative; z-index: 1; border-radius: 4px;}
.event-detail-style-2{ padding: 45px 100px;}
.event-detail-style-2 h4{ font-weight: 300; font-size: 20px; text-transform: capitalize; margin: 0 0 30px;}
.event-detail-style-2 .meta-post li{ float: none; margin: 0 0 10px; font-style: normal;}
.event-detail-style-2 .meta-post li:last-child{ margin: 0;}

/* Team Style 2 */
.team-column.style-2{ background: #fff; padding: 30px;}
.team-column.style-2 p{ font-size: 14px; margin: 0 0 30px;}

/* Gallery Style 2 */
.gallery.style-2 .filter-tags-holder{ text-align: center;}

/* Service Style 2 */
.service-column.style-2{ padding: 0; text-align: center; margin: 0;}
.service-column.style-2 .service-icon{ position: static; margin: 0 0 40px; display: block;}
.service-column.style-2 h3{ font-size: 14px; font-weight: bold; color: #636363; text-transform: uppercase;}

/* Chose Option */
.chose-option{ min-height: 600px; position: relative;}
.chose-detail{ height: 100%; position: absolute; width: 50%;}
.Scholarship{ background: #03a9f4; left: 0;}
.apply{ background: #ff5722; right: 0;}
.chose-detail .position-center-center{ width: 80%;}
.detail-option{ text-align: center;}
.detail-option .btn{ background: #fff;}
.detail-option h2{ font-size: 48px; font-weight: 300; text-transform: capitalize;}
.detail-option::before{ content: ""; position: absolute; top: -120px; left: 50%; border: 100px solid rgba(255,255,255,0.2);
padding: 50px; margin: 0 0 0 -150px; z-index: -1;}
.detail-option.style-1::before{ border-radius: 100%;}
.detail-option.style-2::before{ border-radius: 0;}
/****** Home Page 3 ***********************************************************
*********************************************************** Home Page 3 ******/

/****** Home Page 4 ***********************************************************
*********************************************************** Home Page 4 ******/
/* Form banner */
.form-banner{ padding: 160px 0;}
.learning-online-form h2{ font-size: 60px; margin: 0 0 20px; text-transform: capitalize; font-weight: 300; color: #fff;}
.learning-online-form p{ color: #fff; font-size: 20px; font-weight: 300; margin: 0 0 30px;}
.learning-online-form form .form-group .control-label{ color: #fff;}
.learning-online-form form .btn{ background: #fff; margin: 60px 0 0;}
.learning-online-form form input{ color: #fff!important;}
.learning-online-form form .bar::before{ background: #fff!important;}

.banner-layer img{ float: right;}

/* Find The Course */
.find-courses.style-2{ background: #263238;}
.find-courses.style-2 .form-group input{ color: #fff!important;}
.find-courses.style-2 .form-control{ color: #fff;}
.find-courses.style-2 .form-group .control-label{ color: #fff;}
.find-courses.style-2 form input{ color: #fff!important;}

/* Awesome Courses */
.course-column.style-2{ margin: 0 0 30px;}
.course-column.style-2 h3{ line-height: 40px; text-transform: capitalize; margin: 0 0 20px;}
.courses-rating{ color: #252525; font-weight: 300;}
.courses-rating i{ color: #ffc107; margin: 0 0 0 5px; line-height: 35px;}

/* Clients Logo */
.client-logo.style-2{ background: #fff;}

/* Pricing Plans */
.pricing-plan-holder{ background: #4caf50;}
.pricing-plan h3{ font-size: 48px; font-weight: 300; text-transform: capitalize; margin: 0 0 20px;}
.pricing-plan > h2{ font-size: 100px; font-weight: 100; text-transform: capitalize;}
.pricing-plan h2 span{ font-size: 24px; font-weight: 300;}
.pricing-plan .check-list{ margin: 0 0 80px;}
.check-list li{ position: relative; padding-left: 30px; margin: 0 0 20px; color: #fff; font-size: 18px; font-weight: 300;}
.check-list li::before{ content: "\f00c"; font-family: fontawesome; position: absolute; left: 0;}
.check-list li:last-child{ margin: 0;}

/* Pricing Plan Video */
.pricng-video-holder{ text-align: center;}
.pricng-video-holder > img{ position: absolute; z-index: 1; top: -60px; left: 0;}
.pricng-video{ display: inline-block; position: relative; z-index: 2;}

/* footer style-3 */
.footer.style-3{ padding: 50px 0; background: #fff;}
.center-links{ display: inline-block;}
.center-links p{ margin: 0;}
.sub-footer-nav-h{ overflow: hidden;}
.sub-footer-nav-h .sub-footer-nav{ display: inline-block; float: none;}

.footer.style-3 .social-icons li a{ border-color: #cacaca; color: #cacaca;}
/****** Home Page 4 ***********************************************************
*********************************************************** Home Page 4 ******/

/****** Home Page 5 ***********************************************************
*********************************************************** Home Page 5 ******/
.box-layout{ background: url(../images/body-bg.png) repeat; background-attachment: fixed;}
.box-layout .wrapper{ max-width: 1250px; margin: 50px auto; background: #ebebeb;}

/* Video Banner */
.video-banner{ height: 703px; position: relative; overflow: hidden;}
video{ width: 100%; height: auto; max-height: 100%;}
.video-caption-holder{ position: absolute; left: 0; top: 0; height: 100%; width: 100%; background: rgba(0,0,0,.6);}
.video-caption{ text-align: center;}
.video-caption h3{ margin: 0 0 20px; font-size: 24px; font-weight: bold; letter-spacing: 30px;}
.video-caption h2{ font-size: 55px; font-weight: bold; padding: 8px; border: 8px solid #fff; margin: 0;}

/* Services Style 3 */
.service.style-3{ padding: 50px 40px; border-radius: 4px; margin: -50px 0 0; position: relative; z-index: 2;}
.service.style-3 .service-column.style-2:hover .service-icon{ color: #fff;}
.service.style-3 .service-column.style-2 h3{ margin: 0; font-size: 12px;}
.service.style-3 .service-column.style-2:hover h3{ color: #fff;}

/* Courses Style 3 */
.our-courses.style-3 .course-column.style-2{ margin: 0;}

/* Testimonial Style 3 */
.our-courses.style-3{ border: 0;}
.testimonial.style-3::before{ z-index: 2;}

/* Event Style 3 */
.comming-events.style-3{ position: relative;}
.comming-events.style-3::before{ background: #ebebeb;}

/* Featured Events */
.featured-events .main-heading h2{ margin: 0 0 40px;}
.featured-events .event-column{ margin: 0;}

/* Client Logos */
.client-logo.style-3{ background: #fff; padding: 35px 0;}

/* Contact Us */
.contact-us{ position: relative;}
.contact-us::before{ content: ""; position: absolute; top: 0; width: 100%; height: 310px;
background: url(../images/black-bg-pattren.jpg) repeat;}
.contact-address{ background: #fff; padding: 30px;}
.contact-address .address-list{ margin: 0 0 120px;}
.contact-address .social-icons-2 ul li a{ color: #ccc;}
.contact-map-holder{ height: 440px;}
/****** Home Page 5 ***********************************************************
*********************************************************** Home Page 5 ******/

/****** Home Page 6 ***********************************************************
*********************************************************** Home Page 6 ******/
.home-6{ background: #ebebeb;}

/* Banner */
.content-banner.style-2{ height: 740px;}
.banner-nam-img{ z-index: -1; top: 40px;}
.content-banner.style-2 .banner-caption{ width: 100%;}
.content-banner.style-2 .banner-caption h2{ font-size: 120px; margin: 0; font-weight: bold;}
.content-banner.style-2 .banner-caption h3{ letter-spacing: 26px; font-weight: bold; margin:  0 0 60px;}
.banner-caption .btn{ background: #fff;}
.banner-caption .btn i{ margin: 0 10px 0 0;}

/* About Text */
.a-text{ margin: 80px 0 0;}
.about-text-inner p:last-child{ margin: 0;}
.about-text-inner p{ line-height: 30px; margin: 0 0 20px; font-size: 16px;}
.about-text-inner{ text-align: center; width: 67%; margin: 0 auto;}

/* Awesome Services */
.service-column.style-3{ padding-left: 100px;}
.service-column.style-3 .service-icon{ height: 70px; width: 70px; text-align: center; background: #dcdcdc; font-size: 20px;
line-height: 70px; border-radius: 100%; color: #fff; top: 0;}
.service-column.style-3 p{ font-size: 14px; line-height: 24px; color: #636363;}

/* Pricing Plan */
.pricing-plan-holder.bg-1{ background: #03a9f4;}
.pricing-plan-holder.bg-2{ background: #4caf50;}
.pricing-plan-holder.style-2{ padding: 180px 0;}
.course-img.style-2{ margin: 40px 0 0; border-radius: 4px;}
.pricing-plan-holder.style-2 .pricing-plan{ background: none;}
.pricing-plan-holder.style-2 .pricing-plan p{ font-size: 18px; color: #fff; line-height: 30px; margin: 0 0 60px}
.pricing-plan-holder.style-2 .pricing-plan .btn{ background: #fff;}
.pricing-plan-holder.style-2 .pricing-plan .rating-stars-h{ overflow: hidden; margin: 0 0 30px;}
.pricing-plan-holder.style-2 .pricing-plan .rating-stars li i{ font-size: 20px;}

/* Testimonial */
.testimonial-column{ background: #fff; padding: 30px; border-radius: 4px; min-height: 500px;}
.aurthor-name{ position: relative; padding: 0 0 0 90px; margin: 0 0 40px;}
.aurthor-name > img{ position: absolute; left: 0; border-radius: 100%;}
.aurthor-name h4{ margin: 0 0 10px; font-weight: 300; padding: 10px 0 0; text-transform: capitalize; font-size: 24px;}
.aurthor-name span{ font-style: italic; font-size: 16px;}
.testimonial-column blockquote{ margin: 0; font-weight: 300; line-height: 30px;}
/****** Home Page 6 ***********************************************************
*********************************************************** Home Page 6 ******/

/****** Event Detail ***********************************************************
*********************************************************** Event Detail ******/
/* Inner Banner */
.inner-banner{ min-height: 200px; position: relative;}
.inner-page-heading.style-2 .main-heading{ position: absolute; padding: 0; bottom: 30px; left: 50%; margin: 0 0 0 -280px;}
.inner-page-heading.style-2 .main-heading h2{ font-size: 40px; margin: 0 0 30px;}
.inner-page-heading.style-2 .main-heading span{ color: #fff; margin: 0;}
.inner-banner.green-bg{ background: #8cc34b;}
.inner-banner.dark-bg{ background: #252525;}
.inner-banner.sky-bg{ background: #00bcd4;}

/* single event detail */
.event-detail-holder{ padding: 40px 0px 0px;}
.price-figure{ margin: -150px 0 30px;}
.Price-Figure-deatil{ padding: 30px; background: #fff; border-radius: 4px;}
.Price-Figure-deatil span{ display: block; color: #252525; margin: 0 0 10px; font-size: 16px;}

.countdown.style-2 li{ margin: 0 0 0 10px!important;}
.countdown.style-2 li:first-child{ margin: 0!important;}
.countdown.style-2 li span{ font-size: 25px; padding: 25px 13.7px; border-radius: 4px;}

.single-event-detail h4 i{ margin: 0 10px 0 0;}

.speakers-list{ border-bottom: 1px solid #dcdcdc; padding: 0 0 40px;}
.aurthor-name.style-2{ padding: 0 0 0 70px;}
.aurthor-name.style-2 h4{ font-size: 16px; font-weight: 500; margin: 0;}
.aurthor-name.style-2 span{ font-weight: 300;}
.time-address h4{ margin: 0 0 30px;}
.time-address p{ margin: 0;}

.description{ padding: 40px 0 0; border-top: 1px solid #fff;}
.description p{ font-weight: 300; line-height: 30px; margin: 0 0 30px;}
.description p:last-child{ margin: 0;}

.join-event-option{ padding: 40px 3px 80px; margin: 0 -3px; overflow: hidden;}
.join-event-option .btn-list{ overflow: hidden; margin: -5px; padding: 5px;}
.join-event-option .btn-list .btn{ font-size: 16px; font-weight: 300; color: #959595; text-transform: capitalize;}
.join-event-option .social-icons-2{ overflow: hidden; padding: 40px 0;}
.join-event-option .social-icons-2 ul li a{ color: #ccc; font-size: 25px;}

.related-events-holder{ border-radius: 4px;}
.related-events-heading{ padding: 30px 20px; background: #ebebeb;}
.related-events-heading h4{ margin: 0;}

.related-events-body{ padding: 30px 20px 40px; overflow: hidden;}
.related-event{ position: relative; padding: 0 0 0 100px; min-height: 80px;}
.related-event img{ position: absolute; left: 0;}
.related-event h5{ margin: 0 0 10px; font-size: 14px; text-transform: capitalize; line-height: 20px;}
.related-event .date{ margin: 0; font-size: 12px;}

.aside-widet{ overflow: hidden; margin: 0 0 60px;}
.aside-widet h4{ position: relative; margin: 0 0 30px; display: inline-block; padding: 0 10px 0 0;}
.aside-widet h4::before{ content: ":::"; position: absolute; left: 100%;}

.aside-search .form-control{ height: 50px; line-height: 50px; background: #ebebeb; padding: 0 15px;}
.aside-search .form-control:focus{ background: #fff;}

.categories-list > li{ margin: 0 0 10px;}
.categories-list > li:last-child{ margin: 0;}
.categories-list > li h5{ margin: 0; border-left: 3px solid; padding: 20px; background: #ebebeb; text-transform: capitalize;}
.categories-list > li h5 span{ color: #ccc;}
.categories-list > li.active ul{ display: block;}
.categories-list > li ul{ padding: 10px 0; display: none;}
.categories-list > li ul li a{ padding: 10px 20px; color: #959595; font-size: 16px;}
/****** Event Detail ***********************************************************
*********************************************************** Event Detail ******/

/****** Event Grid ***********************************************************
*********************************************************** Event Grid ******/
.event-grid .main-heading{ padding: 0;}
/****** Event Grid ***********************************************************
*********************************************************** Event Grid ******/

/****** Event List ***********************************************************
*********************************************************** Event List ******/
.event-List-holder{ padding: 60px 0 120px;}
.inner-page-heading .main-heading{ padding: 0;}
.inner-page-heading .main-heading h2{ margin: 0 0 30px;}

.event-List-widget{ margin: 0 0 30px; border-radius: 4px;}
.event-List-widget .event-detail{  background: #fff; padding: 39px 30px; min-height: 281px;}
.event-List-widget .event-detail ul{ visibility: visible; opacity: 1; margin: 0 0 40px;}
.event-list-img img{ width: 100%;}
/****** Event List ***********************************************************
*********************************************************** Event List ******/

/****** Course Detail ***********************************************************
*********************************************************** Course Detail ******/
.course-detail-holder{ padding: 80px 0 120px;}
.Price-Figure-deatil.style-2 ul li{ margin: 0 0 20px;}
.Price-Figure-deatil.style-2 ul li span{ display: block; margin: 0 0 5px;}
.Price-Figure-deatil.style-2 ul li span:last-child{ font-weight: 500;}

.download-course{ padding-left: 20px;}
.download-course li:first-child{ font-weight: 600; padding: 0;}
.download-course li:first-child i{ margin: 0 10px 0 0;}
.download-course li:first-child::before{ display: none;}
.download-course li{ margin: 0 0 10px; position: relative; padding-left: 10px;}
.download-course li::before{ color: #636363; content: "\f111"; position: absolute; left: 0; top: 50%; margin: -3px 0 0;
font-family: fontawesome; font-size: 5px;}
.download-course li a{ color: #636363;}

.event-column.style-2 h4{ font-weight: 300; font-size: 24px;}
.event-column.style-2 .event-detail ul li{ font-size: 14px;}

.browse-by-teacher li{ margin: 0 0 30px;}
.aurthor-name.style-3{ min-height: 80px; padding-left: 100px; margin: 0;}
.aurthor-name.style-3 h5{ margin: 0 0 10px; font-weight: 600; font-size: 18px; text-transform: capitalize;
padding: 10px 0 0;}
/****** Course Detail ***********************************************************
*********************************************************** Course Detail ******/

/****** Course List ***********************************************************
*********************************************************** Course List ******/
.course-List-widget{ margin: 0 0 30px; border-radius: 4px;}
.course-List-widget .course-detail{  background: #fff; padding: 39px 30px; min-height: 281px;}
.course-List-widget .course-detail ul{ visibility: visible; opacity: 1; margin: 0 0 40px;}
.course-list-img img{ width: 100%;}
.course-List-widget .course-detail .date{ margin: 0 0 10px;}
.course-List-widget .course-detail h4{ margin: 0 0 20px; font-weight: 300; font-size: 30px; text-transform: capitalize;}
.course-List-widget .course-detail p{ margin: 0 0 20px; line-height: 30px; font-size: 16px; font-weight: 300; color: #959595;}
/****** Course List ***********************************************************
*********************************************************** Course List ******/

/****** Course Grid ***********************************************************
*********************************************************** Course Grid ******/
.courses-grid .course-column{ margin: 0 0 30px;}
/****** Course Grid ***********************************************************
*********************************************************** Course Grid ******/

/****** Contact Us ***********************************************************
*********************************************************** Contact Us ******/
.contact-inner{ margin: -80px 0 0; position: relative; z-index: 1;}
/****** Contact Us ***********************************************************
*********************************************************** Contact Us ******/

/****** Our Teachers ***********************************************************
*********************************************************** Our Teachers ******/
.team-grid .team-column{ margin: 0 0 60px;}
.team-filter{ margin: 0;}
.team-filter ul li a{ padding: 0 5px; text-transform: capitalize; color: rgba(255,255,255,0.7);}
.team-filter ul li a.selected{ border-color: #fff!important; color: #fff!important;}
.team-filter ul li{ position: relative;}
.team-filter ul li::before{ content: "|"; position: absolute; left: 100%; margin: 0 0 0 8px; top: 3px;}
.team-filter ul li:last-child::before{ display: none;}
.team-grid.style-2 .team-column{ margin: 0 0 30px;}
/****** Our Teachers ***********************************************************
*********************************************************** Our Teachers ******/

/****** Gallery ***********************************************************
*********************************************************** Gallery ******/
.inner-page-heading .filter-tags-holder{ margin: 0;}
/****** Gallery ***********************************************************
*********************************************************** Gallery ******/

/****** BLog Mesonary ***********************************************************
*********************************************************** BLog Mesonary ******/
.video-post iframe{ height: 200px;}
.audio-post iframe{ height: 170px;}
.simple-masonry-grid{ margin: 0 0 30px;}
.video-btach{ background: #ffc107!important;}
.music-btach{ background: #03a9f4!important;}
.simple-masonry-grid .blog-detail h4{ font-size: 20px; font-weight: 300; text-transform: capitalize;
margin: 0 0 30px;}
/****** BLog Mesonary ***********************************************************
*********************************************************** BLog Mesonary ******/

/****** About Us ***********************************************************
*********************************************************** About Us ******/
.timeline-tabs{ overflow: hidden; padding: 0 0 50px;}
.timeline-tabs ul{ position: relative; overflow: hidden; padding: 5px; margin: -5px;}
.timeline-tabs ul::before,
.timeline-tabs ul::after{ content: ""; z-index: -1; position: absolute; left: 0; width: 100%; top: 50%;}
.timeline-tabs ul::before{ border-bottom: 1px solid #dcdcdc;}
.timeline-tabs ul::after{ border-top: 1px solid #fff; top: 51%;}
.timeline-tabs ul li:first-child{ margin: 0;}
.timeline-tabs ul li{ float: left; margin: 0 0 0 17.3%;}
.timeline-tabs ul li a{ height: 70px; width: 70px; border-radius: 100%; background: #fff; line-height: 70px; text-align: center;
font-size: 18px; font-weight: 500;}
.timeline-text{ padding: 30px 0 0;}
.timeline-text h4{ margin: 0 0 30px;}
.timeline-text h4 i{ margin: 0 10px 0 0;}
.timeline-text p{ line-height: 30px;}
.timeline-tabs ul li.active a{ color: #fff;}

.why-Chose-us .main-heading h2{ margin: 0 0 40px;}
.client-logo.style-2{ background: #f5f5f5;}
/****** About Us ***********************************************************
*********************************************************** About Us ******/

/****** Products Grid ***********************************************************
*********************************************************** Products Grid ******/
.product-grid{ padding: 60px 0 120px;}
.product-grid .product-column{ margin: 0 0 30px;}
.product-column{ position: relative; min-height: 355px; overflow: hidden;}
.product-column:hover .product-detail{ height: 150px;}
.product-column:hover .add-cart-option{ opacity: 1; visibility: visible;}
.product-column:hover img{ transform: scale(1.1);}
.product-detail{ background: #fff; overflow: hidden; padding: 20px; position: absolute; bottom: 0; height: 100px;}
.product-detail h5{ margin: 0; float: left; font-size: 20px; font-weight: 300; text-transform: capitalize;}
.product-detail h5 i{ display: block; font-size: 14px; color: #959595; margin: 10px 0 0;}
.product-detail .rating-stars{ float: right;}
.product-detail .rating-stars li{ margin: 0 0 0 1px;}
.product-detail .rating-stars li i{ font-size: 10px;}
.add-cart-option{ float: left; width: 100%; padding-top: 30px; opacity: 0; visibility: hidden;}
.add-cart-option li:first-child{ margin: 0;}
.add-cart-option li{ float: left; margin: 0 0 0 20px;}
.add-cart-option li a{ font-size: 20px; color: #ccc;}
.product-img{ position: relative;}
.sale-batch,
.new-batch{ position: absolute; right: 20px; top: 20px; font-size: 12px; text-transform: uppercase;}
.new-batch{ background: #4caf50!important;}

.product-filter{ padding: 0 0 30px; overflow: hidden;}
.change-view-option ul li{ float: left; margin: 0 0 0 20px; color: #959595;}
.change-view-option ul li a{ color: #959595;}
.change-view-option ul li:first-child{ margin: 0;}
.by-sort-option{ float: right;}
.by-sort-option ul li{ float: left; margin: 0 0 0 40px; color: #959595;}
.by-sort-option ul li:first-child{ margin: 0;}
.by-sort-option ul li .form-group{ margin: 0;}
.by-sort-option ul li .form-control{ border: 0!important; height: 20px; line-height: 20px;
padding: 0 10px 0 0; width: 140px; color: #959595;}

.pricing-slider #slider-range{ margin: 0 0 30px; height: 3px; background: #ccc; border: 0;}
.pricing-slider .ui-slider-handle{ height: 12px; width: 12px; border-radius: 100%;}
.pricing-slider p{ margin: 0;}
.pricing-slider p input{ color: #636363; width: 40%; padding: 0; line-height: 45px; height: 45px; float: left;}
/****** Products Grid ***********************************************************
*********************************************************** Products Grid ******/

/****** Product Detail ***********************************************************
*********************************************************** Product Detail ******/
.product-detail-holder{ padding: 60px 0;}

.s-product-detail{ margin: 0 0 60px;}
.inner-page-heading.style-2.style-3 .main-heading{ margin: 0 0 0 -210px; bottom: 28px;}
.product-slider-view{ margin: -170px 0 0;}
.product-Detail{ padding: 60px 120px;}
.product-slider-holder{ margin: 0 0 30px;}
.product-slider .owl-dots{ margin: 40px 0 0;}
.product-slider .item img{ width: 100%;}
.product-slider .owl-stage-outer{ margin: 0; padding: 0;
box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);}

.product-view-option{ text-align: center;}
.product-view-option ul{ display: inline-block;}
.product-view-option ul li:first-child{ margin: 0;}
.product-view-option ul li{ float: left; margin: 0 0 0 30px;}
.product-view-option ul li a{ color: #959595; text-transform: uppercase; font-size: 12px;}
.product-view-option ul li a i{ margin: 0 10px 0 0;}

.s-price{ padding: 0 0 30px; overflow: hidden;}
.s-price span{ float: left; font-size: 30px; color: #252525;}
.s-price .rating-stars{ float: right; margin: 15px 0 0;}
.s-price .rating-stars li i{ font-size: 20px;}

.s-price-detail p{ border-bottom: 1px solid #ccc; padding: 0 0 40px; margin: 0;}
.product-disc{ border-top: 1px solid #fff; overflow: hidden; padding: 40px 0 0;}
.product-disc li{ float: left; margin: 0 0 0 50px;}
.product-disc li:first-child{ margin: 0;}
.product-disc li a{ font-size: 16px; color: #636363;}
.product-disc li a i{ margin: 0 10px 0 0;}

.chose-product{ padding: 30px 0; overflow: hidden;}
.chose-product ul li{ width: 31%; float: left; margin: 0 0 0 14px;}
.chose-product ul li:first-child{ margin: 0;}
.chose-product select{ height: 40px; line-height: 40px; border: 1px solid #ccc; border-radius: 4px; padding: 0 20px; color: #959595;}

.product-description{ background: #fff; padding: 50px 30px; border-radius: 4px; margin: 0 0 30px;}
.product-description h3{ font-size: 30px; margin: 0 0 30px; text-transform: capitalize;}
.product-description p{ color: #636363; font-weight: 300; margin: 0 0 30px; line-height: 30px;}
.product-description p:last-child{ margin: 0;}

.reviews-holder{ padding: 50px 30px; background: #fff;}
.reviews-holder h3{ font-size: 30px; text-transform: capitalize;}
.comments-holder > ul > li{ position: relative; overflow: hidden; border-bottom: 1px solid #e5e5e5; padding: 0 0 30px; margin: 0 0 30px;}
.comments-holder > ul > li > img{ position: absolute; left: 0; top: 0; border-radius: 100%;}
.comment{ padding: 0 0 0 100px;}
.comment h6{ margin: 0 0 20px;}
.comment p{ margin: 0 0 20px;}

.comments-holder{ margin: 0 0 60px;}

.leave-comment h3{ margin: 0 0 30px; font-size: 30px; text-transform: capitalize;}
.custom-rating{ overflow: hidden; padding: 0 0 40px;}
.connect-with li{ float: left; margin: 0 0 0 20px;}
.connect-with li a{ color: #959595;}
.connect-with li:first-child{ margin: 0;}

.custom-rating .rating-stars{ float: right;}
.custom-rating .rating-stars li a{ font-size: 20px; color: #ccc;}
.custom-rating .rating-stars li a:hover{ color: #f0bf2d;}

.leave-comment .btn{ margin: 60px 0 0;}
/****** Product Detail ***********************************************************
*********************************************************** Product Detail ******/

/****** Teacher Detail ***********************************************************
*********************************************************** Teacher Detail ******/
.s-teacher-column{ margin: -170px 0 0;}
.s-teacher-detail{ padding: 30px 20px; background: #fff;}
.s-teacher-detail ul li{ margin: 0 0 10px;}
.s-teacher-detail ul li:first-child{ margin: 0;}
.s-teacher-detail ul li i{ margin: 0 10px 0 0; color: #959595;}
.teacher-subject h4{ font-weight: normal; margin: 0 0 30px;}
.teacher-subject h4 i{ margin: 0 10px 0 0;}
.teacher-subject p:last-child{ margin: 0;}

.t-table-widget{ margin: 0 0 60px;}
.t-table-widget table{ margin: 0;}
.t-table-widget:last-child{ margin: 0;}
.t-table-widget h3{ font-size: 30px;}
.t-table-widget thead tr th{ padding: 25px 20px; color: #fff; font-size: 18px;}
.t-table-widget tbody tr th,
.t-table-widget tbody tr td{ font-weight: 300; font-size: 16px; padding: 15px 20px; color: #959595;}
.t-table-widget tbody tr{ background: #fff;}
.t-table-widget tbody tr:nth-child(even){ background: #f5f5f5;}
/****** Teacher Detail ***********************************************************
*********************************************************** Teacher Detail ******/

/****** Learn Dash Course ***********************************************************
*********************************************************** Learn Dash Course ******/
.learn-dash-course{ padding: 60px 0 120px;}
.course-description{ margin: 0 0 80px;}
.course-description img{ margin: 0 0 30px;}
.course-description ul{ padding: 0 0 20px; margin: 0 0 20px; overflow: hidden; border-bottom: 1px solid #dcdcdc;}
.course-description ul li{ float: left; font-style: italic; color: #959595; font-size: 16px;}
.course-description ul li::before{ content: "|"; margin: 0 10px;}
.course-description ul li:first-child::before{ display: none;}
.course-description p{ margin: 0 0 30px;}

.t-table-widget.style-2 table{ margin: 0 0 30px;}
.t-table-widget.style-2 table:last-child{ margin: 0;}
.t-table-widget.style-2 thead tr th{ background: #959595;}
.t-table-widget.style-2 thead tr th:first-child{ text-align: left;}
.t-table-widget.style-2 thead tr th{ text-align: right;}
.t-table-widget.style-2 tbody tr td{ text-align: right;}

.teacher-quote .social-icons-2{ padding: 0 0 30px; border-bottom: 1px solid #dcdcdc;}
.teacher-quote .social-icons-2 ul li a{ color: #ccc;}

.aurthor-quote{ position: relative; padding: 30px 0 0; border-top: 1px solid #fff;}
.aurthor-detail{ padding: 0 0 0 150px;}
.aurthor-quote img{ position: absolute; left: 0; border-radius: 100%; overflow: hidden;}
.aurthor-quote h4{ font-weight: 300; margin: 0 0 10px; font-size: 24px; text-transform: capitalize;}
.aurthor-quote i{ font-size: 16px; display: block; margin: 0 0 25px;}
.aurthor-quote p{ font-size: 14px; margin: 0; color: #959595;}
/****** Learn Dash Course ***********************************************************
*********************************************************** Learn Dash Course ******/

/****** Project Category ***********************************************************
*********************************************************** Project Category ******/
.project-category-holder .filter-tags-holder{ margin: 0;}
.project-column{ position: relative; overflow: hidden; margin: 0 0 30px;}
.project-column .project-detail{ padding: 20px 30px; background: #fff; position: absolute; bottom: 0; bottom: -65px;}
.project-column .project-detail h3,
.project-column .project-detail h5{ text-transform: capitalize; margin: 0 0 20px;}
.project-column .project-detail h3 span,
.project-column .project-detail h5 span{ display: block; font-size: 14px; font-style: italic; color: #959595; margin: 5px 0 0;}
.project-column .project-detail p{ margin: 0; color: #959595; visibility: hidden; opacity: 0;}
.project-column:hover .project-detail{ bottom: 0;}
.project-column:hover .project-detail p{ visibility: visible; opacity: 1;}
.project-column:hover > img{ margin: -30px 0 30px;
-webkit-filter: blur(2px);
-moz-filter: blur(2px);
-o-filter: blur(2px);
-ms-filter: blur(2px);
filter: blur(2px);}
.project-column.small p{ font-size: 14px;}
.project-aurthor{ position: absolute; right: 20px; top: 20px; z-index: 2;}
.project-aurthor li{ float: left; margin: 0 0 0 10px;}
.project-aurthor li img{ border-radius: 100%; overflow: hidden;}
.project-aurthor li:first-child{ margin: 0;}
/****** Project Category ***********************************************************
*********************************************************** Project Category ******/

/****** Project Detail ***********************************************************
*********************************************************** Project Detail ******/
.related-projects h2{ text-transform: capitalize; font-weight: 300;}
.related-projects .project-column{ margin: 0;}
.related-projects-slider .owl-nav{ top: -60px;}

.aurthor-wigdet{ padding: 30px 20px; background: #fff;}
.aurthor-wigdet .browse-by-teacher{ margin: 0 0 20px;}
.aurthor-wigdet .aurthor-name{ min-height: 50px; padding-left: 70px;}
.aurthor-wigdet .aurthor-name h5{ font-size: 16px; font-weight: 500; margin: 0 0 5px; padding: 0;}
.aurthor-wigdet .browse-by-teacher li:last-child{ margin: 0;}

.aurthor-wigdet .detail-list{ margin: 0 0 20px;}
.aurthor-wigdet .detail-list li{ margin: 0 0 20px; text-transform: uppercase;}
.aurthor-wigdet .detail-list li:last-child{ margin: 0;}
.aurthor-wigdet .detail-list li span{ display: block; font-weight: 500; color: #252525; text-transform: capitalize;}
.aurthor-wigdet .social-icons-2{ margin: 0 0 20px;}
.aurthor-wigdet .social-icons-2 ul li a{ color: #ccc;}
/****** Project Detail ***********************************************************
*********************************************************** Project Detail ******/

/****** BodyPass ***********************************************************
*********************************************************** BodyPass ******/
.latest-post ul li{ margin: 0 0 20px;}
.latest-post ul li:last-child{ margin: 0;}

.sort-option{ overflow: hidden; margin: 0 0 30px;}
.sort-filter{ float: left;}
.sort-filter span{ font-size: 16px; margin: 0 10px 0 0; font-weight: 500; color: #252525;}
.sort-filter select{ height: 40px; line-height: 40px; padding: 0 20px; min-width: 170px; border: 1px solid #ccc; background: none;}
.sort-option > span{ float: right; font-size: 16px; color: #959595; line-height: 40px;}

.bodypass-list .comments-holder{ padding: 60px 30px; background: #fff;}
.bodypass-list .comments-holder ul li{ min-height: 100px; overflow: hidden;}
.bodypass-list .comments-holder ul li:last-child{ margin: 0; border-bottom: 0;}
.bodypass-list .comments-holder ul li h5{ margin: 0 0 10px; text-transform: capitalize; font-size: 16px;}
.bodypass-list .comments-holder ul li h5 span{ font-size: 14px; color: #ccc; margin: 0 0 0 10px;}
.bodypass-list .comments-holder ul li p{ font-weight: 300;}
.bodypass-list .comments-holder ul li .read-more{ text-transform: uppercase; font-size: 12px; font-weight: 500;}
.bodypass-list .comments-holder ul li iframe{ height: 396px;}
.bodypass-list .btn{ background: #f5f5f5; color: #959595;}
/****** BodyPass ***********************************************************
*********************************************************** BodyPass ******/

/****** Pricing ***********************************************************
*********************************************************** Pricing ******/
.pricing-columns{ margin: -80px 0 80px;}
.pricing-column{ text-align: center; background: #fff; padding: 60px 0 40px;}
.pricing-column .pricing-icon{ margin: 0 0 30px; display: inline-block;}
.pricing-column h2{ font-size: 30px; text-transform: capitalize; font-weight: 300;}
.pricing-column h2 span{ display: block; font-size: 14px; color: #959595; margin: 10px 0 0;}
.pricing-column ul li{ padding: 20px 30px; overflow: hidden; border-top: 1px solid rgba(0,0,0,0.1);}
.pricing-column ul li:last-child{ border-bottom: 1px solid rgba(0,0,0,0.1);}
.pricing-column ul li span:first-child { float: left; font-size: 24px; font-weight: 300; color: #252525;}
.pricing-column ul li span:last-child{ float: right; font-size: 16px; font-style: italic; font-weight: 300; color: #636363; line-height: 35px;}
.pricing-column > .btn{ margin: 30px 30px 0;}

.address-column{ margin: 0 0 80px;}
.find-us-map{ height: 300px;}
.find-us .main-heading-holder{ background: #fff; padding: 40px 0;}
.find-us .main-heading{ padding: 0;}
/****** Pricing ***********************************************************
*********************************************************** Pricing ******/

/****** Standard Blog ***********************************************************
*********************************************************** Standard Blog ******/
.standar-blog-list .blog-column{ margin: 0 0 40px;}
.standar-blog-list .blog-column blockquote{ font-size: 30px; color: #252525; font-style: italic; font-weight: 300;}
.standar-blog-list .video-post iframe{ height: 480px;}
.blog-column.blockquote{ overflow: visible; margin: 50px 0 40px;}
.a-name{ margin: 0 0 30px; display: block; font-size: 16px; color: #959595; font-weight: 300;}
.standar-blog-list .audio-post iframe{ height: 300px;}
.standar-blog-list .blog-column h2{ font-weight: 300; text-transform: capitalize;}

.aside-calender .ui-widget-content{ padding: 0; border: 0;}
.aside-calender .ui-datepicker-header{ padding: 10px 15px; border-radius: 0; color: #fff; border: 0;}
.aside-calender .ui-datepicker-prev .ui-icon::before,
.aside-calender .ui-datepicker-next .ui-icon::before{ font-family: fontawesome;}
.aside-calender .ui-datepicker-prev .ui-icon::before{ content: "\f104"}
.aside-calender .ui-datepicker-next .ui-icon::before{ content: "\f105"}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{ background: none; border: 0;}
.ui-datepicker td span, .ui-datepicker td a{ padding: 10px 8px; color: #959595!important;}
.ui-state-default.ui-state-active{ border-radius: 4px; color: #fff!important;}
.ui-datepicker-calendar thead{ background: #f5f5f5;}
.look-visible{ overflow: visible;}
.ui-datepicker,
.ui-datepicker-calendar{ width: 100%;}

.tweet{ padding: 20px; background: #44ccff; position: relative;}
.tweet::before{ content: "\f099"; font-family: fontawesome; position: absolute; top: 5px; right: 15px; font-size: 50px; color: rgba(255,255,255,0.4);}
.tweet h5{ font-size: 16px; color: rgba(255,255,255,0.8);}
.tweet p{ color: #fff;}
.tweet p a{ color: #fff;}
.tweet ul{ overflow: hidden;}
.tweet ul li{ float: left; margin: 0 0 0 20px; color: #fff;}
.tweet ul li:first-child{ margin: 0;}
.tweet ul li i{ margin: 0 10px 0 0;}

.aside-tags-list{ margin: 0 0 0 -10px; overflow: hidden;}
.aside-tags-list li{ float: left; margin: 0 0 10px 10px;}
.aside-tags-list li a{ padding: 0 15px; height: 30px; line-height: 30px; border: 1px solid #ccc;
border-radius: 3px; color: #959595; font-size: 13px;}
.aside-tags-list li a:hover{ color: #fff;}
/****** Standard Blog ***********************************************************
*********************************************************** Standard Blog ******/

/****** Blog Detail ***********************************************************
*********************************************************** Blog Detail ******/
.p-detail blockquote{ padding: 0 0 0 20px; margin-left: 40px;border-left: 2px solid; font-size: 16px; font-style: italic;}
.single-blog-detail .social-icons-2{ margin: 0 0 30px;}
.single-blog-detail .social-icons-2 ul li a{ color: #ccc;}
.single-blog-detail .blog-detail-btm{ overflow: hidden;}
.single-blog-detail .blog-detail-btm .aside-tags-list{ float: left;}
.single-blog-detail .blog-detail-btm .aside-tags-list li:first-child{ line-height: 30px; color: #959595;}
.single-blog-detail .blog-detail-btm .aside-tags-list li:first-child i{ font-size: 16px; margin: 0 10px 0 0;}

.single-blog-detail .blog-column{ margin: 0 0 30px;}
.single-blog-detail .aurthor-quote-blog{ background: #005D9B; padding: 30px; margin: 0 0 30px;}
.single-blog-detail .aurthor-quote{ border: 0; padding: 0;}
.aurthor-quote-blog .aurthor-detail h4 a,
.aurthor-quote-blog .aurthor-detail p,
.aurthor-quote-blog .aurthor-detail i{ color: #fff;}

.replay-btn{ font-size: 12px; text-transform: uppercase;}
.replay-btn i{ margin: 0 5px 0 0;}
.sub-comment{ margin-left: 50px!important;}

.main-meta li{ float: left; font-size: 18px; color: #fff; margin: 0 0 0 30px; font-style: italic;}
.main-meta li:first-child{ margin: 0;}
.main-meta li i{ margin: 0 10px 0 0;}
/****** Blog Detail ***********************************************************
*********************************************************** Blog Detail ******/

/****** FAQ ***********************************************************
*********************************************************** FAQ ******/
.faq-search{ margin: -35px 0 0;}
.faq-search .search-bar{ position: relative;}
.faq-search .search-bar input{ width: 100%; height: 70px; line-height: 70px; font-size: 18px; background: #fff; padding: 0 30px; font-style: italic;}
.faq-search .search-bar button{ position: absolute; right: 20px; top: 25px; font-size: 20px; background: none; border: 0;}


.help-tips h5,
.faqs-area h5{ font-size: 18px; margin: 0 0 30px; text-transform: uppercase; font-weight: 400;}
.help-tips h5 i,
.faqs-area h5 i{ margin: 0 10px 0 0;}

.help-tips ul li{ margin: 0 0 18px;}
.help-tips ul li:last-child{ margin: 0;}
.help-tips ul li a{ font-size: 16px; color: #636363;}

.faqs-area .panel{ margin: 0 0 20px;}
.faqs-area .panel p{ color: #959595; margin: 0;}
.faqs-area li h4{ cursor: pointer;font-size: 16px;line-height: 1.5;
margin: 0;padding: 15px 10px 15px 25px;position: relative;text-transform: capitalize; font-weight: 500;}
.faqs-area li h4::after,
.faqs-area li h4::before{ color: #252525; content: "-";font-size: 20px; height: 100%; margin-top: -15px; opacity: 0;position: absolute;
right: 0;text-align: center;top: 50%;width: 50px;}
.faqs-area li h4::before{content: "+"; opacity: 1;}
.faqs-area [aria-expanded="true"] h4::before{opacity: 0;}
.faqs-area [aria-expanded="true"] h4::after{opacity: 1;}
.faqs-area [aria-expanded="true"] h4 {border-color: transparent;}
.faqs-dsc{border-top: 0;padding: 20px;}
.faqs-area .panel-group { margin: 0; }
/****** FAQ ***********************************************************
*********************************************************** FAQ ******/
/***** style added by Sonali *******/
.teacher-subject{
	 line-height: 0.5;
    margin-top: -40px;
}
.modal-open .modal,.reset-password{
 background-image: url(../images/bg22.jpg) !important;
}
#container{
 margin: 10px 0 !important;
}
#col1 > div:first-child{
	 margin-top: 40px !important;
	 background:#ffffff none repeat scroll 0 0 !important;
}
.optionOverCss{
	background: #4b4b40!important;
	border-left: 5px solid #ffffff !important;
	padding:8px;
	border:none;border-radius:0px; -moz-border-radius:0px;
	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
}
.optionOutCss{
	border-left: 5px solid #4caf50 !important;
}

.countdown-one span {
    font-size: 19px !important;
    height: 30px;
    padding: 2px !important;
}
.pagination-holder{
 background: #4b4b40 none repeat scroll 0 0;
    border-radius: 4px;
    margin: 1px;
    padding: 10px 0 12px 12px;
}
#info-exam{
	color: #ffffff;
}
.caret-up {
    width: 0;
    height: 0;
    border-left: 4px solid rgba(0, 0, 0, 0);
    border-right: 4px solid rgba(0, 0, 0, 0);
    border-bottom: 4px solid;
    display: inline-block;
    margin-left: 2px;
    vertical-align: middle;
}
.dropdown-menu {
    border-color: -moz-use-text-color;
    border-radius: 0 !important;
    border-style: solid none none;
    border-top: 5px solid;

}
#exam-finish-holder th{
    font-weight: bold !important;
    letter-spacing: 0.4px;
}
#exam-finish-holder td{
	 font-weight: bold !important;
	 color: #252525 !important;
}
#exam-finish-holder tr{
 background: #ffffff!important;
}
.total-marks th{
  color: #252525 !important;
}
.total-marks{
border-top:solid;
}
#exam-finish-holder{
	 margin: 60px 0;
	  padding:40px;
	 background-image: url(../images/promo.png) !important;
}
.btn-file i{
	 margin-left: 4px;
    margin-top: 5px;
}
.file-default-preview img {
    height: 185px !important;
    margin-top: -2px !important;
    width: 175px !important;
}
.edit .btn{
	 padding-left: 0;
    padding-right: 9px;
}
#prvQBtn{
background: #4B4B40;
width: 125px !important;
}	
#nextQBtn{
background: #ffa500 none repeat scroll 0 0;
width: 125px !important;
}
#submitBtn{
background:	#4caf50 ;
width: 125px !important;
}
#finishQBtn{
	background:	#DC143C !important;
width: 125px !important;
}
.user-img img{
height: 29px;
width: 30px;
display: inline-block;
}
.user-img span{
	color: #ebebeb;
text-transform: capitalize;
}
.exam-details{
	 border-top: 1px solid #fff;
    border-bottom: 1px solid #dcdcdc;
    padding: 40px 0 40px;
}
section.main {
   border-radius: 3px;
    overflow: hidden;
}
section.main > .title-top {
  color: #fff;
  background: #005D9B;
  text-align: center;
  font-weight: 700;
 padding: 10px;
}
section > #quiz-details {
  border-bottom: 1px solid #ccc;
}
section > #quiz-details:last-child {
  border: none;
}
section > #quiz-section {
  height: 0;
  overflow: hidden;
  transition: all .2s ease-in;
}
#quiz-details button {
  position: absolute;
  right: 0;
  margin: 0;
  padding: 0;
  height: 3em;
  width: 3em;
  outline: 0;
  border: 0;
  background: none;
  text-indent: -9999%;
  pointer-events: none;
}
#quiz-details button:after, #quiz-details button:before {
  content: '';
  display: block;
  position: absolute;
  height: 12px;
  width: 4px;
  border-radius: .3em;
  background: #005D9B;
  transform-origin: 50%;
  top: 50%;
 
  transition: all .3s ease-in-out;
}
#quiz-details button:after {
  transform: translate(-75%, -50%) rotate(-45deg);
}
#quiz-details button:before {
  transform: translate(75%, -50%) rotate(45deg);
}
#quiz-details.open button:after, #quiz-details.open button:before {
  height: 14px;
  background:#848484 ;
}
#quiz-details.open button:after {
  transform: translate(0%, -50%) rotate(45deg);
}
#quiz-details.open button:before {
  transform: translate(0%, -50%) rotate(-45deg);
}
#quiz-details.open header {
  color: #555;
}

article,
.title-exam {
  padding: 1em;
  line-height: 1em;
}

.title-exam:not(.title) {
  background: white none repeat scroll 0 0;
    color: #888;
    cursor: pointer;
    font-weight: 700;
}

article {
  line-height: 1.4em;
  font-size: .9em;
  background: rgba(255, 255, 255, 0.7);
}
article img {
  width: 100%;
  height: auto;
  border: 5px solid white;
  border-radius: 3px;
}
article.special h3 {
  margin: .35em 0 0 0;
  color: #239023;
  text-align: center;
}
.login-form-password{
	 background: #fff none repeat scroll 0 0;
    height: 450px;
    margin: 70px 0;
    padding: 10px 25px 0;
    width: 100%;
}