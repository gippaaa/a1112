<?php
$harga_asli = '';
$diskon_persen = '';
$diskon = '';
$harga_setelah_diskon = '';
$peringatan_diskon = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $harga_asli = $_POST['harga_asli'];
    $diskon_persen = $_POST['diskon_persen'];

    if ($diskon_persen > 100) {
        $peringatan_diskon = "Peringatan: Diskon tidak boleh melebihi 100%.";
    } else {
        $diskon = ($harga_asli * $diskon_persen) / 100;
        $harga_setelah_diskon = $harga_asli - $diskon;
    }
}
?>

<html>
<head>
    <title>Kalkulator Diskon Sederhana</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function formatRupiah(angka) {
            return angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function displayResults() {
            let hargaAsli = document.getElementById("harga_asli").value.replace(/\./g, '');
            let diskonPersen = document.getElementById("diskon_persen").value;

            if (hargaAsli === "" || diskonPersen === "") {
                alert("Harap masukkan harga dan diskon.");
                return;
            }

            hargaAsli = parseInt(hargaAsli);

            if (diskonPersen > 100) {
                document.getElementById("peringatan").innerText = "Peringatan: Diskon tidak boleh melebihi 100%.";
                document.getElementById("hasil").style.display = "none";
                return;
            } else {
                document.getElementById("peringatan").innerText = "";
            }

            let diskon = (hargaAsli * diskonPersen) / 100;
            let hargaSetelahDiskon = hargaAsli - diskon;

            document.getElementById("harga_asli_hasil").innerText = formatRupiah(hargaAsli.toString());
            document.getElementById("diskon_hasil").innerText = formatRupiah(diskon.toString());
            document.getElementById("harga_setelah_diskon_hasil").innerText = formatRupiah(hargaSetelahDiskon.toString());

            document.getElementById("hasil").style.display = "block";
        }

        function formatInputRupiah(event) {
            let value = event.target.value.replace(/\./g, '');
            event.target.value = formatRupiah(value);
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Kalkulator Diskon</h1>
        <form method="post" action="" onsubmit="displayResults(); return false;">
            <label for="harga_asli">Harga Asli:</label>
            <input type="text" id="harga_asli" name="harga_asli" value="<?= $harga_asli ?>" required oninput="formatInputRupiah(event)">
            
            <label for="diskon_persen">Diskon (%):</label>
            <input type="number" id="diskon_persen" name="diskon_persen" value="<?= $diskon_persen ?>" required>
            
            <button type="submit">Hitung</button>
        </form>

        <div id="peringatan" style="color: red;"></div>

        <div id="hasil" class="hasil" style="display: none;">
            <p><strong>Harga Asli:</strong> Rp <span id="harga_asli_hasil"></span></p>
            <p><strong>Diskon:</strong> Rp <span id="diskon_hasil"></span></p>
            <p><strong>Harga Setelah Diskon:</strong> Rp <span id="harga_setelah_diskon_hasil"></span></p>
        </div>
    </div>
</body>
</html>