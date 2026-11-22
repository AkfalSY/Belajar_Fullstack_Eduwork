        const pw = document.getElementById("password");
        const toggle = document.getElementById("togglePassword");

        if (pw && toggle) {
            toggle.addEventListener("click", () => {
                const show = pw.type === "password";
                pw.type = show ? "text" : "password";
                toggle.textContent = show ? "Sembunyikan" : "Tampilkan";
            });
        }

        const modal = document.getElementById("modalTambah");
        const btnTambah = document.getElementById("btnTambah");
        const formProduct = document.getElementById("formProduct");

        function openModal() {
            modal.classList.remove("hidden");
            modal.classList.add("flex");
            modal.setAttribute("aria-hidden", "false");
            document.body.classList.add("overflow-hidden");
        }

        function closeModal() {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
            modal.setAttribute("aria-hidden", "true");
            document.body.classList.remove("overflow-hidden");
            formProduct.reset(); // kosongkan isian saat modal ditutup
            btnTambah.focus();
        }

        btnTambah.addEventListener("click", openModal);
        document.getElementById("modalTambahClose").addEventListener("click", closeModal);
        document.getElementById("modalTambahBatal").addEventListener("click", closeModal);
        modal.addEventListener("click", (e) => {
            if (e.target === modal) closeModal(); // klik area gelap di luar modal
        });
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape" && !modal.classList.contains("hidden")) closeModal();
        });

document.querySelectorAll("#editData").forEach(btn => {
    btn.addEventListener('click', () => {
        openModal();
        document.getElementById('aksi').value = "edit";
        document.getElementById('idProduct').value = btn.dataset.id;
        document.getElementById('namaProduct').value = btn.dataset.nama;
        document.getElementById('hargaProduct').value = btn.dataset.harga;
        document.getElementById('stockProduct').value = btn.dataset.stock;
        document.getElementById('deskripsi').value = btn.dataset.deskripsi;

})
});
