<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Select Role</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      min-height: 100vh;
      background-color: #f8f9fa;
      display: flex;
      flex-direction: column;
    }
    .welcome-card {
      max-width: 450px;
      margin: auto;
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-dark bg-primary py-4 shadow">
  <div class="container-fluid justify-content-center">
    <span class="navbar-brand h1 text-center fs-3">
      Perpustakaan Universitas Widya Husada Semarang
    </span>
  </div>
</nav>

  <div class="container d-flex justify-content-center align-items-center flex-grow-1">
    <div class="card shadow welcome-card text-center p-4">
      <h3 class="mb-3">Selamat Datang 👋</h3>
      <p class="mb-4 text-muted">
        Silakan pilih peran Anda untuk melanjutkan ke sistem perpustakaan.
      </p>

      <form action="/choose/librarian" method="post" class="d-grid gap-2 mb-2">
        <button type="submit" class="btn btn-primary btn-lg">
          <i class="bi bi-person-badge"></i> Sebagai Pustakawan
        </button>
      </form>

      <form action="/choose/member" method="post" class="d-grid gap-2">
        <button type="submit" class="btn btn-success btn-lg">
          <i class="bi bi-person"></i> Sebagai Anggota
        </button>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
