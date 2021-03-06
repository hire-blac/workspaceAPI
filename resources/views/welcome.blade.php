<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Styles -->
        {{-- CDN --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        {{-- Local --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased justify-center">
      <h2 class="text-center">Workspace API</h2>
      <h4 class="text-center"><a href="/notes" class="btn btn-outline-primary">Link to Notes</a></h4>
        <div class="container">
          
          <table class="table table-bordered border-primary">
            <thead class="staff-auth">Staff Authentication Routes</thead>
            <tr>
              <th>method</th>
              <th class="">description</th>
              <th>api route</th>
            </tr>

            <tr>
              <td>post</td>
              <td class="">Register new <b>STAFF</b> user</td>
              <td><a href="/api/staff/register">https://workspaceapi.herokuapp.com/api/staff/register</a></td>
            </tr> 

            <tr>
              <td>post</td>
              <td class="">Login <b>STAFF</b> user</td>
              <td><a href="/api/staff/register">https://workspaceapi.herokuapp.com/api/staff/login</a></td>
            </tr> 

            <tr>
              <td>post</td>
              <td class="">Logout <b>STAFF</b> user</td>
              <td><a href="/api/staff/register">https://workspaceapi.herokuapp.com/api/staff/logout</a></td>
            </tr> 

          </table>

          <table class="table table-bordered border-primary">
            <thead class="customer-auth">Customer Authentication Routes</thead>

            <tr>
              <td>post</td>
              <td class="">Register new <b>CUSTOMER</b> user</td>
              <td><a href="/api/customer/register">https://workspaceapi.herokuapp.com/api/customer/register</a></td>
            </tr> 

            <tr>
              <td>post</td>
              <td class="">Login <b>CUSTOMER</b> user</td>
              <td><a href="/api/customer/register">https://workspaceapi.herokuapp.com/api/customer/login</a></td>
            </tr> 

            <tr>
              <td>post</td>
              <td class="">Logout <b>CUSTOMER</b> user</td>
              <td><a href="/api/customer/register">https://workspaceapi.herokuapp.com/api/customer/logout</a></td>
            </tr> 

          </table>
                 
          <table class="table table-bordered border-primary">
            <thead>Hourly Booking</thead>
              <tr>
                <th>method</th>
                <th>auth</th>
                <th class="">description</th>
                <th>api route</th>
              </tr>

              <tr>
                <td>get</td>
                <td>staff</td>
                <td class="">get all hourly bookings</td>
                <td><a href="/api/staff/hourly-booking/">https://workspaceapi.herokuapp.com/api/staff/hourly-booking</a></td>
              </tr> 

              <tr>
                <td>get</td>
                <td>staff & customer</td>
                <td class="">get single hourly-booking</td>
                <td>
                  <a class="d-block" href="/api/staff/hourly-booking/">https://workspaceapi.herokuapp.com/api/staff/hourly-booking/{id}</a>
                  <a class="d-block" href="/api/customer/hourly-booking/">https://workspaceapi.herokuapp.com/api/customer/hourly-booking/{id}</a>
                </td>
              </tr> 

              <tr>
                <td>post</td>
                <td>customer</td>
                <td class="">make new hourly-booking</td>
                <td><a href="/api/customer/hourly-booking/new">https://workspaceapi.herokuapp.com/api/customer/hourly-booking/new</a></td>
              </tr>

              <tr>
                <td>put</td>
                <td>customer</td>
                <td class="">edit single hourly-booking</td>
                <td><a href="/api/customer/hourly-booking/">https://workspaceapi.herokuapp.com/api/customer/hourly-booking/{id}/update</a></td>
              </tr> 

              <tr>
                <td>delete</td>
                <td>staff & customer</td>
                <td class="">delete single hourly-booking</td>
                <td>
                  <a class="d-block" href="/api/staff/hourly-booking/">https://workspaceapi.herokuapp.com/api/staff/hourly-booking/{id}/delete</a>
                  <a class="d-block" href="/api/customer/hourly-booking/">https://workspaceapi.herokuapp.com/api/customer/hourly-booking/{id}/delete</a>
                </td>
              </tr> 

            </table>
                 
          <table class="table table-bordered border-primary">
            <thead>Daily Booking</thead>
              <tr>
                <th>method</th>
                <th>auth</th>
                <th class="">description</th>
                <th>api route</th>
              </tr>

              <tr>
                <td>get</td>
                <td>staff</td>
                <td class="">get all bookings</td>
                <td><a href="/api/staff/bookings/">https://workspaceapi.herokuapp.com/api/staff/bookings</a></td>
              </tr> 

              <tr>
                <td>get</td>
                <td>staff & customer</td>
                <td class="">get single booking</td>
                <td>
                  <a class="d-block" href="/api/staff/bookings/">https://workspaceapi.herokuapp.com/api/staff/bookings/{id}</a>
                  <a class="d-block" href="/api/customer/bookings/">https://workspaceapi.herokuapp.com/api/customer/bookings/{id}</a>
                </td>
              </tr> 

              <tr>
                <td>post</td>
                <td>customer</td>
                <td class="">make new booking</td>
                <td><a href="/api/customer/bookings/new">https://workspaceapi.herokuapp.com/api/customer/bookings/new</a></td>
              </tr>

              <tr>
                <td>get</td>
                <td>staff</td>
                <td class="">get all the bookings for a single day(dd-mm-yyyy)</td>
                <td><a href="/api/staff/bookings/day-bookings">https://workspaceapi.herokuapp.com/api/staff/bookings/day-bookings/{date}</a></td>
              </tr> 

              <tr>
                <td>delete</td>
                <td>staff & customer</td>
                <td class="">delete single bookings</td>
                <td>
                  <a class="d-block" href="/api/staff/bookings/">https://workspaceapi.herokuapp.com/api/staff/bookings/{id}/delete</a>
                  <a class="d-block" href="/api/customer/bookings/">https://workspaceapi.herokuapp.com/api/customer/bookings/{id}/delete</a>
                </td>
              </tr> 

            </table>  

            <table class="table table-bordered border-primary">
              <thead>Weekly Booking</thead>
                <tr>
                  <th>method</th>
                  <th>auth</th>
                  <th class="">description</th>
                  <th>api route</th>
                </tr>
  
                <tr>
                  <td>post</td>
                  <td>customer</td>
                  <td class="">make new weekly booking</td>
                  <td><a href="/api/customer/weekly-booking/new">https://workspaceapi.herokuapp.com/api/customer/weekly-booking/new</a></td>
                </tr>
  
            </table>
          
          <table class="table table-bordered border-primary">
            <thead>Availability</thead>
            <tr>
              <th>method</th>
              <th>auth</th>
              <th class="">description</th>
              <th>api route</th>
            </tr>

            <tr>
              <td>get</td>
              <td>no auth</td>
              <td class="">get all the available <b>HOT DESKS</b> (not booked) for a single day (dd-mm-yyyy)</td>
              <td><a href="/api/bookings/day-bookings">https://workspaceapi.herokuapp.com/api/bookings/day-bookings/{date}/available</a></td>
            </tr> 

            <tr>
              <td>get</td>
              <td>no auth</td>
              <td class="">get all the available wokspaces (not booked) of a type (Smart office, Work station, Hot Desk) for a single day (dd-mm-yyyy)</td>
              <td><a href="/api/available/">https://workspaceapi.herokuapp.com/api/available/{date}/{space_type_id}</a></td>
            </tr> 

          </table>
                 
          <table class="table table-bordered border-primary">
            <thead>Workspace Types</thead>
            <tr>
              <th>method</th>
              <th>auth</th>
              <th class="">description</th>
              <th>api route</th>
            </tr>

            <tr>
              <td>get</td>
              <td>no auth</td>
              <td class="">get all the types of workspaces</td>
              <td><a href="/api/space-type/">https://workspaceapi.herokuapp.com/api/space-type</a></td>
            </tr> 

            <tr>
              <td>get</td>
              <td>no auth</td>
              <td class="">get single type of workspaces</td>
              <td><a href="/api/space-type/">https://workspaceapi.herokuapp.com/api/space-type/{id}</a></td>
            </tr> 

            <tr>
              <td>post</td>
              <td>staff</td>
              <td class="">add new type of workspaces</td>
              <td><a href="/api/staff/space-type/new">https://workspaceapi.herokuapp.com/api/staff/space-type/new</a></td>
            </tr>

            <tr>
              <td>put</td>
              <td>staff</td>
              <td class="">edit single type of workspace</td>
              <td><a href="/api/staff/space-type/">https://workspaceapi.herokuapp.com/api/staff/space-type/{id}/update</a></td>
            </tr> 

            <tr>
              <td>delete</td>
              <td>staff</td>
              <td class="">delete single type of workspace</td>
              <td><a href="/api/staff/space-type/">https://workspaceapi.herokuapp.com/api/staff/space-type/{id}/delete</a></td>
            </tr> 

          </table>
                 
          <table class="table table-bordered border-primary">
            <thead>Spaces</thead>
              <tr>
                <th>method</th>
                <th>auth</th>
                <th class="">description</th>
                <th>api route</th>
              </tr>

              <tr>
                <td>get</td>
                <td>no auth</td>
                <td class="">get all workspaces</td>
                <td><a href="/api/space/">https://workspaceapi.herokuapp.com/api/space</a></td>
              </tr> 

              <tr>
                <td>get</td>
                <td>no auth</td>
                <td class="">get single workspace</td>
                <td><a href="/api/space/">https://workspaceapi.herokuapp.com/api/space/{id}</a></td>
              </tr> 

              <tr>
                <td>post</td>
                <td>staff</td>
                <td class="">add new workspace</td>
                <td><a href="/api/staff/space/new">https://workspaceapi.herokuapp.com/api/staff/space/new</a></td>
              </tr>

              <tr>
                <td>put</td>
                <td>staff</td>
                <td class="">edit single workspace</td>
                <td><a href="/api/staff/space/">https://workspaceapi.herokuapp.com/api/staff/space/{id}/update</a></td>
              </tr> 

              <tr>
                <td>delete</td>
                <td>staff</td>
                <td class="">delete single workspace</td>
                <td><a href="/api/staff/space/">https://workspaceapi.herokuapp.com/api/staff/space/{id}/delete</a></td>
              </tr> 

            </table>
            
        </div>
    </body>
      <!-- Scripts -->
      {{-- CDN --}}
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      {{-- Local --}}
      <script src="{{ asset('js/app.js') }}" defer></script>
</html>
