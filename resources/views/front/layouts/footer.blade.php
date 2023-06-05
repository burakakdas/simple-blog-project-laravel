<!-- Footer-->
</div>
</div>
<footer class="border-top">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <ul class="list-inline text-center">
                    @php $socials=['facebook','twitter','instagram','github','youtube','linkedin']; @endphp
                    @foreach($socials as $social)
                        @if($config->$social!=null)
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                    <a target="_blank"   href="{{$config->$social}}" class="fa fa-{{$social}} fa-2x col-xl-1" ></a>
                        @endif
                    @endforeach
                </ul>
                <div class="small text-center text-muted fst-italic">Copyright &copy;  {{date('Y')}} - {{$config->title}} </div>
            </div>
        </div>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src= "/https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{asset('front/')}}/js/scripts.js"></script>
</body>
</html>
