<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        Copyright &copy; <script>
            document.write(new Date().getFullYear())
        </script> bikroy by <a href="">therssoftware</a>
    </div>
</footer>
<!-- end Footer -->

</div>
<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

</div>
<!-- END wrapper -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>
 
<!--Morris Chart-->

@yield('script')
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>

<!-- iziToast -->
<script src="{{ asset('/vendor/iziToast/js/iziToast.min.js') }}"></script>
<!-- fullcalender -->
<script src="{{asset('/vendor/fullcalendar/main.js')}}"></script>

<!-- js validation -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{ asset('js/jsvalidation.js') }}"></script>
<!-- js validation -->

</body> 
</html>