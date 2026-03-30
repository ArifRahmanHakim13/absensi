<div class="card card-outline">
  <div class="card-body box-profile mt-3">
      <div class="text-center">
        <img class="profile-user-img img-fluid img-circle img-profile" src="/img/fotoprofil/{{ Auth::user()->foto }}" alt="User profile picture">
      </div>

      <h5 class="text-center fw-bold mt-3">
        {{ $saya->user->name }}
      </h5>

      <p class="text-muted text-center text-capitalize">
        {{ $saya->user->role }}
      </p>
  </div>
</div>
