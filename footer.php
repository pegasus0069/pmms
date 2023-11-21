<!-- Footer starts here -->
<footer class="page-footer font-small text-light" style="background: linear-gradient(to left bottom, #2d78e2, #111 60%); box-shadow: 0px 0px 10px 4px #000;">

  <div style="background: linear-gradient(to left, #2d78e2 , #111 70%); box-shadow: 0px 0px 4px 1px #000;">
    <div class="container">

      <!-- Grid row-->
      <div class="row py-1 d-flex align-items-center">

      <!-- Grid column -->
      
      <!-- Grid column -->
      </div>
      <!-- Grid row-->

    </div>
  </div>

  <!-- Footer Links -->
  <div class="container text-center text-md-left mt-5">
    <!-- Grid row -->
    <div class="row mt-1">
      <!-- Grid column -->
      <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-1">
        <!-- Content -->
        <h6 class="text-uppercase font-weight-bold" id="contact">Process Portal</h6>
        <hr class="deep-purple accent-2 mb-3 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          Dept. of CSE, IUB
        </p>
        <p>
          <i class="fa fa-envelope mr-2">arnoyk123sets@iub.edu.bd</i>
        </p>
        <p>
          <i class="fa fa-phone mr-2">+ 880 171 791 6061</i>
        </p>
      </div>
      <!-- Grid column -->

      <!-- Grid column -->

      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-1">
        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Suggestions</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <div id="suggestionAlert"></div>
        <form id="suggestionForm" onsubmit="suggestions()">
          <div class="form-group">
            <label for="suggestionFormTextarea">Your Valuable Suggestion</label>
            <textarea class="form-control" id="suggestionText" rows="3"></textarea>
          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="suggestionCheck">
            <label class="form-check-label" for="suggestionCheck">Check to Submit</label>
          </div>
          <button type="submit" class="btn" style="background: rgb(255, 255, 255); color: #eb0000; font-weight: bolder;">Submit</button>
        </form>
      </div>
      <!-- Grid column -->
    </div>
    <!-- Grid row -->	
  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3" id="footer-copyright">&copy; <script>document.getElementById('footer-copyright').innerHTML += new Date().getFullYear();</script> Copyright | 
    <a class="text" href="/" style="color: #8e2de2;"> Process Portal</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer ends here -->

<?php include_once('./scripts.php');?>