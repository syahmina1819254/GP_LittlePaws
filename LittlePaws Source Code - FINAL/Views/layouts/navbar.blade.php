<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">LittlePaws</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('welcome') }}">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('reserve.create') }}">Reservations</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('adoption.index') }}">Adoptions</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('reserve.show') }}">Reservation History</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('adoption.show') }}">Adoption Status</a>
      </li>
    </ul>
  </div>
</nav>