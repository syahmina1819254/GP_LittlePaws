<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin') }}">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.hotel') }}">Hotel</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.reserve') }}">Reservations</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.pet') }}">Pets</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.adoption.list') }}">Adoption Requests</a>
      </li>
    </ul>
  </div>
</nav>