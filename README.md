# PokéCare - Machoke Simulation

**Nama:** Apriyudha
**NIM:** H1H024010
**Shift Awal:** A
**Shift Akhir:** D

---

## Deskripsi Aplikasi

**PokéCare** adalah aplikasi simulasi pelatihan Pokémon berbasis web yang dibangun menggunakan **PHP Native** (tanpa framework). Aplikasi ini memungkinkan pengguna untuk melatih Pokémon (Machoke) guna meningkatkan statusnya seperti Attack, Defense, dan Speed, serta menaikkan levelnya hingga mencapai potensi maksimal (Legendary Tier).

Aplikasi ini menerapkan konsep **Object-Oriented Programming (OOP)** secara menyeluruh, termasuk **Encapsulation**, **Inheritance**, **Polymorphism**, dan **Abstraction**.

### Fitur Utama:

1.  **Dashboard**: Menampilkan status terkini Pokémon, termasuk Level, HP, Ability, dan Tier Kartu (Common, Rare, Ultra Rare, Legendary).
2.  **Training Session**: Fitur untuk melatih Pokémon dengan berbagai tipe latihan (Strength, Speed, Defense) dan intensitas yang dapat disesuaikan.
3.  **Dynamic Progression**: Leveling system yang dinamis dimana kenaikan status bergantung pada level Pokémon saat ini.
4.  **Visual Feedback**: Animasi kartu, efek level up, dan perubahan visual kartu berdasarkan tier.
5.  **History**: Mencatat riwayat pelatihan yang telah dilakukan.

---

## Penerapan OOP (4 Pilar)

Berikut adalah penjelasan dan contoh kode bagaimana 4 pilar OOP diterapkan dalam proyek ini:

### 1. Encapsulation (Enkapsulasi)

Membungkus data (properti) dan menyembunyikannya dari akses langsung dari luar kelas. Akses dilakukan melalui method (getter/setter).

**Contoh di `src/Pokemon.php`:**

```php
abstract class Pokemon {
    protected $name;
    protected $level;
    protected $hp;
    // ... properti lainnya dilindungi (protected)
    public function getName() {
        return $this->name;
    }
}
```

### 2. Inheritance (Pewarisan)

Membuat kelas baru (`Machoke`) yang mewarisi sifat dan perilaku dari kelas induk (`Pokemon`). Ini memungkinkan penggunaan kembali kode.

**Contoh di `src/Machoke.php`:**

```php
// Machoke mewarisi semua properti dan method dari Pokemon
class Machoke extends Pokemon {
    public function __construct($level = 28, ...) {
        // Memanggil konstruktor kelas induk
        parent::__construct('Machoke', 'Fighting', ...);
    }
}
```

### 3. Abstraction (Abstraksi)

Mendefinisikan kerangka kerja dasar dalam kelas abstrak yang harus diimplementasikan oleh kelas turunannya. Kelas `Pokemon` tidak bisa diinstansiasi sendiri, hanya kelas turunannya (`Machoke`) yang bisa.

**Contoh di `src/Pokemon.php`:**

```php
abstract class Pokemon {
    // Method abstrak yang WAJIB diimplementasikan oleh kelas anak
    abstract public function train($type, $intensity);
    abstract public function getAbility();
}
```

### 4. Polymorphism (Polimorfisme)

Kemampuan objek untuk mengambil banyak bentuk. Method yang sama (`train` atau `getAbility`) dapat memiliki implementasi yang berbeda pada kelas yang berbeda.

**Contoh di `src/Machoke.php`:**

```php
class Machoke extends Pokemon {
    // Implementasi spesifik dari method abstrak getAbility untuk Machoke
    public function getAbility() {
        return "Guts / No Guard";
    }

    // Implementasi spesifik dari logika latihan untuk Machoke
    public function train($type, $intensity) {
        // Logika perhitungan stat khusus Machoke...
    }
}
```

---

## Game Mechanics

### 1. Level Up Moves

Machoke akan mempelajari moves baru seiring dengan kenaikan levelnya. Berikut adalah daftar moves yang dapat dipelajari:

| Level | Name         | Type     | Power | Accuracy | PP  | Details                                                                                                    |
| :---- | :----------- | :------- | :---- | :------- | :-- | :--------------------------------------------------------------------------------------------------------- |
| 1     | Karate Chop  | Fighting | 50    | 100%     | 25  | The target is attacked with a sharp chop. Critical hits land more easily.                                  |
| 1     | Low Kick     | Fighting | -     | 100%     | 20  | A powerful low kick that makes the target fall over. The heavier the target, the greater the move's power. |
| 25    | Leer         | Normal   | -     | 100%     | 30  | The user gives opposing Pokémon an intimidating leer that lowers the Defense stat.                         |
| 36    | Focus Energy | Normal   | -     | -        | 30  | The user takes a deep breath and focuses so that critical hits land more easily.                           |
| 44    | Seismic Toss | Fighting | -     | 100%     | 20  | The target is thrown using the power of gravity. It inflicts damage equal to the user's level.             |
| 52    | Submission   | Fighting | 80    | 80%      | 20  | The user grabs the target and recklessly dives for the ground. This also damages the user a little.        |

### 2. Card Tier Progression

Tampilan kartu Machoke akan berubah (berevolusi) berdasarkan level yang dicapai, menandakan peningkatan status dan kelangkaan kartu.

| Level Range | Card Tier      | Unlocked Features                         |
| :---------- | :------------- | :---------------------------------------- |
| **1 - 24**  | **Common**     | Basic Moves (Karate Chop, Low Kick)       |
| **25 - 35** | **Rare**       | Unlocks **Leer** Move                     |
| **36 - 43** | **Ultra Rare** | Unlocks **Focus Energy** Move             |
| **44+**     | **Legendary**  | Unlocks **Seismic Toss** & **Submission** |

---

## Cara Menjalankan Aplikasi

1.  **Persiapan Lingkungan**:

    - Pastikan Anda telah menginstal web server lokal seperti **Laragon** atau **XAMPP**.
    - Pastikan PHP telah terinstal dan berjalan.

2.  **Instalasi**:

    - Clone atau download repository ini.
    - Pindahkan folder proyek ke dalam direktori root web server Anda (misalnya: `C:\laragon\www\` atau `C:\xampp\htdocs\`).
    - Ubah nama folder menjadi format: `Nama_NIM_ResponsiPBO25`.

3.  **Menjalankan**:
    - Buka browser dan akses: `http://localhost/Nama_NIM_ResponsiPBO25`
    - Aplikasi siap digunakan! Data Pokémon akan tersimpan secara otomatis dalam file JSON di folder `data/`.

---

## Demo Aplikasi

_(Letakkan file GIF demo Anda di sini. Ganti `demo.gif` dengan nama file Anda)_

![Demo Aplikasi](demo.gif)

**Cara membuat GIF:**

1.  Rekam layar saat Anda menggunakan aplikasi (melatih, naik level, melihat history).
2.  Gunakan tools seperti Ezgif atau aplikasi perekam layar untuk menyimpan sebagai `.gif`.
3.  Simpan file gif tersebut di dalam folder root proyek ini.
