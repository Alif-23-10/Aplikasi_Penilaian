<?php
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<h1>Untuk mengakses halaman, Anda harus login dulu.</h1><p><a href=\"index.php\">LOGIN</a></p>";  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{

?>

               <div class="row">
              <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <div class="error-container">
                  <div class="well">
                    <h1 class="grey lighter smaller">
                      <span class="blue bigger-125">
                        <i class="ace-icon fa fa-sitemap"></i>
                        404
                      </span>
                      Page Not Found
                    </h1>

                    <hr />
                    <h3 class="lighter smaller">The page you requested was not found</h3>

                    <div>
                      
                      <div class="space"></div>
                      <h4 class="smaller">Try one of the following:</h4>

                      <ul class="list-unstyled spaced inline bigger-110 margin-15">
                        <li>
                          <i class="ace-icon fa fa-hand-o-right blue"></i>
                          Re-check the url for typos
                        </li>

                        <li>
                          <i class="ace-icon fa fa-hand-o-right blue"></i>
                          Read the faq
                        </li>

                        <li>
                          <i class="ace-icon fa fa-hand-o-right blue"></i>
                          Tell us about it
                        </li>
                      </ul>
                    </div>

                    <hr />
                    <div class="space"></div>

                    <div class="center">
                      <a href="javascript:history.back()" class="btn btn-grey">
                        <i class="ace-icon fa fa-arrow-left"></i>
                        Go Back
                      </a>

                      <a href="beranda" class="btn btn-primary">
                        <i class="ace-icon fa fa-tachometer"></i>
                        Dashboard
                      </a>
                    </div>
                  </div>
                </div>

                <!-- PAGE CONTENT ENDS -->
              </div><!-- /.col -->
            </div><!-- /.row -->

<?php
  
}
?>
