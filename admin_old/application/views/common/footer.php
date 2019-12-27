<!-- Footer Start -->

<?php

     $ci= &get_instance();

     $system_title =$ci->modelbasic->getValue('settings','description',array('type'=>'system_title'));



     //echo $resultfooter;die;

  ?>

  <footer class="footer-2 "  id="footer">

    <div class="vd_bottom themeColorfooter ">

        <div class="container">

            <div class="row">

              <div class=" col-xs-12">

                <div class="copyright text-center">

                    Copyright &copy;2016 <?php echo $system_title; ?>. All Rights Reserved

                </div>

              </div>

            </div><!-- row -->

        </div><!-- container -->

    </div>

  </footer>



<!-- Footer END -->