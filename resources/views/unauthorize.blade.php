@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                   
                        <div class="alert alert-error">
                           <p> Un authorize access </p>
                        </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
   transition: all 0.25s cubic-bezier(.25,.8,.25,1);
        }

        h1,
        h2 {
          color: white;
          font-family: 'Lobster Two', cursive;
          font-style: italic;
          font-weight: 200;
          line-height: 1;
          margin: 0px;
          padding: 0px;
          text-align: center;
          text-shadow: 2px 0px 2px #240284, -2px 0px 2px #240284, 0px 2px 2px #240284, 0px -2px 2px #240284, 0 6px 10px rgba(0, 0, 0, .5);

        }

        h1 {
          font-size: 12rem;
          margin-bottom: 3rem;
        }

        h2 {
          font-size: 4rem;
        }

        @media all and (max-width:970px) {
          h1 {font-size:10rem}
        h2 {
          font-size: 3.33rem;
        }}

        @media all and (max-width:820px) {
          h1 {font-size:8rem}
        h2 {
          font-size: 2.66rem;
        }

        @media all and (max-width:660px) {
          h1 {font-size:6rem}
        h2 {
          font-size: 2rem;
        }

        @media all and (max-width:510px) {
          h1 {font-size:5rem}
        h2 {
          font-size: 1.66rem;
        }

        @media all and (max-width:435px) {
          h1 {font-size:4rem}
        h2 {
          font-size: 1.33rem;
        }
        }
        </style>
    </head>
    <body>
        <div id="container">
		  <div class="alert alert-error">
              <p> Un authorize access </p>
           </div>
		</div>
    </body>

</html>