
<?php
class Parfum {
    public $nama;
    public $top;
    public $middle;
    public $base;
    public $ukuran;

    public function __construct($nama, $top, $middle, $base, $ukuran) {
        $this->nama = $nama;
        $this->top = $top;
        $this->middle = $middle;
        $this->base = $base;
        $this->ukuran = $ukuran;
    }

    public function infoRacikan() {
        return "<h3>$this->nama</h3>
                <p>Ukuran: {$this->ukuran}ml</p>
                <p>Top: $this->top</p>
                <p>Middle: $this->middle</p>
                <p>Base: $this->base</p>";
    }
}

$hargaBotol = 15000;

$hargaTop = ["Citrus" => 3500, "Mint" => 3000, "Lemon" => 3000];
$hargaMiddle = ["Rose" => 3500, "Jasmine" => 4000, "Lavender" => 4500];
$hargaBase = ["Musk" => 4000, "Vanilla" => 5000, "Amber" => 4500];


$ukuranOptions = [10, 20, 30, 40, 50];
$botolperkalian = [
    10 => 1,
    20 => 2,
    30 => 3,
    40 => 4,
    50 => 5,
];

$topNotes = array_keys($hargaTop);
$middleNotes = array_keys($hargaMiddle);
$baseNotes = array_keys($hargaBase);

$hasil = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $top = $_POST["top"];
    $middle = $_POST["middle"];
    $base = $_POST["base"];
    $ukuran = (int)$_POST["ukuran"];

    $botolUkuran = $hargaBotol * $botolperkalian[$ukuran];

    $totalHarga = $botolUkuran + $hargaTop[$top] + $hargaMiddle[$middle] + $hargaBase[$base];

    $racikan = new Parfum($nama, $top, $middle, $base, $ukuran);
    $hasil = $racikan->infoRacikan() .
             "<p><strong>Total Harga:</strong> Rp " . number_format($totalHarga, 0, ',', '.') . "</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mix Parfum</title>
    <style>
        body { 
            font-family: Arial; 
            background: #f5f5f5; 
            display: flex;
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
        }
        .box { 
            background: white; 
            padding: 15px; 
            border-radius: 8px; 
            width: 300px; 
            text-align: center; 
        }
        select, input, button { 
            width: 100%; 
            margin: 10px 0; 
            padding: 10px; 
            box-sizing: border-box; 
        }
        button { 
            background: green; 
            color: white; 
            border: none; 
        }
        label { 
            display: block; 
            text-align: left; 
            margin-top: 8px; 
            font-weight: bold; 
        }
    </style>
</head>
<body>
<div class="box">
    <h2>Mix Parfum</h2>
    <form method="post">
        <input type="text" name="nama" placeholder="Nama Racikan" required>

        
        <label>Ukuran (ml):</label>
        <select name="ukuran" required>
            <?php foreach ($ukuranOptions as $u) echo "<option value=\"$u\">$u ml</option>"; ?>
        </select>

        <label>Top Note:</label>
        <select name="top">
            <?php foreach ($topNotes as $note) echo "<option>$note</option>"; ?>
        </select>

        <label>Middle Note:</label>
        <select name="middle">
            <?php foreach ($middleNotes as $note) echo "<option>$note</option>"; ?>
        </select>

        <label>Base Note:</label>
        <select name="base">
            <?php foreach ($baseNotes as $note) echo "<option>$note</option>"; ?>
        </select>

        <button type="submit">Mix</button>
    </form>

    <?php if ($hasil) echo "<div>$hasil</div>"; ?>
</div>
</body>
</html>