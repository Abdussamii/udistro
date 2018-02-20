@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
        </style>
    </head>
    <body>
        <div id="container">
		  <h2>Let’s Organize Your Move</h2>
		    <h1>Access Deny</h1>
		    <h2>Server say Unauthorized Access</h2>
		</div>
    </body>

</html>