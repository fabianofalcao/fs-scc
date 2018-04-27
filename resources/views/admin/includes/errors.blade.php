@if(isset($errors) && $errors->any())
    <div class="row margin-top10">
        <div class="col-md-10 col-md-offset-1">
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif