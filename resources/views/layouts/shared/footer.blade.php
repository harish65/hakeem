<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                @if(config('client_data') && config('client_data')->domain_name=="medex")
                    Copyright © <script>document.write(new Date().getFullYear())</script> Human-Ly Technologies Private Limited. All rights reserved.
                @else
                    <script>document.write(new Date().getFullYear())</script> &copy; {{ (config('client_data'))?config('client_data')->name:'Consultant'}} APP Powered by <a href="">{{ (config('client_data'))?config('client_data')->name:'Codebrewinnovation'}}</a>
                @endif 
            </div>
            <div class="col-md-6">
                <div class="text-md-right footer-links d-none d-sm-block">
                    <a href="javascript:void(0);">About Us</a>
                    <a href="javascript:void(0);">Help</a>
                    <a href="javascript:void(0);">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->