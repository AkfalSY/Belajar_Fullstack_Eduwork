const buttons = document.querySelectorAll("[data-filter]");
            const cards = document.querySelectorAll("article[data-category]");
            const ACTIVE = ["bg-blue-600", "text-white", "border-blue-600"];
            const IDLE = ["bg-white", "text-slate-600", "border-slate-200", "hover:bg-blue-50"];

            buttons.forEach((btn) => {
                btn.addEventListener("click", () => {
                    const filter = btn.dataset.filter;

                    buttons.forEach((b) => {
                        const on = b === btn;
                        ACTIVE.forEach((c) => b.classList.toggle(c, on));
                        IDLE.forEach((c) => b.classList.toggle(c, !on));
                    });

                    cards.forEach((card) => {
                        card.classList.toggle("hidden", filter !== "all" && card.dataset.category !== filter);
                    });
                    cards[0].parentElement.scrollLeft = 0;
                });
            });
            // ===== Modal detail portofolio =====
            const projects = {
                crud: {
                    kategori: "Web",
                    judul: "CRUD Data Siswa",
                    status: "Dalam pengerjaan",
                    deskripsi: "Aplikasi web untuk mengelola data siswa. Data disimpan di database MySQL dan tampilannya dibuat dengan Tailwind CSS.",
                    teknologi: ["PHP", "MySQL", "Tailwind CSS"],
                    fitur: ["Tambah data siswa beserta foto", "Ubah dan hapus data", "Cari data siswa", "Data meliputi NISN, nama, jenis kelamin, dan alamat"],
                },
                sentimen: {
                    kategori: "Data & AI",
                    judul: "Analisis Sentimen IndoBERT",
                    status: "Dalam pengerjaan",
                    deskripsi: "Penelitian skripsi untuk menganalisis opini publik terhadap kebijakan redenominasi menggunakan model IndoBERT.",
                    teknologi: ["Python", "IndoBERT"],
                    fitur: ["Klasifikasi sentimen ke kelas positif, negatif, dan netral", "Pelatihan model dengan penanganan data tidak seimbang (class weight)", "Evaluasi dengan confusion matrix dan F1-score"],
                },
                tailwind: {
                    kategori: "Web",
                    judul: "Latihan Tailwind CSS",
                    status: "Selesai",
                    deskripsi: "Kumpulan latihan membuat tampilan website yang responsif, dikerjakan selama mengikuti kursus Tailwind CSS.",
                    teknologi: ["HTML", "Tailwind CSS"],
                    fitur: ["Layout responsif untuk HP dan desktop", "Latihan komponen seperti navbar, card, dan tombol", "Penulisan class utility Tailwind"],
                },
            };

            const modal = document.getElementById("modal");
            const modalClose = document.getElementById("modal-close");
            let lastCard = null;

            function openModal(card) {
                const p = projects[card.dataset.id];
                const thumb = card.firstElementChild.cloneNode(true);
                thumb.querySelector(".absolute")?.remove(); // badge status sudah ada di atas

                document.getElementById("modal-kategori").textContent = p.kategori;
                document.getElementById("modal-title").textContent = p.judul;
                const status = document.getElementById("modal-status");
                status.textContent = p.status;
                status.className = "mt-3 inline-block rounded-full px-3 py-1 text-xs font-medium " + (p.status === "Selesai" ? "bg-green-100 text-green-800" : "bg-blue-100 text-blue-800");
                document.getElementById("modal-thumb").replaceChildren(thumb);
                document.getElementById("modal-desc").textContent = p.deskripsi;
                document.getElementById("modal-tech").innerHTML = p.teknologi.map((t) => `<span class="rounded-full bg-blue-50 px-3 py-1 text-sm text-blue-800">${t}</span>`).join("");
                document.getElementById("modal-fitur").innerHTML = p.fitur.map((f) => `<li>${f}</li>`).join("");

                lastCard = card;
                modal.classList.remove("hidden");
                modal.classList.add("flex");
                modal.setAttribute("aria-hidden", "false");
                document.body.classList.add("overflow-hidden");
                modalClose.focus();
            }

            function closeModal() {
                modal.classList.add("hidden");
                modal.classList.remove("flex");
                modal.setAttribute("aria-hidden", "true");
                document.body.classList.remove("overflow-hidden");
                if (lastCard) lastCard.focus();
            }

            cards.forEach((card) => {
                card.addEventListener("click", () => openModal(card));
                card.addEventListener("keydown", (e) => {
                    if (e.key === "Enter" || e.key === " ") {
                        e.preventDefault();
                        openModal(card);
                    }
                });
            });

            modalClose.addEventListener("click", closeModal);
            modal.addEventListener("click", (e) => {
                if (e.target === modal) closeModal(); // klik area gelap di luar modal
            });
            document.addEventListener("keydown", (e) => {
                if (e.key === "Escape" && !modal.classList.contains("hidden")) closeModal();
            });