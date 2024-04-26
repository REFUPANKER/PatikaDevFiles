class Sekil {
    public function alanHesapla() {
        return 0;
    }

    public function cevreHesapla() {
        return 0;
    }
}

class Dikdortgen extends Sekil {
    private $uzunluk;
    private $genislik;

    public function __construct($uzunluk, $genislik) {
        $this->uzunluk = $uzunluk;
        $this->genislik = $genislik;
    }

    public function alanHesapla() {
        return $this->uzunluk * $this->genislik;
    }

    public function cevreHesapla() {
        return 2 * ($this->uzunluk + $this->genislik);
    }
}

class Ucgen extends Sekil {
    private $taban;
    private $yukseklik;

    public function __construct($taban, $yukseklik) {
        $this->taban = $taban;
        $this->yukseklik = $yukseklik;
    }

    public function alanHesapla() {
        return ($this->taban * $this->yukseklik) / 2;
    }
}

class Kare extends Dikdortgen {
    public function __construct($kenar) {
        parent::__construct($kenar, $kenar);
    }
}

$dikdortgen = new Dikdortgen(5, 10);
echo "Dikdörtgen Alanı: " . $dikdortgen->alanHesapla() . ", Çevresi: " . $dikdortgen->cevreHesapla() . "<br>";

$ucgen = new Ucgen(6, 4);
echo "Üçgen Alanı: " . $ucgen->alanHesapla() . "<br>";

$kare = new Kare(7);
echo "Kare Alanı: " . $kare->alanHesapla() . ", Çevresi: " . $kare->cevreHesapla() . "<br>";
?>
