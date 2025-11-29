# Apriyudha_H1H024010_ResponsiPBO25

**Nama:** Apriyudha

**NIM:** H1H024010

**Shift Awal:** A

**Shift Akhir:** D

---

## Deskripsi Aplikasi

**PokéCare** adalah aplikasi simulasi pelatihan Pokémon berbasis web yang dibangun menggunakan **PHP Native** (tanpa framework). Aplikasi ini memungkinkan pengguna untuk melatih Pokémon (Machoke) guna meningkatkan statusnya seperti Attack, Defense, dan Speed, serta menaikkan levelnya hingga mencapai potensi maksimal (Legendary Tier).

Aplikasi ini menerapkan konsep **Object-Oriented Programming (OOP)** secara menyeluruh, termasuk **Encapsulation**, **Inheritance**, **Polymorphism**, dan **Abstraction**.

---

## Penjelasan Kode - Penerapan OOP (4 Pilar)

### 1. Encapsulation (Enkapsulasi)

Membungkus data (properti) dan menyembunyikannya dari akses langsung dari luar kelas. Akses dilakukan melalui method (getter/setter).

**Contoh di `Pokemon.php`:**

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

**Contoh di `Machoke.php`:**

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

**Contoh di `Pokemon.php`:**

```php
abstract class Pokemon {
    // Method abstrak yang WAJIB diimplementasikan oleh kelas anak
    abstract public function train($type, $intensity);
}
```

### 4. Polymorphism (Polimorfisme)

Kemampuan objek untuk mengambil banyak bentuk. Method yang sama (`train`) dapat memiliki implementasi yang berbeda pada kelas yang berbeda.

**Contoh di `Machoke.php`:**

```php
class Machoke extends Pokemon {
    // Implementasi spesifik dari logika latihan untuk Machoke
    public function train($type, $intensity) {
        // Logika perhitungan stat khusus Machoke...
    }
}
```

---

## Cara Menjalankan Aplikasi

1.  **Persiapan**:

    - Pastikan Anda telah menginstal web server lokal seperti **Laragon**.
    - Pastikan PHP telah terinstal dan berjalan.

2.  **Instalasi**:

    - Clone atau download repository ini di direktori `C:\laragon\www\`.

      ```cmd
      git clone https://github.com/avriyyy/Apriyudha_H1H024010_ResponsiPBO25.git
      ```

3.  **Menjalankan**:
    - Nyalakan server apache laragon lalu klik kanan pada laragon > www > nama file yang di clone.
    - Aplikasi siap digunakan! Data Pokémon akan tersimpan secara otomatis dalam file JSON seperti `pokemon.json` dan `history.json`.

---

## Demo Aplikasi

![Demo](https://github.com/avriyyy/Apriyudha_H1H024010_ResponsiPBO25/blob/f564edbabc603b5acd56f330fc28b9cc8747e42a/demo.gif)

