<footer class="bg-dark text-white text-center py-3">
    <div class="container">
        <p class="mb-0">© 2024 My Application. All Rights Reserved.</p>
        <p class="mb-0">Developed by <a href="https://yourwebsite.com" class="text-white">Aurasky</a></p>
    </div>
</footer>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const editButtons = document.querySelectorAll('.edit-btn');
                editButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        document.getElementById('edit-id').value = button.getAttribute('data-id');
                        document.getElementById('edit-nama').value = button.getAttribute('data-nama');
                        document.getElementById('edit-email').value = button.getAttribute('data-email');
                        document.getElementById('edit-telepon').value = button.getAttribute('data-telepon');
                        document.getElementById('edit-tgl_diterima').value = button.getAttribute('data-tgl_diterima');
                        document.getElementById('edit-gaji').value = button.getAttribute('data-gaji');
                        document.getElementById('edit-department').value = button.getAttribute('data-department');
                    });
                });
            });
        </script>

        <script>
            // Ketika tombol edit diklik
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function () {
                    // Ambil data dari atribut data-...
                    document.getElementById('edit-tgl_diterima').value = this.getAttribute('data-tgl_diterima');
                    // Ambil dan isi field lainnya sesuai kebutuhan
                });
            });
        </script>

        <script>onclick='return confirm("Apakah Anda yakin ingin menghapus data ini?")'</script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>