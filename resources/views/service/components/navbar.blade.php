<script type="text/javascript" charset="utf-8">
    let a;
    let jam;
    let tanggal;
    let hariarray = new Array("Minggu,", "Senin,", "Selasa,", "Rabu,", "Kamis,", "Jumat,", "Sabtu,");
    let bulanarray = new Array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
        "Oktober", "November", "Desember");

    function formatTime(value) {
        return String(value).padStart(2, '0');
    }

    setInterval(() => {
        const a = new Date();
        const jam = formatTime(a.getHours()) + ':' + formatTime(a.getMinutes()) + ':' + formatTime(a
            .getSeconds());
        const tanggal = hariarray[a.getDay()] + " " + a.getDate() + " " + bulanarray[a.getMonth()] + " " + a
            .getFullYear();

        document.getElementById('jam').innerHTML = jam;
        document.getElementById("tanggal").innerHTML = tanggal;
    }, 1000);
</script>

<nav class="navbar fw-bold color-1 shadow-none">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <div
                style="width: 60px; height: 60px; background-color: transparent; display: flex; align-items: center; justify-content: center;">
            </div>
        </a>
        <span class="me-auto">
            <h1 class="navbar-brand mb-0 text-white fw-bold">Marketplace Katering</h1>
            <p class="m-0">{{ $konfigurasi->alamat }}</p>
            <p class="m-0">{{ $konfigurasi->no_telp }}</p>
        </span>
        <span>
            <h3 id="jam" class="text-end"></h3>
            <h5 id="tanggal"></h5>
        </span>
    </div>
</nav>
