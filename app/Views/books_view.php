<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body class="p-5 bg-white">
    <div class="container mt-4 text-center mb-5">
        <?php if ($role === 'librarian'): ?>
            <p class="display-5 fw-semibold">
            Selamat datang, Anda login sebagai <span class="text-primary">pustakawan</span>.
            </p>
        <?php elseif ($role === 'member'): ?>
            <p class="display-5 fw-semibold">
            Selamat datang, Anda login sebagai <span class="text-success">anggota</span>.
            </p>
        <?php endif; ?>
    </div>

    <?php if (empty($books)): ?>
      <div class="alert alert-warning">No books available.</div>
    <?php else: ?>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Book List</h2>
            <div class="d-flex gap-2">
                <?php if ($role === 'librarian'): ?>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBookModal">
                    <i class="bi bi-plus-circle"></i> Add Book
                </button>
                <?php endif; ?>
                <a href="/logout" class="btn btn-outline-secondary btn-danger text-white">Logout</a>
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-hover align-middle table-bordered shadow-sm">
                <thead class="table-light">
                    <tr class="align-middle text-dark text-uppercase">
                        <th class="fw-bold fs-6">Title</th>
                        <th class="fw-bold fs-6">Author</th>
                        <th class="fw-bold fs-6">Year</th>
                        <th class="fw-bold fs-6">Status</th>
                        <?php if ($role === 'librarian'): ?>
                        <th class="fw-bold fs-6 text-center">Actions</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                    <td><?= esc($book['title']) ?></td>
                    <td><?= esc($book['author']) ?></td>
                    <td><?= esc($book['published_year']) ?></td>
                    <td>
                        <span class="badge <?= $book['available'] ? 'bg-success' : 'bg-danger' ?>">
                        <?= $book['available'] ? 'Available' : 'Unavailable' ?>
                        </span>
                    </td>
                    <?php if ($role === 'librarian'): ?>
                        <td class="text-center">
                        <button class="btn btn-sm text-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $book['id'] ?>">
                            <i class="bi bi-pencil-square fs-5"></i>
                        </button>
                        <button class="btn btn-sm text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $book['id'] ?>">
                            <i class="bi bi-trash fs-5"></i>
                        </button>
                        </td>
                    <?php endif; ?>
                    </tr>

                    <div class="modal fade" id="editModal<?= $book['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $book['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="/books/update/<?= $book['id'] ?>" method="post">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel<?= $book['id'] ?>">Edit Book</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="<?= esc($book['title']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Author</label>
                                <input type="text" name="author" class="form-control" value="<?= esc($book['author']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Published Year</label>
                                <input type="number" name="published_year" class="form-control" value="<?= esc($book['published_year']) ?>">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="available" id="available<?= $book['id'] ?>" <?= $book['available'] ? 'checked' : '' ?>>
                                <label class="form-check-label" for="available<?= $book['id'] ?>">Available</label>
                            </div>
                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    </div>

                    <div class="modal fade" id="deleteModal<?= $book['id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $book['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="/books/delete/<?= $book['id'] ?>" method="get">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title text-danger" id="deleteModalLabel<?= $book['id'] ?>">Confirm Deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            Are you sure you want to delete "<strong><?= esc($book['title']) ?></strong>"?
                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    </div>

                <?php endforeach; ?>
                </tbody>
            </table>
            
        </div>
        <?php if ($role === 'librarian'): ?>
  <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="/books/save" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addBookModalLabel">Add New Book</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Title</label>
              <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Author</label>
              <input type="text" name="author" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Published Year</label>
              <input type="number" name="published_year" class="form-control">
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Add Book</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </div>
      </form>
    </div>
  </div>
<?php endif; ?>

    <?php endif; ?>
  </div>
</body>
</html>
