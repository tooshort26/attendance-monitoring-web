@if ($errors->any())
<div class="container">
    <div class="card bg-danger text-white shadow">
        <div class="card-body">
                @foreach ($errors->all() as $error)
                    <li class="font-weight-bold">{{ $error }}</li>
                @endforeach
        </div>
    </div>
</div>
@endif


