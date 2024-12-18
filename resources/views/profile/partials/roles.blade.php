<h1> User roles: </h1>
@if (!empty($roles))
    @foreach ($roles as $role)
        <p>{{ $role }}</p>
    @endforeach
@else 
    <p> User </p>
@endif