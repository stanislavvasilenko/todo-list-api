<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="{{ asset('css/app.css') }}">

   <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

   @stack('style')
</head>
<body>
   <div class="container">
      <div class="row">
         <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
               <a class="navbar-brand" href="#">API Project</a>
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('task.index') }}">Tickets</a>
                     </li>

                     <!-- @can('view', auth()->user())
                        <li class="nav-item">
                           <a class="nav-link" href="{{ route('admin.post.index') }}">Admin</a>
                        </li>
                     @endcan -->

                  </ul>
               </div>
            </div>
         </nav>
      </div>
      <div class="row">
         @yield('content')
      </div>
   </div>
   @stack('script')
   <script type="text/javascript">
      $(document).ready(function () {

         setTimeout(function() {
            $('.notification-wrapper').hide();
         }, 5000);
         

         $('.orderable').on('click', function(e) {

            let column = $(this).attr('id');
            let col = $(this).data('col');

            let dir = $(this).data('dir');
            let direction = $(this).data('direction') || 'asc';

            direction = (direction === 'asc') ? 'desc' : 'asc';
            $(this).attr('data-direction', direction);

            let currentUrl = window.location.href;
            let newUrl = addParamUrl(currentUrl, col, column);
            newUrl = addParamUrl(newUrl, dir, direction);

            $.ajax({
               type: "GET",
               url: newUrl,
               success: function(res) {
                  location.reload();
               },
               error: function(err) {
                  console.log(err);
               }
            })

            function addParamUrl(url, key, value) {
               let params = new URLSearchParams(window.location.search);
               params.set(key, value);
               let newUrl = url.split('?')[0] + '?' + params.toString();
               window.history.replaceState({}, '', newUrl);
               return newUrl;
            }
         })
      })
   </script>
</body>
</html>