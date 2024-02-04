<meta charset="utf-8" />
<title>{{$title ?? ''}}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
<meta content="Coderthemes" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!-- App favicon -->
@if(config('client_connected'))
@php $image_name = Config::get("client_data")->domain_name; 
@endphp
<link rel="shortcut icon" href="{{ asset('assets/images/'.$image_name.'.ico')?asset('assets/images/'.$image_name.'.ico'):asset('assets/images/favicon.ico')}}">
@endif
